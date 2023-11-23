<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <title>match 2</title>
    <link rel="stylesheet" type="text/css" href="match.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content" id="content">
        <?php include "sidebar.php";?>
        <section class="section__container join__container">
        <div class="loader">
            <div class="face">
                <div class="circle"></div>
            </div>
            <div class="face">
                <div class="circle"></div>
            </div>
        </div>
            <h2 class="section__header">MATCH 2</h2>
            <div class="join__image">
                <img src="FE/img/match/match2.jpg" alt="Join" class="gambar"/>
                <div class="join__grid">
                <div class="join__card">
                    <div class="join__card__content">
                        <table>
                            <tr>
                                <td><h4>Nama Pemain 1</h4></td>
                                <td><h4>:</h4></td>
                                <td><h4></h4></td>
                            </tr>   
                            <tr>
                                <td><h4>Nama Pemain 2</h4></td>
                                <td><h4>:</h4></td>
                                <td><h4></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Nama Wasit</h4></td>
                                <td><h4>:</h4></td>
                                <td><h4></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Waktu Pertandingan</h4></td>
                                <td><h4>:</h4></td>
                                <td><h4></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    <script src="sidebar.js"></script>
</body>
</html>
