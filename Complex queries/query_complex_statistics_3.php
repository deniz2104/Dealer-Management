<?php
$query_10="SELECT 
    vanzatori.ID_VANZATOR AS SellerID,
    vanzatori.NUME AS SellerName,
    vanzatori.PRENUME AS SellerSurname,
    (SELECT AVG(masini.PRET) 
     FROM masini 
     WHERE masini.ID_MASINA = vanzatori.ID_MASINA) AS AverageSalePrice
FROM vanzatori
WHERE (SELECT AVG(masini.PRET) 
       FROM masini 
       WHERE masini.ID_MASINA = vanzatori.ID_MASINA) IS NOT NULL;";

$result_10=$conexiune->query($query_10);

if (!$result_10) {
    die("Query Error: " . $conexiune->error);
}

?>