<?php
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
}$query_4="SELECT 
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
?>