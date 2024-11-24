<?php
session_start();
@include 'config.php'; 

$id=$_POST['id'];


$delete = $conexiune->prepare("SELECT * FROM vanzatori WHERE  ID_VANZATOR=?");
$delete->bind_param("i",$id);
$delete->execute();
$result = $delete->get_result();


    if($result->num_rows==0){
        echo "<script>alert('Error:You can not delete unexistent ID'); window.location.href='delete_dealer_form.php';</script>";
        $delete->close();
        $conexiune->close();
        exit();
    }
    else{
        $del=$conexiune->prepare("DELETE FROM vanzatori WHERE ID_MASINA=?");
        $del->bind_param("i",$id);
        if($del->execute()){
            echo "<script>alert('Delete successful'); window.location.href='delete_dealer_form.php';</script>";
        }
        else {
            echo "<script>alert('Error: Failed to delete. Please try again.'); window.location.href='delete_dealer_form.php';</script>";
        }
        $del->close(); 
}
    
$delete->close();
$conexiune->close();
?>