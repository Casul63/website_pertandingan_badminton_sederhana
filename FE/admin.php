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

$sql = "SELECT pertandingan.id_pertandingan, pertandingan.nama_pertandingan, pertandingan.waktu_mulai, pertandingan.waktu_selesai, pemain1.nama_pemain AS nama_pemain_1, pemain2.nama_pemain AS nama_pemain_2, wasit.nama_wasit
        FROM pertandingan 
        JOIN pemain_pertandingan ON pertandingan.id_pertandingan = pemain_pertandingan.id_pertandingan
        JOIN pemain AS pemain1 ON pemain_pertandingan.id_pemain_1 = pemain1.id_pemain
        JOIN pemain AS pemain2 ON pemain_pertandingan.id_pemain_2 = pemain2.id_pemain
        JOIN wasit ON pertandingan.id_wasit = wasit.id_wasit
        ;";

$result = mysqli_query($koneksi, $sql);
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
    <div class="container">
        <div class="pertandingan">
            <button><a href="create_pertandingan.php">Create Pertandingan</a></button>
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
                            <a href='edit_pertandingan.php?id=$row[id_pertandingan]'>Edit</a>
                            <a href='delete_pertandingan.php?id=$row[id_pertandingan]'>Delete </a>
                        </td>
                    ";
                    $i++;
                }
                ?>
            </table>

        </div>
        <div class="user">
        </div>
    </div>
</body>

</html>