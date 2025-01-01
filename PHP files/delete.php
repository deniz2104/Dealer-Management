<?php
session_start();
@include 'config.php'; 

$id_masina=$_POST['id_masina'];


$delete = $conexiune->prepare("SELECT * FROM masini WHERE  ID_MASINA=?");
$delete->bind_param("i",$id_masina);
$delete->execute();
$result = $delete->get_result();


    if($result->num_rows==0){
        echo "<script>alert('Error:You can not delete unexistent ID'); window.location.href='delete_car_form.php';</script>";
        $delete->close();
        $conexiune->close();
        exit();
    }
    else{
        $del=$conexiune->prepare("DELETE FROM masini WHERE ID_MASINA=?");
        $del->bind_param("i",$id_masina);
        if($del->execute()){
            echo "<script>alert('Delete successful'); window.location.href='delete_car_form.php';</script>";
        }
        else {
            echo "<script>alert('Error: Failed to delete. Please try again.'); window.location.href='delete_car_form.php';</script>";
        }
        $del->close(); 
}
    
$delete->close();
$conexiune->close();
?>