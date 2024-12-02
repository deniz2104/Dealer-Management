<?php
//TODO: sa am o chestie de genul 5 itemi per pagina si sa pot da pagina spre exemplu
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}

list($admin_nume,$admin_prenume)=explode(' ',$_SESSION['admin_name'],2);
$query = "SELECT NUME, PRENUME, EMAIL FROM vanzatori WHERE NUME != ? AND PRENUME != ?";
$stmt = $conexiune->prepare($query);
$stmt->bind_param("ss", $admin_nume, $admin_prenume);
$stmt->execute();

$result = $stmt->get_result();
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
    <title>List of dealers</title>
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
   <script>console.log($admin_name,$admin_prenume);</script>
</body>
</html>