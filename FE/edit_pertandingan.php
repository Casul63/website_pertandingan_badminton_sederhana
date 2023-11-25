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

$id_edit = $_GET['id'];
$sql = "SELECT pertandingan.id_pertandingan, pertandingan.nama_pertandingan, pertandingan.waktu_mulai, pertandingan.waktu_selesai, pemain1.nama_pemain AS nama_pemain_1, pemain2.nama_pemain AS nama_pemain_2, wasit.nama_wasit
        FROM pertandingan 
        JOIN pemain_pertandingan ON pertandingan.id_pertandingan = pemain_pertandingan.id_pertandingan
        JOIN pemain AS pemain1 ON pemain_pertandingan.id_pemain_1 = pemain1.id_pemain
        JOIN pemain AS pemain2 ON pemain_pertandingan.id_pemain_2 = pemain2.id_pemain
        JOIN wasit ON pertandingan.id_wasit = wasit.id_wasit
        WHERE pertandingan.id_pertandingan = $id_edit
        ;";

$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);

$nama_pertandingan = $row['nama_pertandingan'];
$pemain_1 = $row['nama_pemain_1'];
$pemain_2 = $row['nama_pemain_2'];
$wasit = $row['nama_wasit'];
$waktu_mulai = date('Y-m-d\TH:i', strtotime($row['waktu_mulai']));
$waktu_selesai = date('Y-m-d\TH:i', strtotime($row['waktu_selesai']));


$sql_pemain = "SELECT id_pemain, nama_pemain FROM pemain;";
$result_pemain_1 = mysqli_query($koneksi, $sql_pemain);
$result_pemain_2 = mysqli_query($koneksi, $sql_pemain);

$sql_wasit = "SELECT id_wasit, nama_wasit FROM wasit;";
$result_wasit = mysqli_query($koneksi, $sql_wasit);

if (isset($_POST['update_pertandingan'])) {
    $nama_pertandingan = $_POST['nama_pertandingan'];
    $new_pemain_1 = $_POST['pemain_1'];
    $new_pemain_2 = $_POST['pemain_2'];
    $wasit = $_POST['wasit'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];

    $sql_pertandingan = "UPDATE pertandingan 
                                SET nama_pertandingan = '$nama_pertandingan', 
                                    waktu_mulai = '$waktu_mulai', 
                                    waktu_selesai = '$waktu_selesai', 
                                    id_wasit = $wasit 
                                WHERE id_pertandingan = $id_edit";

    mysqli_query($koneksi, $sql_pertandingan);

    $sql_pemain_pertandingan = "UPDATE pemain_pertandingan 
                                        SET id_pemain_1 = $new_pemain_1, 
                                            id_pemain_2 = $new_pemain_2 
                                        WHERE id_pertandingan = $id_edit";

    mysqli_query($koneksi, $sql_pemain_pertandingan);

    echo "
        <script>document.location = 'admin.php';</script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pertandingan</title>
</head>

<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Nama Pertandingan</td>
                <td>:</td>
                <td><input type="text" name="nama_pertandingan" value="<?php echo $nama_pertandingan; ?>"></td>
            </tr>
            <tr>
                <td>Pemain 1</td>
                <td>:</td>
                <td>
                    <select name="pemain_1">
                        <option value="">Pilih Pemain 1</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_pemain_1)) {
                            $selected = ($row['nama_pemain'] == $pemain_1) ? "selected" : "";
                            echo "<option value='$row[id_pemain]' $selected>$row[nama_pemain]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Pemain 2</td>
                <td>:</td>
                <td>
                    <select name="pemain_2" id="">
                        <option value="">Pilih Pemain 2</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_pemain_2)) {
                            $selected = ($row['nama_pemain'] == $pemain_2) ? "selected" : "";
                            echo "<option value='$row[id_pemain]' $selected>$row[nama_pemain]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Wasit</td>
                <td>:</td>
                <td>
                    <select name="wasit" id="">
                        <option value="">Pilih Wasit</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_wasit)) {
                            $selected = ($row['nama_wasit'] == $wasit) ? "selected" : "";
                            echo "<option value='$row[id_wasit]' $selected>$row[nama_wasit]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Waktu Mulai</td>
                <td>:</td>
                <td><input type="datetime-local" name="waktu_mulai" value="<?php echo $waktu_mulai; ?>"></td>
            </tr>
            <tr>
                <td>Waktu Selesai</td>
                <td>:</td>
                <td><input type="datetime-local" name="waktu_selesai" value="<?php echo $waktu_selesai; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="update_pertandingan" value="Update Pertandingan"></td>
            </tr>
        </table>
    </form>
</body>

</html>