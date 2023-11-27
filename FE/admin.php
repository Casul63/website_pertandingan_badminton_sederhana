<?php
require_once 'koneksi.php';
session_start();
if ($_SESSION['role'] == 'admin') {
    echo "<h1>Panel Admin</h1>";
} else {
    echo "
        <script>
            alert('Bukan Admin!');
            document.location = 'index.php';
        </script>
    ";
}

$sql = "SELECT pertandingan.id_pertandingan, pertandingan.nama_pertandingan, pertandingan.waktu_mulai, pertandingan.waktu_selesai, COALESCE(pemain1.nama_pemain, 'Kosong') AS nama_pemain_1, COALESCE(pemain2.nama_pemain, 'Kosong') AS nama_pemain_2, COALESCE(wasit.nama_wasit, 'Kosong') AS nama_wasit
        FROM pertandingan 
        LEFT JOIN pemain_pertandingan ON pertandingan.id_pertandingan = pemain_pertandingan.id_pertandingan
        LEFT JOIN pemain AS pemain1 ON pemain_pertandingan.id_pemain_1 = pemain1.id_pemain
        LEFT JOIN pemain AS pemain2 ON pemain_pertandingan.id_pemain_2 = pemain2.id_pemain
        LEFT JOIN wasit ON pertandingan.id_wasit = wasit.id_wasit
        ORDER BY pertandingan.id_pertandingan ASC;";

$result = mysqli_query($koneksi, $sql);

$sql_pemain = "SELECT * FROM pemain;";
$result_pemain = mysqli_query($koneksi, $sql_pemain);

$sql_wasit = "SELECT * FROM wasit;";
$result_wasit = mysqli_query($koneksi, $sql_wasit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>
    <?php
    // echo "Admin"
    ?>
    <h2>README</h2>
    <p>Ini adalah Halaman Admin. Hanya admin yang bisa mengakses ini. Di Sini Bisa CRUD Pertandingan</p>
    <div class="container" style="display: block;">
        <div class="pertandingan">
            <button><a href="pertandingan/create.php">Create Pertandingan</a></button>
            <br><br>
            <table border="1">
                <tr>
                    <th>No.</th>
                    <th>Nama Pertandingan</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Pemain</th>
                    <th>Wasit</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr> 
                        
                        <td>$i</td>
                        <td>$row[nama_pertandingan]</td>
                        <td>$row[waktu_mulai]</td>
                        <td>$row[waktu_selesai]</td>
                        <td>$row[nama_pemain_1]<br>
                            $row[nama_pemain_2]
                        </td>
                        <td>$row[nama_wasit]</td>
                        <td>
                            <a href='pertandingan/edit.php?id=$row[id_pertandingan]'>Edit</a>
                            <a href='pertandingan/delete.php?id=$row[id_pertandingan]'>Delete </a>
                        </td>
                    ";
                    $i++;
                }
                ?>
            </table>

        </div>
        <div class="user" style="margin-top: 30px;">
            <button><a href="pemain/create.php">Create Pemain</a></button><br><br>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Nama Pemain</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result_pemain)) {
                    echo "
                    <tr>
                        <td>$i</td>
                        <td>$row[nama_pemain]</td>
                        <td>";
                    $kunci = "projek_responsi_";
                    $decrypted_password = openssl_decrypt($row['password'], 'aes-256-cbc', $kunci, 0, $kunci);
                    echo
                    "$decrypted_password</td>
                        <td>
                            <a href='pemain/edit.php?id=$row[id_pemain]'>Edit</a>
                            <a href='pemain/delete.php?id=$row[id_pemain]'>Delete </a>
                        </td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </table>
        </div>
        <div class="wasit" style="margin-top: 30px;">
            <button><a href="wasit/create.php">Create Wasit</a></button><br><br>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Nama Wasit</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result_wasit)) {
                    echo "
                    <tr>
                    <td>$i</td>
                    <td>$row[nama_wasit]</td>
                    <td>";
                    $kunci = "projek_responsi_";
                    $decrypted_password = openssl_decrypt($row['password'], 'aes-256-cbc', $kunci, 0, $kunci);
                    echo
                    "$decrypted_password</td>
                        <td>
                            <a href='wasit/edit.php?id=$row[id_wasit]'>Edit</a>
                            <a href='wasit/delete.php?id=$row[id_wasit]'>Delete </a>
                        </td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>