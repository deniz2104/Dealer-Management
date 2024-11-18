<?php
//TODO: sa nu ma pot sterge pe mine
//TODO: sa nu ma pot vizualiza
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:dealer_auto.php');
    exit();  
 }
 
$query="SELECT ID_VANZATOR,NUME,PRENUME FROM vanzatori";
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
    <title>Delete Dealer</title>
</head>

<body>
<div class="container">
    <div class="content">
    <form action="delete_dealer.php" method="post">
        <h3>Delete <span>dealer</span></h3>

        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele">
        

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele">

        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="...">
        <button type="submit" class="btn">Delete dealer</button>
        <h3>Want to register a dealer?<a href="register.php"><span>Register dealer</span></a></h3>
    </form>
    <div class="table-container">
   <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nume</th>
                <th>Prenume</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID_VANZATOR']); ?></td>
                    <td><?php echo htmlspecialchars($row['NUME']); ?></td>
                    <td><?php echo htmlspecialchars($row['PRENUME']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
   </div>
    </div>
<h3>Want to go back?<a href="admin_dashboard.php"><span>◀️</span></a></h3>
</div>
</body>

</html>