<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:dealer_auto.php');
    exit();  
 }
//TODO: sa intreb daca e sigur ca vrea sa stearga (tot un fel de alertbox)
//TODO: un ajax pentru autcomplete la nume prenume si id
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Delete Dealer</title>
</head>


<header>
        <nav class="navbar">
            <ul>
            <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
            <li><a href="table_of_dealers.php"><span></span>Dealers list</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="container">
    <div class="content">
    <form action="delete_dealer.php" method="post" class="style-form">
        <h3>Delete <span>dealer</span></h3>

        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele" autocomplete="off">
        

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele" autocomplete="off">

        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="..." autocomplete="off">
        <button type="submit" class="btn">Delete dealer</button>
        <h3>Want to register a dealer?<a href="register.php"><span>Register dealer</span></a></h3>
    </form>
    </div>
</div>
</body>

</html>