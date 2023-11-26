<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Schedule</title>
    <link rel="stylesheet" type="text/css" href="schedule.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content" id="content">
        <?php include "sidebar.php";?>
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
                <h1 class="section__header">MATCH SCHEDULE</h1>
                <div class="explore__nav">
                    <span><i class="ri-arrow-left-line"></i></span>
                    <span><i class="ri-arrow-right-line"></i></span>
                </div>
            </div>
            <div class="explore__grid" id="cardContainer">
            <div class="explore__card">
                <h4>MATCH 1</h4>
                <table>
                    <tr>
                        <td>Nama Pemain 1</td>
                        <td>:</td>
                        <td></td>
                    </tr>   
                    <tr>
                        <td>Nama Pemain 2</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Wasit</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>waktu</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
                <a href="match1.php">Join Now <i class="ri-arrow-right-line"></i></a><br>
                <a href=""><button class="btn">Edit</button></a>
                <a href=""><button class="btn">Delete</button></a>
                </div>
                <div class="explore__card">
                <h4>MATCH 2</h4>
                <table>
                    <tr>
                        <td>Nama Pemain 1</td>
                        <td>:</td>
                        <td></td>
                    </tr>   
                    <tr>
                        <td>Nama Pemain 2</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Wasit</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>waktu</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
                <a href="match2.php">Join Now <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="explore__card">
                <h4>MATCH 3</h4>
                <table>
                    <tr>
                        <td>Nama Pemain 1</td>
                        <td>:</td>
                        <td></td>
                    </tr>   
                    <tr>
                        <td>Nama Pemain 2</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Wasit</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>waktu</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
                <a href="match3.php">Join Now <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="explore__card">
            </div>
            <button class="btn add__btn" id="addMatchBtn">Tambah Match</button>
        </section>
    </div>
    <script src="sidebar.js"></script>
        <script>
    document.addEventListener("DOMContentLoaded", function () {
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
            nextCard.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }

        function scrollToPrevCard() {
            const cards = document.querySelectorAll('.explore__card');
            const prevCard = cards[currentIndex];
            prevCard.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }

        const cardContainer = document.getElementById('cardContainer');
        const addMatchBtn = document.getElementById('addMatchBtn');
        const exploreNav = document.querySelector('.explore__nav');
        const leftArrow = exploreNav.querySelector('.ri-arrow-left-line');
        const rightArrow = exploreNav.querySelector('.ri-arrow-right-line');

        function createNewCard() {
            const newCard = document.createElement('div');
            newCard.classList.add('explore__card');
            newCard.innerHTML = `
                <h4><input type='text' placeholder='nama match'></h4>
                <table>
                        <tr>
                            <td>Nama Pemain 1</td>
                            <td>:</td>
                            <td></td>
                        </tr>   
                        <tr>
                            <td>Nama Pemain 2</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nama Wasit</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>waktu Mulai</td>
                            <td>:</td>
                            <td><input type='time'></td>
                        </tr>
                        <tr>
                            <td>waktu Selesai</td>
                            <td>:</td>
                            <td><input type='time'></td>
                        </tr>
                </table>
                <a href=""><button class="btn">Submit</button></a>
            `;
            return newCard;
        }

        addMatchBtn.addEventListener('click', function () {
            // Create a new card and append it inside the cardContainer
            const newCard = createNewCard();
            cardContainer.appendChild(newCard);

            // Optional: Scroll to the new card
            newCard.scrollIntoView({ behavior: 'smooth', block: 'end' });
        });

        leftArrow.addEventListener('click', prevCard);
        rightArrow.addEventListener('click', nextCard);

        // Tampilkan tiga card pertama saat halaman dimuat
        showCards();
    });
    </script>
</body>
</html>

