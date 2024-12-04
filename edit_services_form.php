<?php
//TODO: sa intreb daca e sigur ca vrea sa stearga (tot un fel de alertbox)
//TODO: un ajax pentru autcomplete la id
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
    <title>Edit Services</title>
</head>

<header>
        <nav class="navbar">
            <ul>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
        <li><a href="services_info.php"><span></span>Services info</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="container">
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
</body>

</html>