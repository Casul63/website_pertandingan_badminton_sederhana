<?php
require_once 'koneksi.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


function informasi()
{
    if (isset($_SESSION['username'])) {
        echo "
        $_SESSION[role] $_SESSION[username] 
        ";
    } else {
        echo "Guest";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <link rel="stylesheet" type="text/css" href="sidebar.css">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet'>
</head>

<body>
    <div class="containerside">
        <div class="sidebar hide" id="mySidebar">
            <div class="headerside">
                <div class="list-item">
                    <a href="#">
                        <span class="description-headerside">Hi,
                            <?php informasi() ?>
                            !</span>
                    </a>
                </div>
                <hr />
            </div>
            <div class="main">
                <div class="list-item">
                    <a href="index.php">
                        <img src="FE/img/sidebar/home.png" alt="" class="iconside">
                        <span class="descriptionside"><a href="index.php" class="descriptionside">Home</a></span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="schedule.php">
                        <img src="FE/img/sidebar/schedule.png" alt="" class="iconside">
                        <span class="descriptionside"><a href="schedule.php" class="descriptionside">Schedule</a></span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="">
                        <img src="FE/img/sidebar/logout.png" alt="" class="iconside">
                        <span><a href="logout.php" class="descriptionside">Logout</a></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="sidebar.js"></script>
</body>

</html>