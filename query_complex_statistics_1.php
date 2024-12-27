<?php
$query_8="SELECT 
    clienti.ID_CLIENT AS ClientID,
    clienti.NUME AS ClientName,
    clienti.PRENUME AS ClientSurname,
    (SELECT COUNT(tranzactii.ID_TRANZACTIE) 
     FROM tranzactii 
     WHERE tranzactii.ID_CLIENT = clienti.ID_CLIENT) AS CarsPurchased
FROM clienti
WHERE (SELECT COUNT(tranzactii.ID_TRANZACTIE) 
       FROM tranzactii 
       WHERE tranzactii.ID_CLIENT = clienti.ID_CLIENT) > 1;";

$result_8=$conexiune->query($query_8);

if (!$result_8) {
    die("Query Error: " . $conexiune->error);
}

?>