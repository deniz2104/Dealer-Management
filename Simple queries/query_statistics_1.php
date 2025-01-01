<?php
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

?>