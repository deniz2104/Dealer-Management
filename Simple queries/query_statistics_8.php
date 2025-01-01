<?php
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