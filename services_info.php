<?php
@include 'config.php';
session_start();
//TODO: sa am o chestie de genul 5 itemi per pagina si sa pot da pagina spre exemplu
if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$query="SELECT ID_SERVICIU,ID_MASINA,COST,DATA_SERVICIULUI FROM servicii";
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
    <title>Services information</title>
</head>
<body>

<header>
    <nav class="navbar">
            <ul>
        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            </ul>
    </nav>
</header>

<div class="container">
   <table>
        <thead>
            <tr>
                <th>ID_SERVICIU</th>
                <th>ID_MASINA</th>
                <th>COST</th>
                <th>DATA</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID_SERVICIU']);?></td>
                    <td><?php echo htmlspecialchars($row['ID_MASINA']); ?></td>
                    <td><?php echo htmlspecialchars($row['COST']);?></td>
                    <td><?php echo htmlspecialchars($row['DATA_SERVICIULUI']);?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
   </div>    
</body>
</html>