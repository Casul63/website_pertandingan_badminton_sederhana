<?php
require_once 'koneksi.php';


if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $kunci = "projek_responsi_";
    $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $kunci, 0, $kunci);

    $sql_admin = "SELECT nama_admin, password FROM admin;";
    $sql_pemain = "SELECT nama_pemain, password FROM pemain;";
    $sql_wasit = "SELECT nama_wasit, password FROM wasit;";
    $sql_penonton = "SELECT nama_penonton, password FROM penonton;";

    $result_admin = mysqli_query($koneksi, $sql_admin);
    $result_pemain = mysqli_query($koneksi, $sql_pemain);
    $result_wasit = mysqli_query($koneksi, $sql_wasit);
    $result_penonton = mysqli_query($koneksi, $sql_penonton);

    while ($row = mysqli_fetch_assoc($result_admin)) {
        if ($row['nama_admin'] == $nama && $row['password'] == $password) {
            $_SESSION['username'] = $nama;
            $_SESSION['role'] = 'admin';
            echo "
            <script>
                alert('Berhasil Login');
                document.location = 'admin.php';
            </script>
            ";
        }
    }

    while ($row = mysqli_fetch_assoc($result_pemain)) {
        if ($row['nama_pemain'] == $nama && $row['password'] == $encrypted_password) {
            $_SESSION['username'] = $nama;
            $_SESSION['role'] = 'pemain';
            echo "
            <script>
                alert('Berhasil Login');
                document.location = 'index.php';
            </script>
            ";
        }
    }

    while ($row = mysqli_fetch_assoc($result_wasit)) {
        if ($row['nama_wasit'] == $nama && $row['password'] == $encrypted_password) {
            $_SESSION['username'] = $nama;
            $_SESSION['role'] = 'wasit';
            echo "
            <script>
                alert('Berhasil Login');
                document.location = 'index.php';
            </script>
            ";
        }
    }

    while ($row = mysqli_fetch_assoc($result_penonton)) {
        if ($row['nama_penonton'] == $nama && $row['password'] == $encrypted_password) {
            $_SESSION['username'] = $nama;
            $_SESSION['role'] = 'penonton';
            echo "
            <script>
                alert('Berhasil Login');
                document.location = 'index.php';
            </script>
            ";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
</body>

</html>