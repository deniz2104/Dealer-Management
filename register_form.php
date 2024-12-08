<?php
session_start();
@include 'config.php';

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
    header('location:dealer_auto.php');
    exit();  
 }

$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);
//TODO: Un ajax in care sa sugerez id ul
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Register Dealer</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php"><span></span>Back to Dashboard</a></li>
    <?php else: ?>
        <li><a href="homepage.php" class="btn"><span></span>Homepage</a></li>
    <?php endif; ?>
            </ul>
        </nav>
</header>

<body>
    <div class="hidden-homepage register-form">
    <form action="register.php" method="post" class="style-form">
        <h1>Register</h1>
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele" autocomplete="off">
        

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele" autocomplete="off"> 
        

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="example@gmail.com" autocomplete="off">
        

        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="..." autocomplete="off">
        

        <label for="id_masina">ID_Masina:</label>
        <input type="text" name="id_masina" id="id_masina" required placeholder="..." autocomplete="off">

        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="seller">Seller</option>
        </select>
        <button type="submit" class="btn">Register</button>
        <p>Already a member?<a href="dealer_auto.php">Log in</a></p>
    </form>
    </div>
    <script>
$(document).ready(function () {
            setTimeout(function () {
                setTimeout(function () {
                    $('.navbar').removeClass('hidden-homepage').addClass('visible');
                    $('.register-form').removeClass('hidden-homepage').addClass('visible');
                });
            }, 1);
        }, 1);
    </script>
</body>

</html>