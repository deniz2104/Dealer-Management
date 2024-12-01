<?php
//TODO: Loader
//TODO: Sa nu afiseze numele cu care se conecteaza 
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}

$query="SELECT NUME,PRENUME,EMAIL FROM vanzatori";
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
    <title>Admin Page</title>
</head>
<body>

<div class="loader"></div>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
                <li> <a href="table_of_cars.php"><span></span>Cars list</a></li>
                <li> <a href="table_of_dealers.php"><span></span>Dealers list</a></li>
                <li> <a href="#">Register +</a>
                    <ul>
                        <li><a href="car_register_form.php"><span></span>car</a></li>
                        <li><a href="register_form.php"><span></span>dealer</a></li>
                    </ul>
                </li>
                <li> <a href="#">Delete +</a>
                    <ul>
                        <li><a href="delete_car_form.php"><span></span>car</a></li>
                        <li><a href="delete_dealer_form.php"><span></span>dealer</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
</header>

<div class="hidden-homepage container">

<div class="content">
   <h3>Hi, <span>admin</span></h3>
   <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span></h1>   
   <a href="dealer_auto.php" class="btn">Login</a>
   <a href="edit_car_form.php" class="btn">Edit a car</a>
   <a href="logout.php" class="btn">Logout</a>
</div>

</div>
<script>
    $(document).ready(function () {
            setTimeout(function () {
                    setTimeout(function () {
                        $('.loader').fadeOut(1500, function () {
                            $('.navbar').removeClass('hidden-homepage').addClass('visible');
                            $('.container').removeClass('hidden-homepage').addClass('visible');
                        });
                    }, 1500);
                });
            }, 1);
</script>
</body>
</html>