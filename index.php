<?php
require_once 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Badminten</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="content" id="content">
        <?php include "sidebar.php"; ?>
        <header class="section__container header__container">
            <div class="header__content">
                <span class="bg__blur"></span>
                <span class="bg__blur header__blur"></span>
                <h4>UR BADMINTON PLATFORM</h4>
                <h1><span>THE</span> BADMINTEN</h1>
                <p>
                    It's all about badminton. If you love badminton, this is the right decision to click this website. Everything about badminton is right here only on The Badminten.
                </p>
                <a href="login.php"><button class="btn">Get Started</button></a>
            </div>
            <div class="header__image">
                <img src="img/content/home.png" alt="header">
            </div>
        </header>
    </div>
    <script src="sidebar.js"></script>
</body>

</html>