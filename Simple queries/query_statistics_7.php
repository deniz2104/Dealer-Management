<?php
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
?>