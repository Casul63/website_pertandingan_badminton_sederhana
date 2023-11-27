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

if (isset($_POST['create_wasit'])) {
    $nama_wasit = $_POST['nama_wasit'];
    $password = $_POST['password'];
    $kunci = "projek_responsi_";
    $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $kunci, 0, $kunci);

    $sql = "INSERT into wasit (nama_wasit, password) VALUES ('$nama_wasit', '$encrypted_password');";
    $result = mysqli_query($koneksi, $sql);

    echo "
        <script>
            document.location = '../admin.php';
        </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Wasit</title>
</head>

<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Nama Wasit</td>
                <td>:</td>
                <td><input type="text" name="nama_wasit"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="create_wasit" value="Create wasit"></td>
            </tr>
        </table>
    </form>
</body>

</html>