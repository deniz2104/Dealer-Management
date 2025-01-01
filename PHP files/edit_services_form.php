<?php
@include 'config.php';
session_start();

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
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Edit Services</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
        <li><a href="#" onclick="openModal()"><span></span>Services info</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="hidden-homepage container">
    <div class="content" id="blur">
    <form action="edit_services.php" method="post" class="style-form">
        <h3>Edit <span>services</span></h3>
        <h3>ID <span>Serviciu:</span></h3>
        <input type="number" name="id_serviciu" required placeholder="xx" autocomplete="off">
        <h3>ID <span>Masina:</span></h3>
        <input type="number" name="id_masina" required placeholder="xx" autocomplete="off">
        <h3><span>Cost:</span></h3>
        <input type="number" name="cost" placeholder="$$$$$" autocomplete="off">
        <h3><span>Data:</span></h3>
        <input type="date" name="data" placeholder="2024-10-12" autocomplete="off">
        <br>
        <button type="submit" class="btn">Edit services</button>
    </form>
</div>
</div>
<div id="pop-up-car-list">
<div class="container-table">
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
   <a href="#" onclick="closeModal()" class="btn">Close</a>
</div>
<script>
var blur=document.getElementById('blur');
$(document).ready(function () {
            setTimeout(function () {
                setTimeout(function () {
                    $('.navbar').removeClass('hidden-homepage').addClass('visible');
                    $('.container').removeClass('hidden-homepage').addClass('visible');
                });
            }, 1);
        }, 1);

        function openModal() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-car-list').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('pop-up-car-list').style.display = 'none';
            blur.classList.remove('active_element');
        }
    </script>
</body>

</html>