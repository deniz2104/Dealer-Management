<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}

$query="SELECT 
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname,
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    masini.MARCA AS CarBrand,
    masini.MODEL AS CarModel,
    tranzactii.DATA_TRANZACTIE AS TransactionDate
FROM tranzactii
INNER JOIN clienti ON tranzactii.ID_CLIENT = clienti.ID_CLIENT
INNER JOIN vanzatori ON tranzactii.ID_VANZATOR = vanzatori.ID_VANZATOR
INNER JOIN masini ON tranzactii.ID_MASINA = masini.ID_MASINA
WHERE tranzactii.DATA_TRANZACTIE > '2022-01-01';";

$result=$conexiune->query($query);

if (!$result) {
    die("Query Error: " . $conexiune->error);
}

$query_1="
SELECT 
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname
FROM clienti
LEFT JOIN tranzactii ON clienti.ID_CLIENT = tranzactii.ID_CLIENT
WHERE tranzactii.ID_CLIENT IS NULL;";

$result_1=$conexiune->query($query_1);

if (!$result_1) {
    die("Query Error: " . $conexiune->error);
}

$query_2="SELECT 
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    COUNT(tranzactii.ID_MASINA) AS CarsSold
FROM vanzatori
LEFT JOIN tranzactii ON vanzatori.ID_VANZATOR = tranzactii.ID_VANZATOR
GROUP BY vanzatori.ID_VANZATOR, vanzatori.NUME, vanzatori.PRENUME;";

$result_2=$conexiune->query($query_2);

if (!$result_2) {
    die("Query Error: " . $conexiune->error);
}


$query_3="SELECT 
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    COUNT(vanzatori.ID_MASINA) AS UnsoldCars
FROM vanzatori
LEFT JOIN tranzactii ON vanzatori.ID_VANZATOR = tranzactii.ID_VANZATOR
LEFT JOIN masini ON masini.ID_MASINA = tranzactii.ID_MASINA
WHERE tranzactii.ID_MASINA IS NULL
GROUP BY vanzatori.ID_VANZATOR, vanzatori.NUME, vanzatori.PRENUME;";

$result_3=$conexiune->query($query_3);

if (!$result_3) {
    die("Query Error: " . $conexiune->error);
}


$query_4="SELECT 
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname,
    masini.MARCA AS CarBrand,
    masini.MODEL AS CarModel,
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname
FROM tranzactii
INNER JOIN clienti ON tranzactii.ID_CLIENT = clienti.ID_CLIENT
INNER JOIN masini ON tranzactii.ID_MASINA = masini.ID_MASINA
INNER JOIN vanzatori ON tranzactii.ID_VANZATOR = vanzatori.ID_VANZATOR;";

$result_4=$conexiune->query($query_4);

if (!$result_4) {
    die("Query Error: " . $conexiune->error);
}


$query_5="SELECT 
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    COUNT(tranzactii.ID_TRANZACTIE) AS TransactionCount,
    GROUP_CONCAT(masini.MARCA SEPARATOR ', ') AS SoldCars
FROM vanzatori
LEFT JOIN tranzactii ON vanzatori.ID_VANZATOR = tranzactii.ID_VANZATOR
LEFT JOIN masini ON tranzactii.ID_MASINA = masini.ID_MASINA
GROUP BY vanzatori.ID_VANZATOR, vanzatori.NUME;";

$result_5=$conexiune->query($query_5);

if (!$result_5) {
    die("Query Error: " . $conexiune->error);
}

$query_6="SELECT 
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    masini.MARCA AS CarBrand,
    masini.MODEL AS CarModel
FROM vanzatori
JOIN masini ON vanzatori.ID_MASINA = masini.ID_MASINA
LEFT JOIN servicii ON masini.ID_MASINA = servicii.ID_MASINA
WHERE servicii.ID_SERVICIU IS NULL;";

$result_6=$conexiune->query($query_6);

if (!$result_6) {
    die("Query Error: " . $conexiune->error);
}

$query_7="SELECT 
    masini.MARCA AS CarBrand,
    masini.MODEL AS CarModel,
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    servicii.DESCRIERE AS Description
FROM masini
LEFT JOIN vanzatori ON masini.ID_MASINA = vanzatori.ID_MASINA
LEFT JOIN servicii ON masini.ID_MASINA = servicii.ID_MASINA;";

$result_7=$conexiune->query($query_7);

