<?php
//TODO: sa intreb daca e sigur ca vrea sa stearga (tot un fel de alertbox)
//TODO: un ajax pentru autcomplete la id
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);

$query="SELECT ID_MASINA,MARCA,MODEL,AN_FABRICATIE,PRET FROM masini";
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Delete Cars</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
    <?php elseif ($is_seller): ?>
        <li><a href="seller_dashboard.php" class="btn"><span></span>Seller Dashboard</a></li>
    <?php endif; ?>
    <li><a href="#" onclick="openModal()"><span></span>Cars list</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="hidden-homepage container">
    <div class="content" id="blur">
    <form action="delete.php" method="post" class="style-form">
        <h3>Delete <span>car</span></h3>

        <h3>ID <span>Masina:</span></h3>
        <input type="text" name="id_masina" required placeholder="xx" autocomplete="off">
        <br>
        <button type="submit" class="btn">Delete car</button>
        <h3>Want to register a car?<a href="car_register_form.php"><span>Register car</span></a></h3>
    </form>
</div>
</div>
<div id="pop-up-car-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID_MASINA</th>
                        <th>MARCA</th>
                        <th>MODEL</th>
                        <th>AN FABRICATIE</th>
                        <th>PRET</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row['ID_MASINA']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['MARCA']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['MODEL']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['AN_FABRICATIE']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['PRET']);?>
                        </td>
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