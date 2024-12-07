<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Edit Cars</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
    <?php elseif ($is_seller): ?>
        <li><a href="seller_dashboard.php" class="btn"><span></span>Seller Dashboard</a></li>
    <?php endif; ?>
    <li><a href="table_of_cars.php"><span></span>Cars list</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="hidden-homepage container">
    <div class="content">
    <form action="edit.php" method="post" class="style-form">
        <h3>Edit <span>car</span></h3>

        <h3>ID <span>Masina:</span></h3>
        <input type="text" name="id_masina" required placeholder="xx" autocomplete="off">
        <br>
        <h3><span>Pret:</span></h3>
        <input type="number" name="pret" required placeholder="$$$$$" autocomplete="off">
        <br>
        <button type="submit" class="btn">Edit price</button>
        <h3>Want to register a car?<a href="car_register_form.php"><span>Register car</span></a></h3>
    </form>
</div>
</div>
<script>
$(document).ready(function () {
            setTimeout(function () {
                setTimeout(function () {
                    $('.navbar').removeClass('hidden-homepage').addClass('visible');
                    $('.container').removeClass('hidden-homepage').addClass('visible');
                });
            }, 1);
        }, 1);
    </script>
</body>

</html>