<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}

$query="SELECT 
    tranzactii.ID_TRANZACTIE AS TransactionID,
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
INNER JOIN masini ON tranzactii.ID_MASINA = masini.ID_MASINA;";

$result=$conexiune->query($query);

if (!$result) {
    die("Query Error: " . $conexiune->error);
}

$query_1="
SELECT 
    clienti.ID_CLIENT AS ClientID,
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname
FROM clienti
LEFT JOIN tranzactii ON clienti.ID_CLIENT = tranzactii.ID_CLIENT
WHERE tranzactii.ID_CLIENT IS NULL;";

$result_1=$conexiune->query($query_1);

if (!$result_1) {
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
            <a href="#" class="btn" onclick="openModal()">Transactions details</a>
            <a href="#" class="btn" onclick="openModal_customers()">Customers without buying a car</a>
            <a href="#" class="btn" >Performance of dealers</a>
            <a href="#" class="btn" >Cars unsold by dealers</a>
            <a href="#" class="btn" >Cars sold to clients</a>

        </div>
    </div>
    <div id="pop-up-car-list-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID_Client</th>
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
                            <?php echo htmlspecialchars($row['TransactionID']); ?>
                        </td>
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
        <a href="#" onclick="closeModal()" class="btn">Close</a>
    </div>
    <div id="pop-up-dealer-list">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID_Client</th>
                        <th>Nume_client</th>
                        <th>Prenume_client</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_1= $result_1->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_1['ClientID']); ?>
                        </td>
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
        <a href="#" onclick="closeModal_customers()" class="btn">Close</a>
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
    </script>
</body>

</html>