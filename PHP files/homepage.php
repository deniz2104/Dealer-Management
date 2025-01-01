<?php
@include 'config.php';
session_start();
@include('../Simple queries/query_homepage.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Dealer</title>
    <link rel="stylesheet" type="text/css" href="../Styles/homepage_style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/browse/@barba/core@2.10.3/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</head>

<body>
    <div class="hidden-homepage loader-wrapper">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <div class="hidden-homepage message" id="message">
        <h2>Welcome to Auto Dealer</h2>
    </div>
    <div class="hidden-homepage navbar">
        <header class="header">
            <nav class="navbar">
            <img src="/Photos/logo_firma_dealer.jpeg" class="logo">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="../HTML files/about.html">About</a></li>
                    <li><a href="../HTML files/services.html">Services</a></li>
                    <li><a href="../HTML files/contact.html">Contact</a></li>
                    <li><a href="../HTML files/reviews.html">Reviews</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="hidden-homepage content" id="blur">
        <h1>Auto Dealer</h1>
        <p>Welcome to our auto dealership! We offer a wide range of cars, from luxury to budget.
            <br>We're always here
            to help you find the perfect car for your needs.
        </p>
        <div>
            <a href="#" class="btn" onclick="openModal()"><span></span> Our cars</a>
            <a href="login_client.php" class="btn"><span></span>Login as client</a>
            <a href="dealer_auto.php" class="btn"><span></span>Login as dealer</a>
        </div>
    </div>
    <div id="pop-up-car-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>MARCA</th>
                        <th>MODEL</th>
                        <th>PRET</th>
                        <th>AN FABRICATIE</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row['Brand']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['Model']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['Price']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['YEAR_OF_FABRICATION']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal()" class="btn">Close</a>
    </div>
    <script>
    var blur=document.getElementById('blur');
    $('.loader-wrapper').removeClass('hidden-homepage').addClass('visible');
    $('#message').removeClass('hidden-homepage').addClass('visible');
    $(document).ready(function () {
        let contor_home = parseInt(sessionStorage.getItem('contor_home')) || 0;

        contor_home++;
        sessionStorage.setItem('contor_home', contor_home);

        if (contor_home === 1) {
     		setTimeout(function () {
                $('#message').fadeOut(2500, function () {
                    setTimeout(function () {
                        $('.loader-wrapper').fadeOut(1500, function () {
                            $('.navbar').removeClass('hidden-homepage').addClass('visible');
                            $('.content').removeClass('hidden-homepage').addClass('visible');
                        });
                    }, 1500);
                });
            }, 1);
        } else {
            $('.loader-wrapper').hide();
            $('#message').hide();
            $('.navbar').removeClass('hidden-homepage').addClass('visible');
            $('.content').removeClass('hidden-homepage').addClass('visible');
        }
    });
    function openModal() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-car-list').style.display = 'block';
        }

    function closeModal() {
            document.getElementById('pop-up-car-list').style.display = 'none';
            blur.classList.remove('active_element');
        }
</script>
</body>

</html>