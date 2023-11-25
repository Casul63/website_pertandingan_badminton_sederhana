<?php
require_once 'koneksi.php';
session_start();

$id_pertandingan = $_GET['id_pertandingan'];
// var_dump($id_pertandingan);

if ($_SESSION['role'] == 'pemain') {
    $nama_pemain = $_SESSION['username'];

    $sql = "SELECT id_pemain_1, id_pemain_2 FROM pemain_pertandingan WHERE id_pertandingan = $id_pertandingan;";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_pemain FROM pemain WHERE nama_pemain = '$nama_pemain';"));

        if ($row['id_pemain_1'] == null) {
            $sql_update = "UPDATE pemain_pertandingan SET id_pemain_1 = (SELECT id_pemain FROM pemain WHERE nama_pemain = '$nama_pemain') WHERE id_pertandingan = $id_pertandingan";
        } elseif ($row['id_pemain_2'] == null && $row['id_pemain_1'] != $cek['id_pemain']) {
            $sql_update = "UPDATE pemain_pertandingan SET id_pemain_2 = (SELECT id_pemain FROM pemain WHERE nama_pemain = '$nama_pemain') WHERE id_pertandingan = $id_pertandingan";
        } else {
            echo "
            <script>
                alert('Sudah Penuh / Pemain Duplikat!');
                document.location = 'schedule.php';
            </script>";
        }

        $result_update = mysqli_query($koneksi, $sql_update);

        if ($result_update) {
            echo "
            <script>
                alert('Berhasil menambahkan pemain ke pertandingan');
                document.location = 'schedule.php';
            </script>";
        }
    }
}

if ($_SESSION['role'] == 'wasit') {
    $nama_wasit = $_SESSION['username'];

    $sql = "SELECT id_wasit FROM pertandingan WHERE id_pertandingan = $id_pertandingan;";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['id_wasit'] == null) {
            $sql_update = "UPDATE pertandingan SET id_wasit = (SELECT id_wasit FROM wasit WHERE nama_wasit = '$nama_wasit') WHERE id_pertandingan = $id_pertandingan;";
        } else {
            echo "
            <script>
                alert('Sudah ada wasit!');
                document.location = 'schedule.php';
            </script>";
        }

        $result_update = mysqli_query($koneksi, $sql_update);

        if ($result_update) {
            echo "
            <script>
                alert('Anda berhasil join sebagai wasit');
                document.location = 'schedule.php';
            </script>";
        }
    }
}

if ($_SESSION['role'] == 'penonton') {
    echo "
    <script>
        alert('Anda hanya penonton');
        document.location = 'schedule.php';
    </script>";
}
