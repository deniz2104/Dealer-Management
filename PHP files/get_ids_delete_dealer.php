<?php
@include 'config.php';

if (isset($_POST['term']) && isset($_POST['filters']['name']) && isset($_POST['filters']['surname'])) {
    $term = $_POST['term'];
    $name = $_POST['filters']['name'];
    $surname = $_POST['filters']['surname'];

    $query = "SELECT ID_VANZATOR FROM vanzatori WHERE NUME = ? AND PRENUME = ? AND ID_VANZATOR LIKE ?";
    $stmt = $conexiune->prepare($query);
    $like_term = $term . '%';
    $stmt->bind_param("sss", $name, $surname, $like_term);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped mt-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['ID_VANZATOR']) . '</td>';
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
