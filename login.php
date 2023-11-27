<?php
require_once 'koneksi.php';
session_start();

if (isset($_POST['login'])) {

    $nama = $_POST['nama_login'];
    $password = $_POST['password_login'];
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

    // var_dump($nama);

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
                document.location = 'schedule.php';
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
                document.location = 'schedule.php';
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
                document.location = 'schedule.php';
            </script>
            ";
        }
    }
}

if (isset($_POST['register'])) {
    $nama = $_POST['nama_register'];
    $password = $_POST['password_register'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password != $confirm_password) {
        echo "
        <script>
            alert('Password Salah');
            document.location = 'login.php';
        </script>
        ";
    }

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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <input type="checkbox" id="signup_toggle">
        <form class="form" action="" method="post">
            <div class="form_front">
                <p class="title">Login</p>
                <input placeholder="Username" class="username input" type="text" name="nama_login" id="username_login">
                <input placeholder="Password" class="password input" type="password" name="password_login" id="password">
                <button class="btn" type="submit" name="login">Login</button>
                <span class="switch">Don't have an account?
                    <label class="signup_tog" for="signup_toggle">
                        Sign Up
                    </label>
                </span>

            </div>
            <div class="form_back">
                <p class="title">Sign Up</p>
                <input placeholder="Username" class="username input" type="text" name="nama_register" id="username_register">
                <input placeholder="Password" class="password input" type="password" name="password_register" id="password">
                <input placeholder="Confirm Password" class="confirm_password input" type="password" name="confirm_password" id="confirm">
                <label for="role">Choose your role:</label>
                <select id="role" name="role">
                    <option value="penonton" name='role'>Penonton</option>
                    <option value="pemain" name='role'>Pemain</option>
                    <option value="wasit" name='role'>Wasit</option>
                </select>
                <button class="btn" type="submit" name="register">Sign Up</button>
                <span class="switch">Already have an account?
                    <label class="signup_tog" for="signup_toggle">
                        Sign In
                    </label>
                </span>
            </div>
        </form>
    </div>

    <script>
        function validasi() {
            var validasiHuruf = /^[a-zA-Z ]+$/;
            var username_login = document.getElementById("username_login");
            var username_register = document.getElementById("username_register");
            if (username_login.value.match(validasiHuruf)) {
                return true;
            } else {
                alert("Can't Input Any Number or Character!");
                username_login.value = username_login.value.replace(/[^a-zA-Z ]/, '');
                return false;
            }
            if (username_register.value.match(validasiHuruf)) {
                return true;
            } else {
                alert("Can't Input Any Number or Character!");
                username_register.value = username_register.value.replace(/[^a-zA-Z ]/, '');
                return false;
            }
        }
    </script>
</body>

</html>