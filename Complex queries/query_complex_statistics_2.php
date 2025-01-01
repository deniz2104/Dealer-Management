<?php
$query_9="SELECT 
    v.ID_VANZATOR AS SellerID,
    v.NUME AS SellerName,
    v.PRENUME AS SellerSurname,
    (SELECT COUNT(*) 
     FROM tranzactii t 
     WHERE t.ID_VANZATOR = v.ID_VANZATOR) AS CarsSold
FROM vanzatori v
ORDER BY CarsSold DESC
LIMIT 3;";

$result_9=$conexiune->query($query_9);

if (!$result_9) {
    die("Query Error: " . $conexiune->error);
}

?>