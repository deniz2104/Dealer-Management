<?php
@include 'config.php';

if(isset($_POST['term']) && $_POST['filters']['name']){
    $surname=$_POST['term'];
    $name=$_POST['filters']['name'];
    $query="SELECT  PRENUME FROM vanzatori WHERE NUME=? AND PRENUME LIKE ?";
    $stmt=$conexiune->prepare($query);
    $like_surname=$surname."%";
    $stmt->bind_param("ss", $name,$like_surname);
    $stmt->execute();
    $result=$stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped mt-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['PRENUME']) . '</td>';
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