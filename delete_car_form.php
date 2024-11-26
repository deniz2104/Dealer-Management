<?php
//TODO: sa intreb daca e sigur ca vrea sa stearga (tot un fel de alertbox)
//TODO:textbox uri in care sa adaug si el sa mi afiseze un rezulat/mai mutle
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);
$query="SELECT ID_MASINA,MARCA,MODEL FROM masini";
$result = $conexiune->query($query);
if(!$result){
   die("Error: ".mysqli_error($conexiune));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Delete Cars</title>
</head>

<header>
        <nav class="navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
    <?php elseif ($is_seller): ?>
        <li><a href="seller_dashboard.php" class="btn">Seller Dashboard</a></li>
    <?php endif; ?>
    <li><a href="table_of_cars.php">Cars list</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="container">
    <div class="content">
    <form action="delete.php" method="post">
        <h3>Delete <span>car</span></h3>

        <h3>ID <span>Masina:</span></h3>
        <input type="text" name="id_masina" required placeholder="xx" autocomplete="off">
        <button type="submit" class="btn">Delete car</button>
        <h3>Want to register a car?<a href="car_register_form.php"><span>Register car</span></a></h3>
    </form>
</div>
</div>
</body>

</html>