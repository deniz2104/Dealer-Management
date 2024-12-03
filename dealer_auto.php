<?php
session_start();
@include 'config.php';

if (isset($_SESSION['admin_name'])){
    header('location:admin_dashboard.php');
    exit();
} elseif (isset($_SESSION['seller_name'])) {
    header('location:seller_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<!TODO: Loader pentru o prima pagina>
<!TODO: In loc de alert din javascript sa fac un alertbox tot js cusotmizat >
<!TODO: sa am real time fetching cand dau refresh>
<!TODO: animatii pentru fiecare pagina>
<!TODO: Loader diferit fata de cel din navigarea dintre pagini la dealeri>
<!TODO: Sa am o pagina modala pentru afisarea masinilor>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Log in Form</title>
</head>
<div class="loader-wrapper">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<div class="message" id="message">
    <h2>Welcome Dealer!</h2>
</div>
<header>
    <nav class="hidden-homepage navbar">
        <ul>
            <li> <a href="homepage.php"><span></span>Homepage</a></li>
        </ul>
    </nav>
</header>
</div>

<body>
    <div class="hidden-homepage content">
        <form action="login.php" method="post" class="style-form">

            <h1>Log in</h1>
            <label for="nume">Nume:</label>
            <input type="text" name="nume" id="nume" required placeholder="Introduceti numele" autocomplete="off">
            <br>

            <label for="prenume">Prenume:</label>
            <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele"
                autocomplete="off">
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required placeholder="example@gmail.com" autocomplete="off">
            <br>


            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required placeholder="..." autocomplete="off">
            <br>

            <label>Role:</label>
            <br>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="seller">Seller</option>
            </select>
            <button type="submit" class="btn">Log in</button>
            <p>Don't have an account?<a href="register_form.php">Register now</a></p>
        </form>
    </div>
    <script>
        $(document).ready(function () {
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
        });
    </script>
</body>

</html>