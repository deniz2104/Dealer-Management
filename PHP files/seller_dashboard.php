<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name'])){
   header('location:dealer_auto.php');
   exit();  
}
?>

<header>
    <nav class="hidden-homepage navbar">
        <ul>
            <li> <a href="#"><span></span>Register +</a>
                    <ul>
                        <li><a href="car_register_form.php"><span></span>car</a></li>
                        <li><a href="transaction_register_form.php"><span></span>transaction</a></li>
                    </ul>
            </li>
            <li><a href="delete_car_form.php"><span></span>Delete a car</a></li>
            <li><a href="edit_car_form.php"><span></span>Edit a car</a></li>
        </ul>
    </nav>
</header>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Seller Page</title>
</head>

<body>
    <style>
        .loader:before {
            content: "Welcome Seller";
        }
    </style>

    <div class="loader"></div>

    <div class="hidden-homepage container">

        <div class="content">
            <h3>Hi, <span>seller</span></h3>
            <h1>Welcome, <span>
                    <?php echo htmlspecialchars($_SESSION['seller_name']); ?>
                </span></h1>
            <a href="homepage.php" class="btn">Homepage</a>
            <a href="upgrade_role_form.php" class="btn">Upgrade to admin role</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        let contor_seller = parseInt(sessionStorage.getItem('contor_seller')) || 0;

        contor_seller++;
        sessionStorage.setItem('contor_seller', contor_seller);

        if (contor_seller === 1) {
            $('.loader').fadeIn(1500, function () {
                setTimeout(function () {
                    $('.loader').fadeOut(1500, function () {
                        $('.navbar').removeClass('hidden-homepage').addClass('visible');
                        $('.container').removeClass('hidden-homepage').addClass('visible');
                    });
                }, 1500);
            });
        } else {
            $('.loader').hide();
            $('.navbar').removeClass('hidden-homepage').addClass('visible');
            $('.container').removeClass('hidden-homepage').addClass('visible');
        }

        document.getElementById('logout').addEventListener("click", function () {
            sessionStorage.clear();
        });
    });
</script>
</body>

</html>