<?php
$query="SELECT 
masini.MARCA AS Brand,
masini.MODEL AS Model,
masini.PRET AS Price,
masini.AN_FABRICATIE AS YEAR_OF_FABRICATION
FROM masini
LEFT JOIN tranzactii ON masini.ID_MASINA = tranzactii.ID_MASINA
WHERE tranzactii.ID_MASINA IS NULL";

$result=$conexiune->query($query);

if (!$result) {
die("Query Error: " . $conexiune->error);
}
?>