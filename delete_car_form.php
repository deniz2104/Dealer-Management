<?php
//TODO: back button
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

<body>
<div class="container">
    <div class="content">
    <form action="delete.php" method="post">
        <h3>Delete <span>car</span></h3>

        <h3>ID <span>Masina:</span></h3>
        <input type="text" name="id_masina" required placeholder="xx">
        <button type="submit" class="btn">Delete car</button>
        <h3>Want to register a car?<a href="car_register_form.php"><span>Register car</span></a></h3>
    </form>
    <div class="table-container">
   <table>
        <thead>
            <tr>
                <th>ID_Masina</th>
                <th>Marca</th>
                <th>Model</th>
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
</div>
<?php if ($is_admin): ?>
        <a href="admin_dashboard.php" class="btn">Back to Admin Dashboard</a>
    <?php elseif ($is_seller): ?>
        <a href="seller_dashboard.php" class="btn">Back to Seller Dashboard</a>
    <?php endif; ?>
</div>
</body>

</html>