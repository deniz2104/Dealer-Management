<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Dealer</title>
    <link rel="stylesheet" type="text/css" href="homepage_style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
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
                <img src="logo.jpg" class="logo">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="reviews.html">Reviews</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="hidden-homepage content">
        <h1>Auto Dealer</h1>
        <p>Welcome to our auto dealership! We offer a wide range of cars, from luxury to budget.
            <br>We're always here
            to help you find the perfect car for your needs.
        </p>
        <div>
            <a href="cars_list.php" class="btn"><span></span> Our cars</a>
            <a href="login_client.php" class="btn"><span></span>Login as client</a>
            <a href="dealer_auto.php" class="btn"><span></span>Login as dealer</a>
        </div>
    </div>

    <script>
        let cont = 0;
        $('.loader-wrapper').removeClass('hidden-homepage').addClass('visible');
        $('#message').removeClass('hidden-homepage').addClass('visible');
        window.onload = () => {
            sessionStorage.setItem('animationPlayed', 'false');
            setTimeout(function () {
                $('#message').fadeOut(2500, function () {
                    setTimeout(function () {
                        $('.loader-wrapper').fadeOut(1500, function () {
                            $('.navbar').removeClass('hidden-homepage').addClass('visible');
                            $('.content').removeClass('hidden-homepage').addClass('visible');
                            sessionStorage.setItem('animationPlayed', 'true');
                            sessionStorage.setItem('contor', (parseInt(sessionStorage.getItem('contor')) || 0) + 1);
                        });
                    }, 1500);
                });
            }, 1);
            window.onbeforeunload = function () {
                sessionStorage.clear();
            };
            if (sessionStorage.getItem('contor') >= 1 && sessionStorage.getItem('animationPlayed') === 'false') {
                $('.loader-wrapper').addClass('hidden-homepage');
                $('#message').addClass('hidden-homepage');
            }
        };
    </script>
</body>

</html>