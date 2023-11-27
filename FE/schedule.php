<?php
require_once 'koneksi.php';
session_start();

$sql = "SELECT pertandingan.id_pertandingan, pertandingan.nama_pertandingan, pertandingan.waktu_mulai, pertandingan.waktu_selesai, COALESCE(pemain1.nama_pemain, 'Kosong') AS nama_pemain_1, COALESCE(pemain2.nama_pemain, 'Kosong') AS nama_pemain_2, COALESCE(wasit.nama_wasit, 'Kosong') AS nama_wasit
        FROM pertandingan 
        LEFT JOIN pemain_pertandingan ON pertandingan.id_pertandingan = pemain_pertandingan.id_pertandingan
        LEFT JOIN pemain AS pemain1 ON pemain_pertandingan.id_pemain_1 = pemain1.id_pemain
        LEFT JOIN pemain AS pemain2 ON pemain_pertandingan.id_pemain_2 = pemain2.id_pemain
        LEFT JOIN wasit ON pertandingan.id_wasit = wasit.id_wasit
        ORDER BY pertandingan.id_pertandingan ASC;";

$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Schedule</title>
    <link rel="stylesheet" type="text/css" href="schedule.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="content" id="content">
        <?php include "sidebar.php"; ?>
        <section class="section__container explore__container">
            <div class="container">
                <div class="square">
                    <span style="--i:0;"></span>
                    <span style="--i:1;"></span>
                    <span style="--i:2;"></span>
                    <span style="--i:3;"></span>
                </div>
                <div class="square">
                    <span style="--i:0;"></span>
                    <span style="--i:1;"></span>
                    <span style="--i:2;"></span>
                    <span style="--i:3;"></span>
                </div>
                <div class="square">
                    <span style="--i:0;"></span>
                    <span style="--i:1;"></span>
                    <span style="--i:2;"></span>
                    <span style="--i:3;"></span>
                </div>
            </div>
            <div class="explore__header">
                <h1 class="section__header">MATCH SCHEDULE </h1>
                <div class="explore__nav">
                    <span><i class="ri-arrow-left-line"></i></span>
                    <span><i class="ri-arrow-right-line"></i></span>
                </div>
            </div>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='explore__grid'>
                <div class='explore__card'>
                    <h4>MATCH $i</h4>
                    <table>
                        <tr>
                            <td>Nama Pertandingan</td>
                            <td>:</td>
                            <td>$row[nama_pertandingan]</td>
                        </tr>
                        <tr>
                            <td>Nama Pemain 1</td>
                            <td>:</td>
                            <td>$row[nama_pemain_1]</td>
                        ";
                echo "
                        </tr>
                        <tr>
                            <td>Nama Pemain 2</td>
                            <td>:</td>
                            <td>$row[nama_pemain_2]</td>
                        </tr>
                        <tr>
                            <td>Nama Wasit</td>
                            <td>:</td>
                            <td>$row[nama_wasit]</td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td>$row[waktu_mulai]<br>$row[waktu_selesai]</td>
                        </tr>
                    </table>
                    <a href='join.php?id_pertandingan=$row[id_pertandingan]'>Join Now <i class='ri-arrow-right-line'></i></a>
                </div>
                ";
                $i++;
            }

            ?>
    </div>
    </section>
    </div>
    <script src="sidebar.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentIndex = 0;

            function showCards() {
                const cards = document.querySelectorAll('.explore__card');
                cards.forEach((card, index) => {
                    if (index === currentIndex || index === currentIndex + 1 || index === currentIndex + 2) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            function nextCard() {
                const cards = document.querySelectorAll('.explore__card');
                if (currentIndex < cards.length - 3) {
                    currentIndex++;
                    showCards();
                    scrollToNextCard();
                }
            }

            function prevCard() {
                if (currentIndex > 0) {
                    currentIndex--;
                    showCards();
                    scrollToPrevCard();
                }
            }

            function scrollToNextCard() {
                const cards = document.querySelectorAll('.explore__card');
                const nextCard = cards[currentIndex + 2];
                nextCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }

            function scrollToPrevCard() {
                const cards = document.querySelectorAll('.explore__card');
                const prevCard = cards[currentIndex];
                prevCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }

            // Tampilkan tiga card pertama saat halaman dimuat
            showCards();

            const exploreNav = document.querySelector('.explore__nav');
            const prevButton = exploreNav.querySelector('.ri-arrow-left-line');
            const nextButton = exploreNav.querySelector('.ri-arrow-right-line');

            prevButton.addEventListener('click', prevCard);
            nextButton.addEventListener('click', nextCard);
        });
    </script>

</body>

</html>