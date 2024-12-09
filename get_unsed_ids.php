<?php
@include 'config.php';
session_start();

//TODO: !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_POST['term'])) {
    $id = $_POST['term']; 
    $query = "SELECT ID_MASINA FROM masini WHERE ID_MASINA NOT IN (SELECT ID_MASINA FROM masini) AND ID_MASINA LIKE ? LIMIT 3"; // SQL query.
    $stmt = $conexiune->prepare($query); 
    $like_id = $id ."%"; 
    $stmt->bind_param("s", $like_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped mt-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['ID_MASINA']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No results found.</p>';
    }
    $stmt->close();
    $conexiune->close();
}
?>
