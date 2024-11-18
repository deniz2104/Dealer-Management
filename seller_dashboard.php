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
   <a href="delete_car_form.php" class="btn">Delete a car</a>
   <a href="edit_car_form.php" class="btn">Edit a car</a>
   <a href="upgrade_role_form.php" class="btn">Upgrade to admin role</a>
   <a href="logout.php" class="btn">Logout</a>
   <div class="table-container">
   <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Prenume</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['NUME']); ?></td>
                    <td><?php echo htmlspecialchars($row['PRENUME']); ?></td>
                    <td><?php echo htmlspecialchars($row['EMAIL']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
   </div>
</div>

</div>
</body>
</html>