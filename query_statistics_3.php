<?php
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
?>