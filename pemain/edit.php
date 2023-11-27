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

$id_edit = $_GET['id'];
$sql = "SELECT nama_pemain, password FROM pemain WHERE id_pemain = $id_edit";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$kunci = "projek_responsi_";
$decrypted_password = openssl_decrypt($row['password'], 'aes-256-cbc', $kunci, 0, $kunci);

if (isset($_POST['update_pemain'])) {
    $nama_pemain = $_POST['nama_pemain'];
    $password = $_POST['password'];
    $kunci = "projek_responsi_";
    $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $kunci, 0, $kunci);

    $sql = "UPDATE pemain SET nama_pemain = '$nama_pemain', password = '$encrypted_password' WHERE id_pemain = $id_edit;";
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
    <title>Create Pemain</title>
</head>

<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Nama Pemain</td>
                <td>:</td>
                <td><input type="text" name="nama_pemain" value="<?php echo $row['nama_pemain']; ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" value="<?php echo $decrypted_password; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="update_pemain" value="Update Pemain"></td>
            </tr>
        </table>
    </form>
</body>

</html>