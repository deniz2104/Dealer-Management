<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:dealer_auto.php');
    exit();  
 }
//TODO: un ajax pentru autcomplete la nume prenume si id
list($admin_nume,$admin_prenume)=explode(' ',$_SESSION['admin_name'],2);
$query_1="SELECT ID_VANZATOR,NUME, PRENUME, EMAIL, role FROM vanzatori WHERE NUME != ? OR PRENUME != ?";
$stmt = $conexiune->prepare($query_1);
$stmt->bind_param("ss", $admin_nume, $admin_prenume);
$stmt->execute();

$result_1=$stmt->get_result();

if(!$result_1){
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
    <title>Delete Dealer</title>
</head>


<header>
        <nav class="hidden-homepage navbar">
            <ul>
            <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
            <li><a href="#" onclick="openModal_dealer()"><span></span>Dealers list</a></li>
            </ul>
        </nav>
</header>

<body>
<div class="hidden-homepage container">
    <div class="content" id="blur">
    <form action="delete_dealer.php" method="post" class="style-form" onsubmit="return cofirmDelete()">
        <h3>Delete <span>dealer</span></h3>

        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele" autocomplete="off">
        

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele" autocomplete="off">

        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="..." autocomplete="off">
        <br>
        <button type="submit" class="btn">Delete dealer</button>
        <h3>Want to register a dealer?<a href="register_form.php"><span>Register dealer</span></a></h3>
    </form>
    </div>
</div>
<div id="pop-up-dealer-list">
        <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
                <tbody>
                    <?php while ($row_1 = $result_1->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row_1['ID_VANZATOR']);?></td>
                        <td><?php echo htmlspecialchars($row_1['NUME']); ?></td>
                        <td><?php echo htmlspecialchars($row_1['PRENUME']); ?></td>
                        <td><?php echo htmlspecialchars($row_1['EMAIL']); ?></td>
                        <td><?php echo htmlspecialchars($row_1['role']);?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
        </table>
        </div>
    <a href="#" onclick="closeModal_dealer()" class="btn">Close</a>
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

        function openModal_dealer() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-dealer-list').style.display = 'block';
        }

        function closeModal_dealer() {
            document.getElementById('pop-up-dealer-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function cofirmDelete() {
            return confirm("Are you sure you want to delete this dealer?");
        }
    </script>
</body>

</html>