if (!$result_7) {
    die("Query Error: " . $conexiune->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Statistics Page</title>
</head>

<body>

    <header>
        <nav class="hidden-homepage navbar">
            <ul>
                <li> <a href="admin_dashboard.php"><span></span>Back to dashboard</a></li>
            </ul>
        </nav>
    </header>

    <div class="hidden-homepage container">

        <div class="content" id="blur">
            <h3><span>Statistics</span></h3>
            <h1><span>
                    <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
                </span></h1>
            <a href="#" class="btn" onclick="openModal()">Transactions details after 2022</a>
            <a href="#" class="btn" onclick="openModal_customers()">Customers without bought car</a>
            <a href="#" class="btn" onclick="openModal_dealers()">Performance of dealers</a>
            <a href="#" class="btn" onclick="openModal_dealers_cars()" >Cars unsold by dealers</a>
            <a href="#" class="btn" onclick="openModal_clients()">Cars sold to clients</a>
            <a href="#" class="btn" onclick="openModal_sellers()">Count Transactions for Each Seller and List Their Sold Cars</a>
            <a href="#" class="btn" onclick="openModal_service()">Find Sellers Who Have Cars Without Any Service History</a>
            <a href="#" class="btn" onclick="openModal_service_status()">List Cars with Their Assigned Sellers and Service Status</a>
        </div>
    </div>
    <div id="pop-up-car-list-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_client</th>
                        <th>Prenume_client</th>
                        <th>Nume_vanzator</th>
                        <th>Prenume_vanzator</th>
                        <th>Marca_masina</th>
                        <th>Model_masina</th>
                        <th>Data_vanzare</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row['ClientName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['ClientSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['SellerName']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['SellerSurname']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['CarBrand']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['CarModel']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['TransactionDate']);?>
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
                        <th>Nume_client</th>
                        <th>Prenume_client</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_1= $result_1->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_1['ClientName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_1['ClientSurname']); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_customers()" class="btn">Close</a>
    </div>
    <div id="pop-up-dealer-list-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_Vanzator</th>
                        <th>Prenume_Vanzator</th>
                        <th>Masini_vandute</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_2= $result_2->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_2['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_2['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_2['CarsSold']); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_dealers()" class="btn">Close</a>
    </div>

    <div id="pop-up-dealer-cars-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_Vanzator</th>
                        <th>Prenume_Vanzator</th>
                        <th>Masini_nevandute</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_3= $result_3->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_3['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_3['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_3['UnsoldCars']); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_dealers_cars()" class="btn">Close</a>
    </div>
    <div id="pop-up-clients-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_client</th>
                        <th>Prenume_client</th>
                        <th>Marca_masina</th>
                        <th>Model_masina</th>
                        <th>Nume_vanzator</th>
                        <th>Prenume_vanzator</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_4 = $result_4->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_4['ClientName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_4['ClientSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_4['CarBrand']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_4['CarModel']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_4['SellerName']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_4['SellerSurname']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_clients()" class="btn">Close</a>
    </div>
    <div id="pop-up-sellers-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_Seller</th>
                        <th>Prenume_Seller</th>
                        <th>Numar_tranzactii</th>
                        <th>Masini_vandute</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_5 = $result_5->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_5['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_5['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_5['TransactionCount']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_5['SoldCars']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_sellers()" class="btn">Close</a>
    </div>
    <div id="pop-up-service-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_Seller</th>
                        <th>Prenume_Seller</th>
                        <th>Marca</th>
                        <th>Model</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_6 = $result_6->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_6['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_6['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_6['CarBrand']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_6['CarModel']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_service()" class="btn">Close</a>
    </div>
    <div id="pop-up-service-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Marca_masina</th>
                        <th>Model_masina</th>
                        <th>Nume_vanzator</th>
                        <th>Prenume_vanzator</th>
                        <th>Descriere</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_7 = $result_7->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_7['CarBrand']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_7['CarModel']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_7['SellerName']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_7['SellerSurname']);?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_7['Description']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_service_status()" class="btn">Close</a>
    </div>
    <script>
        var blur=document.getElementById('blur');
        $(document).ready(function () {
                    setTimeout(function () {
                            $('.navbar').removeClass('hidden-homepage').addClass('visible');
                            $('.container').removeClass('hidden-homepage').addClass('visible');
                        });
            });
        function openModal() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-car-list-stats').style.display = 'block';
        }

    function closeModal() {
            document.getElementById('pop-up-car-list-stats').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_customers() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-dealer-list').style.display = 'block';
        }

    function closeModal_customers() {
            document.getElementById('pop-up-dealer-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_dealers() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-dealer-list-stats').style.display = 'block';
        }

    function closeModal_dealers() {
            document.getElementById('pop-up-dealer-list-stats').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_dealers_cars() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-dealer-cars-list').style.display = 'block';
        }

    function closeModal_dealers_cars() {
            document.getElementById('pop-up-dealer-cars-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_clients() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-clients-list').style.display = 'block';
        }

    function closeModal_clients() {
            document.getElementById('pop-up-clients-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_sellers() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-sellers-list').style.display = 'block';
        }

    function closeModal_sellers() {
            document.getElementById('pop-up-sellers-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_service() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-service-list').style.display = 'block';
        }

    function closeModal_service() {
            document.getElementById('pop-up-service-list').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_service_status() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-service-stats').style.display = 'block';
        }

    function closeModal_service_status() {
            document.getElementById('pop-up-service-stats').style.display = 'none';
            blur.classList.remove('active_element');
        }
    </script>
</body>

</html>