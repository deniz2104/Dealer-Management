<?php
session_start();
@include 'config.php'; 

$marca = $_POST['marca'];
$model = $_POST['model'];
$capacitate=$_POST['capacitate_cilindrica'];
$an = $_POST['an'];
$id_masina=$_POST['id_masina'];
$pret = $_POST['pret'];


$update = $conexiune->prepare("SELECT * FROM masini WHERE  ID_MASINA=?");
$update->bind_param("i",$id_masina);
$update->execute();
$result = $update->get_result();


    if($result->num_rows==0){
        echo "<script>alert('Error:You can not update unexistent ID'); window.location.href='edit_car_form.php';</script>";
        $update->close();
        $conexiune->close();
        exit();
    }
    else{
        $edit=$conexiune->prepare("UPDATE FROM masini WHERE MARCA=? MODEL=? CAPACITATE_CILINDRICA=? AN=? PRET=?");
        $edit->bind_param("ssiid",$marca,$model,$capacitate,$an,$pret);
        if($edit->execute()){
            echo "<script>alert('Update successful'); window.location.href='edit_update_form.php';</script>";
        }
        else {
            echo "<script>alert('Error: Failed to update. Please try again.'); window.location.href='edit_update_form.php';</script>";
        }
        $edit->close(); 
}
    
$update->close();
$conexiune->close();
?>