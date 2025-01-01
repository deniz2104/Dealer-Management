<?php
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

?>