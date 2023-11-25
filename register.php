<?php
require_once 'koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $kunci = "projek_responsi_";

    $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $kunci, 0, $kunci);

    if ($role == 'pemain') {
        $sql = "INSERT INTO pemain (nama_pemain, password) VALUES ('$nama', '$encrypted_password');";
    } elseif ($role == 'wasit') {
        $sql = "INSERT INTO wasit (nama_wasit, password) VALUES ('$nama', '$encrypted_password');";
    } elseif ($role == 'penonton') {
        $sql = "INSERT INTO penonton (nama_penonton, password) VALUES ('$nama', '$encrypted_password');";
    } else {
        echo "
        <script>
            alert('Gagal Registrasi!');
            document.location = 'register.php';
        </script>
        ";
    }

    $result = mysqli_query($koneksi, $sql);

    echo "
        <script>
            document.location = 'login.php';
        </script>
        ";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        table {
            margin: auto;
            margin-top: 300px;
        }
    </style>
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
                <td>Role</td>
                <td>:</td>
                <td>
                    <label><input type="radio" value="pemain" name="role">Pemain</label>
                    <label><input type="radio" value="wasit" name="role">Wasit</label>
                    <label><input type="radio" value="penonton" name="role">Penonton</label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="register" value="Register"></td>
            </tr>
        </table>
    </form>
</body>

</html>