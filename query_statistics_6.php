<?php
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

?>