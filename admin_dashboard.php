<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}
//TODO: la fiecare tranzitie cand vine sa am grija sa nu mai am overflow
//TODO: sa nu pot ambele pagini modale in acelasi timp 
//TODO: sa nu alea asa de late
list($admin_nume,$admin_prenume)=explode(' ',$_SESSION['admin_name'],2);
$query="SELECT ID_MASINA,MARCA,MODEL,AN_FABRICATIE,PRET FROM masini";
$result = $conexiune->query($query);
if(!$result){
   die("Error: ".mysqli_error($conexiune));
}

$query_1="SELECT NUME, PRENUME, EMAIL FROM vanzatori WHERE NUME != ? OR PRENUME != ?";
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
    <title>Admin Page</title>
</head>

<body>

    <div class="loader"></div>

    <header>
        <nav class="hidden-homepage navbar">
            <ul>
                <li> <a href="#" onclick="openModal()"><span></span>Cars list</a></li>
                <li> <a href="#" onclick="openModal_dealer()"><span></span>Dealers list</a></li>
                <li> <a href="#"><span></span>Register +</a>
                    <ul>
                        <li><a href="car_register_form.php"><span></span>car</a></li>
                        <li><a href="register_form.php"><span></span>dealer</a></li>
                        <li><a href="transaction_register_form.php"><span></span>transaction</a></li>
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

        <div class="content" id="blur">
            <h3>Hi, <span>admin</span></h3>
            <h1>Welcome, <span>
                    <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
                </span></h1>
            <a href="homepage.php" class="btn">Homepage</a>
            <a href="statistics_about_dealership.php" class="btn">Statistics</a>
            <a href="logout.php" class="btn" id="logout">Logout</a>
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
        <br>
        <a href="#" onclick="closeModal()" class="btn">Close</a>
    </div>
    <div id="pop-up-dealer-list">
        <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Email</th>
                </tr>
            </thead>
                <tbody>
                    <?php while ($row_1 = $result_1->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row_1['NUME']); ?></td>
                        <td><?php echo htmlspecialchars($row_1['PRENUME']); ?></td>
                        <td><?php echo htmlspecialchars($row_1['EMAIL']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
        </table>
        </div>
        <br>
    <a href="#" onclick="closeModal_dealer()" class="btn">Close</a>
    </div>
    <script>
        var blur=document.getElementById('blur');
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

        function openModal() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-car-list').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('pop-up-car-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_dealer() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-dealer-list').style.display = 'block';
        }

        function closeModal_dealer() {
            document.getElementById('pop-up-dealer-list').style.display = 'none';
            blur.classList.remove('active_element');

        }
    </script>
</body>

</html>