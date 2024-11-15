<?php
//TODO: sa pot sterg o inregistrare a unei masini anume
//TODO: sa am buton de upgrade
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name'])){
   header('location:dealer_auto.php');
   exit();  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Seller Page</title>
</head>
<body>

<div class="container">

<div class="content">
   <h3>Hi, <span>seller</span></h3>
   <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['seller_name']); ?></span></h1>  
   <a href="dealer_auto.php" class="btn">Login</a>
   <a href="car_register_form.php" class="btn">Register a car</a>
   <a href="logout.php" class="btn">Logout</a>
</div>

</div>
</body>
</html>