<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Edit Services</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
        <li><a href="services_info.php"><span></span>Services info</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="hidden-homepage container">
    <div class="content">
    <form action="edit_services.php" method="post" class="style-form">
        <h3>Edit <span>services</span></h3>
        <h3>ID <span>Serviciu:</span></h3>
        <input type="number" name="id_serviciu" required placeholder="xx" autocomplete="off">
        <h3>ID <span>Masina:</span></h3>
        <input type="number" name="id_masina" required placeholder="xx" autocomplete="off">
        <h3><span>Cost:</span></h3>
        <input type="number" name="cost" placeholder="$$$$$" autocomplete="off">
        <h3><span>Data:</span></h3>
        <input type="date" name="data" placeholder="2024-10-12" autocomplete="off">
        <br>
        <button type="submit" class="btn">Edit services</button>
    </form>
</div>
</div>
<scipt>
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