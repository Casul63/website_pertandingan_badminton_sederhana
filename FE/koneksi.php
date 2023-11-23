<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "website_pertandingan_badminton";

$koneksi = mysqli_connect($server, $username, $password, $db) or die("Gagal konek ke db");
