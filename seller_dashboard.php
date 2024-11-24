<?php
//TODO: Loader
//TODO: Sa nu afiseze numele cu care se conecteaza 
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$query="SELECT NUME,PRENUME,EMAIL FROM vanzatori";
$result = $conexiune->query($query);
if(!$result){
   die("Error: ".mysqli_error($conexiune));
}
?>

<header>
        <nav class="navbar">
            <ul>
                <li> <a href="table_of_cars.php">Cars list</a></li>
                <li><a href="car_register_form.php">Register a car</a></li>
                <li><a href="delete_car_form.php">Delete a car</a></li>
                <li><a href="edit_car_form.php">Edit a car</a></li>
            </ul>
        </nav>
</header>

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
   <a href="upgrade_role_form.php" class="btn">Upgrade to admin role</a>
   <a href="logout.php" class="btn">Logout</a>
</div>

</div>
</body>
</html>