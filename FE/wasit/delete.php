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

if (isset($_GET['id'])) {
    $id_del = $_GET['id'];

    $sql = "DELETE FROM wasit WHERE id_wasit = $id_del;";
    $result = mysqli_query($koneksi, $sql);

    echo "
        <script>
            alert('Berhasil Delete!');
            document.location = '../admin.php';
        </script>
    ";
}
