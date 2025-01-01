<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);
//TODO: Un ajax in care sa sugerez id ul la fel ca la celelate
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wanth=device-wanth, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Register transactions</title>
</head>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
            <?php if ($is_admin): ?>
        <li><a href="admin_dashboard.php"><span></span>Admin Dashboard</a></li>
    <?php elseif ($is_seller): ?>
        <li><a href="seller_dashboard.php" class="btn"><span></span>Seller Dashboard</a></li>
    <?php endif; ?>
            </ul>
        </nav>
</header>

<body>
    <div class="hidden-homepage content-transaction-register">
    <form action="transaction_register.php" method="post" class="style-form">
        <h1>Register transaction</h1>
        <label for="id_tranzactie">ID_TRANZACTIE:</label>
        <input type="text" name="id_tranzactie" an="id_tranzactie" required placeholder="Introduceti ID-ul tranzactiei" autocomplete="off">
        

        <label for="id_client">ID_CLIENT:</label>
        <input type="text" name="id_client" an="id_client" required placeholder="Introduceti ID-ul ciientului" autocomplete="off">
        

        <label for="id_masina">ID_MASINA:</label>
        <input type="number" name="id_masina" an="id_masina" required placeholder="Introduceti ID-ul masinii" autocomplete="off">
        
        <label for="id_vanzator">ID_VANZATOR:</label>
        <input type="text" name="id_vanzator" an="id_vanzator" required placeholder="Introduceti ID-ul vanzatorului" autocomplete="off">
    
        <label for="data_tranzactie">Data:</label>
        <input type="date" name="data_tranzactie" an="data_tranzactie" required placeholder="75000$" autocomplete="off">

        <button type="submit" class="btn">Register</button>
    </form>
    </div>
    <script>
    $(document).ready(function () {
            setTimeout(function () {
                setTimeout(function () {
                    $('.navbar').removeClass('hidden-homepage').addClass('visible');
                    $('.content-transaction-register').removeClass('hidden-homepage').addClass('visible');
                });
            }, 1);
        }, 1);
    </script>
</body>

</html>