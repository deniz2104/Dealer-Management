<?php
@include 'config.php';
session_start();
//TODO: sa am o chestie de genul 5 itemi per pagina si sa pot da pagina spre exemplu
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
    <link rel="stylesheet" type="text/css" href="styles_for_tables.css">
    <title>List of cars</title>
</head>
<body>

<header>
    <nav class="navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
    <?php elseif ($is_seller): ?>
        <li><a href="seller_dashboard.php" class="btn">Seller Dashboard</a></li>
    <?php endif; ?>
            </ul>
    </nav>
</header>

<div class="container">
   <table>
        <thead>
            <tr>
                <th>ID_MASINA</th>
                <th>MARCA</th>
                <th>MODEL</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID_MASINA']); ?></td>
                    <td><?php echo htmlspecialchars($row['MARCA']); ?></td>
                    <td><?php echo htmlspecialchars($row['MODEL']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
   </div>    
</body>
</html>