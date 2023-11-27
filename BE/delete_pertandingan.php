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

if (isset($_GET['id'])) {
    $id_del = $_GET['id'];

    $sql_pertandingan = "DELETE FROM pertandingan WHERE id_pertandingan = $id_del;";
    $result_pertandingan = mysqli_query($koneksi, $sql_pertandingan);

    $sql_pemain_pertandingan = "DELETE FROM pemain_pertandingan WHERE id_pertandingan = $id_del;";
    $result_pemain_pertandingan = mysqli_query($koneksi, $sql_pemain_pertandingan);

    echo "
        <script>
            alert('Berhasil Delete!');
            document.location = 'admin.php';
        </script>
    ";
}
