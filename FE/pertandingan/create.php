<?php
require_once '../koneksi.php';
session_start();
if ($_SESSION['role'] == 'admin') {
    echo "<h1>Panel Admin</h1>";
} else {
    echo "
        <script>
            alert('Bukan Admin!');
            document.location = '../index.php';
        </script>
    ";
}

$sql_pemain = "SELECT id_pemain, nama_pemain FROM pemain;";
$result_pemain_1 = mysqli_query($koneksi, $sql_pemain);
$result_pemain_2 = mysqli_query($koneksi, $sql_pemain);

$sql_wasit = "SELECT id_wasit, nama_wasit FROM wasit;";
$result_wasit = mysqli_query($koneksi, $sql_wasit);

if (isset($_POST['create_pertandingan'])) {
    $nama_pertandingan = $_POST['nama_pertandingan'];
    $pemain_1 = isset($_POST['pemain_1']) ? $_POST['pemain_1'] : 'NULL';
    $pemain_2 = isset($_POST['pemain_2']) ? $_POST['pemain_2'] : 'NULL';
    $id_wasit = isset($_POST['wasit']) ? $_POST['wasit'] : 'NULL';
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];

    $sql_pertandingan = "INSERT INTO pertandingan (nama_pertandingan, waktu_mulai, waktu_selesai, id_wasit) VALUES ('$nama_pertandingan', '$waktu_mulai', '$waktu_selesai', " . ($id_wasit != 'NULL' ? $id_wasit : 'NULL') . ");";

    $result_pertandingan = mysqli_query($koneksi, $sql_pertandingan);


    $id_pertandingan = mysqli_insert_id($koneksi);

    $sql_pemain_pertandingan = "INSERT INTO pemain_pertandingan (id_pemain_1, id_pemain_2, id_pertandingan) 
                                VALUES (" . ($pemain_1 != 'NULL' ? $pemain_1 : 'NULL') . " , " . ($pemain_1 != 'NULL' ? $pemain_2 : 'NULL') . ", $id_pertandingan);";
    $result_pemain_pertandingan = mysqli_query($koneksi, $sql_pemain_pertandingan);

    echo "
        <script>
            document.location = 'admin.php';
        </script>
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
                <td><input type="text" name="nama_pertandingan"></td>
            </tr>
            <tr>
                <td>Pemain 1</td>
                <td>:</td>
                <td>
                    <select name="pemain_1">
                        <option value="NULL" selected>Pilih Pemain 1</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_pemain_1)) {
                            echo "<option value='$row[id_pemain]'>$row[nama_pemain]</option>";
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
                        <option value="NULL" selected>Pilih Pemain 2</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_pemain_2)) {
                            echo "<option value='$row[id_pemain]'>$row[nama_pemain]</option>";
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
                        <option value="NULL" selected>Pilih Wasit</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_wasit)) {
                            echo "<option value='$row[id_wasit]'>$row[nama_wasit]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Waktu Mulai</td>
                <td>:</td>
                <td><input type="datetime-local" name="waktu_mulai"></td>
            </tr>
            <tr>
                <td>Waktu Selesai</td>
                <td>:</td>
                <td><input type="datetime-local" name="waktu_selesai"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="create_pertandingan" value="Create Pertandingan"></td>
            </tr>
        </table>
    </form>
</body>

</html>