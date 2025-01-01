<?php
@include 'config.php';

if(isset($_POST['term'])){
    $name=$_POST['term'];
    $query="SELECT DISTINCT NUME FROM vanzatori WHERE NUME LIKE ?";
    $stmt=$conexiune->prepare($query);
    $like_name=$name."%";
    $stmt->bind_param("s", $like_name);
    $stmt->execute();
    $result=$stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped mt-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['NUME']) . '</td>';
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