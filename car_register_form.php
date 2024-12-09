<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['seller_name']) && !isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
$is_admin = isset($_SESSION['admin_name']);
$is_seller = isset($_SESSION['seller_name']);
//TODO: Un ajax in care sa sugerez id ul
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Register Cars</title>
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
    <div class="hidden-homepage content-car-register">
    <form action="car_register.php" method="post" class="style-form">
        <h1>Register</h1>
        <label for="marca">Marca:</label>
        <input type="text" name="marca" an="marca" required placeholder="Introduceti marca" autocomplete="off">
        

        <label for="model">Model:</label>
        <input type="text" name="model" an="model" required placeholder="Introduceti modelul" autocomplete="off">
        

        <label for="capacitate cilindrica">Capacitate cilindrica:</label>
        <input type="number" name="capacitate cilindrica" an="capacitate cilindrica" required placeholder="1999 cm3" autocomplete="off">
        


        <label for="an">An:</label>
        <input type="text" name="an" an="an" required placeholder="2024" autocomplete="off">
        

        <label for="pret">Pret:</label>
        <input type="number" name="pret" an="pret" required placeholder="75000$" autocomplete="off">

        <label>ID_Masina:</label>
        <input type="text" name="id_masina" id="id_masina" required placeholder="xx" autocomplete="off">
        <div id="search_result" class="search-result"></div>
        <button type="submit" class="btn">Register</button>
        <p>Already having a car with a dealer assigned?<a href="dealer_auto.php">Log in</a></p>
        <p>Don't have a dealer for the car yet? <a href="register_form.php">Register dealer</a></p>
    </form>
    </div>
    <script>
    $(document).ready(function () {
            setTimeout(function () {
                setTimeout(function () {
                    $('.navbar').removeClass('hidden-homepage').addClass('visible');
                    $('.content-car-register').removeClass('hidden-homepage').addClass('visible');
                });
            }, 1);
            $('#id_masina').keyup(function(){
                var input=$(this).val();

                if(input !==""){
                    $.ajax({
                        url:'get_unsed_ids.php',
                        method:'POST',
                        data:{term:input},
                        success:function(data){
                            $('#search_result').html(data).show();
                        },
                        error: function () {
                        console.error('An error occurred while fetching data.');
                        }
                    });
                }
                else{
                    $('#search_result').hide();
                }
            });
}, 1);
    </script>
</body>

</html>