<?php
$query_11="
SELECT 
    masini.ID_MASINA AS CarID,
    masini.MARCA AS CarBrand,
    masini.MODEL AS CarModel,
    asigurare.DATA_INCEPUT AS TransactionDate
FROM masini
INNER JOIN asigurare ON masini.ID_MASINA = asigurare.ID_MASINA
WHERE asigurare.DATA_INCEPUT > (
    SELECT MIN(asigurare.DATA_INCEPUT)
    FROM asigurare
    WHERE YEAR(asigurare.DATA_INCEPUT) = 2023
);";

$result_11=$conexiune->query($query_11);

if (!$result_11) {
    die("Query Error: " . $conexiune->error);
}

?>