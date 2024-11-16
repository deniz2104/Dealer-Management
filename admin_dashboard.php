<?php
//TODO: sa pot sterge o masina inregistrata
//TODO: sa pot sterge un angajat dar nu ma pot da pe mine afara
//TODO: sa am un fel de meniu din care mi aleg ce doresc sa sterg 
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

<div class="container">

<div class="content">
   <h3>Hi, <span>admin</span></h3>
   <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span></h1>   
   <a href="dealer_auto.php" class="btn">Login</a>
   <a href="register_form.php" class="btn">Register a dealer</a>
   <a href="car_register_form.php" class="btn">Register a car</a>
   <a href="delete_car_form.php" class="btn">Delete a car</a>
   <a href="delete_dealer_form.php" class="btn">Delete a dealer</a>
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