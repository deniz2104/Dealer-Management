<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
//TODO: la fiecare tranzitie cand vine sa am grija sa nu mai am overflow
//TODO: cand dau logout sa nu mai am loader ul
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Admin Page</title>
</head>
<body>

<div class="loader"></div>

<header>
        <nav class="hidden-homepage navbar">
            <ul>
                <li> <a href="table_of_cars.php"><span></span>Cars list</a></li>
                <li> <a href="table_of_dealers.php"><span></span>Dealers list</a></li>
                <li> <a href="#"><span></span>Register +</a>
                    <ul>
                        <li><a href="car_register_form.php"><span></span>car</a></li>
                        <li><a href="register_form.php"><span></span>dealer</a></li>
                    </ul>
                </li>
                <li> <a href="#"><span></span>Delete +</a>
                    <ul>
                        <li><a href="delete_car_form.php"><span></span>car</a></li>
                        <li><a href="delete_dealer_form.php"><span></span>dealer</a></li>
                    </ul>
                </li>

                <li> <a href="#"><span></span>Edit +</a>
                    <ul>
                        <li><a href="edit_car_form.php"><span></span>car</a></li>
                        <li><a href="edit_services_form.php"><span></span>services</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
</header>

<div class="hidden-homepage container">

<div class="content">
   <h3>Hi, <span>admin</span></h3>
   <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span></h1>   
   <a href="homepage.php" class="btn">Homepage</a>
   <a href="logout.php" class="btn" id="logout">Logout</a>
</div>

</div>
<script>
    $(document).ready(function () {
        let contor_admin = parseInt(sessionStorage.getItem('contor_admin')) || 0;

        contor_admin++;
        sessionStorage.setItem('contor_admin', contor_admin);

        if (contor_admin === 1) {
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
            contor = parseInt(sessionStorage.getItem('contor')) || 0;
            contor++;
            sessionStorage.setItem('contor', contor);
            
            contor_home = parseInt(sessionStorage.getItem('contor_home')) || 0;
            contor_home++;
            sessionStorage.setItem('contor_home', contor_home);
        });
    });
</script>

</body>
</html>