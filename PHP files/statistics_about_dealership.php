<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:dealer_auto.php');
   exit();  
}

@include('../Simple queries/query_statistics_1.php');
@include('../Simple queries/query_statistics_2.php');
@include('../Simple queries/query_statistics_3.php');
@include('../Simple queries/query_statistics_4.php');
@include ('../Simple queries/query_statistics_5.php');
@include('../Simple queries/query_statistics_6.php');
@include ('../Simple queries/query_statistics_7.php');
@include ('../Simple queries/query_statistics_8.php');
@include ('../Complex queries/query_complex_statistics_1.php');
@include ('../Complex queries/query_complex_statistics_2.php');
@include('../Complex queries/query_complex_statistics_3.php');
@include('../Complex queries/query_complex_statistics_4.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
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
            <a href="#" class="btn" onclick="openModal_clients_stats()">Find Clients Who Have Purchased More Than One Car</a>
            <a href="#" class="btn" onclick="openModal_top_3()">Top 3 Sellers by Cars Sold </a>
            <a href="#" class="btn" onclick="openModal_avg_stats()">Calculate Average Price of Cars Sold by Each Seller Using a Subquery</a>
            <a href="#" class="btn" onclick="openModal_2023()">Find Insurances After the Earliest Transaction in 2023</a>
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
    <div id="pop-up-clients-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Numar_masini</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_8 = $result_8->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_8['ClientName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_8['ClientSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_8['CarsPurchased']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_clients_stats()" class="btn">Close</a>
    </div>
    <div id="pop-up-top-3">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_vanztor</th>
                        <th>Prenume_vanzator</th>
                        <th>Masini vandute</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_9 = $result_9->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_9['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_9['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_9['CarsSold']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_top_3()" class="btn">Close</a>
    </div>
    <div id="pop-up-avg-stats">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nume_vanztor</th>
                        <th>Prenume_vanzator</th>
                        <th>Pret Mediu</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_10 = $result_10->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_10['SellerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_10['SellerSurname']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_10['AverageSalePrice']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_avg_stats()" class="btn">Close</a>
    </div>
    <div id="pop-up-2023">
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Marca_masina</th>
                        <th>Model_masina</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row_11 = $result_11->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row_11['CarBrand']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_11['CarModel']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row_11['TransactionDate']);?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="#" onclick="closeModal_2023()" class="btn">Close</a>
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

        function openModal_clients_stats() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-clients-stats').style.display = 'block';
        }

    function closeModal_clients_stats() {
            document.getElementById('pop-up-clients-stats').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_top_3() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-top-3').style.display = 'block';
        }

    function closeModal_top_3() {
            document.getElementById('pop-up-top-3').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_avg_stats() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-avg-stats').style.display = 'block';
        }

    function closeModal_avg_stats() {
            document.getElementById('pop-up-avg-stats').style.display = 'none';
            blur.classList.remove('active_element');
        }

        function openModal_2023() {
            blur.classList.toggle('active_element');
            document.getElementById('pop-up-2023').style.display = 'block';
        }

    function closeModal_2023() {
            document.getElementById('pop-up-2023').style.display = 'none';
            blur.classList.remove('active_element');
        }
    </script>
</body>

</html>