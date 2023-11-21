<?php
require_once 'koneksi.php';
session_start();

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
    <title>Daftar Pertandingan</title>
</head>

<body>
    <div>
        <h1>Daftar Pertandingan</h1>
        <table>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <tr>
                        <td>Nama Pertandingan</td>
                        <td>:</td>
                        <td>$row[nama_pertandingan]</td>
                    </tr>
                    <tr>
                        <td>Nama Pemain 1</td>
                        <td>:</td>
                        <td>$row[nama_pemain_1]</td>
                    </tr>
                    <tr>
                        <td>Nama Pemain 2</td>
                        <td>:</td>
                        <td>$row[nama_pemain_2]</td>
                    </tr>
                    <tr>
                        <td>Nama Wasit</td>
                        <td>:</td>
                        <td>$row[nama_wasit]</td>
                    </tr>
                    <tr>
                        <td>Waktu Mulai</td>
                        <td>:</td>
                        <td>$row[waktu_mulai]</td>
                    </tr>
                    <tr>
                        <td>Waktu Selesai</td>
                        <td>:</td>
                        <td>$row[waktu_selesai]</td>
                    </tr>
                ";
            }
            ?>
        </table>
    </div>
</body>

</html>