<?php
$query_1="
SELECT 
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname
FROM clienti
LEFT JOIN tranzactii ON clienti.ID_CLIENT = tranzactii.ID_CLIENT
WHERE tranzactii.ID_CLIENT IS NULL;";

$result_1=$conexiune->query($query_1);

if (!$result_1) {
    die("Query Error: " . $conexiune->error);
}
?>