<?php
session_start();
@include 'config.php'; 

$id_serviciu=$_POST['id_serviciu'];
$id_masina=$_POST['id_masina'];
$cost = $_POST['cost'];
$data = date('Y-m-d', strtotime($_POST['data']));


$update = $conexiune->prepare("SELECT * FROM servicii WHERE  ID_MASINA=?");
$update->bind_param("i",$id_masina);
$update->execute();
$result = $update->get_result();

$update_1 = $conexiune->prepare("SELECT * FROM servicii WHERE  ID_SERVICIU=?");
$update_1->bind_param("i",$id_serviciu);
$update_1->execute();
$result_1 = $update_1->get_result();


    if($result->num_rows==0){
        echo "<script>alert('Error:You can not update unexistent ID'); window.location.href='edit_services_form.php';</script>";
        $update->close();
        $conexiune->close();
        exit();
    }
    elseif($result_1->num_rows==0){
        echo "<script>alert('Error:You can not update unexistent ID'); window.location.href='edit_services_form.php';</script>";
        $update->close();
        $update_1->close();
        $conexiune->close();
        exit();
    }
    else{
        $edit=$conexiune->prepare("UPDATE servicii SET COST=?,DATA_SERVICIULUI=? WHERE ID_SERVICIU=?");
        $edit->bind_param("dsi",$cost,$data,$id_serviciu);
        if($edit->execute()){
            echo "<script>alert('Update successful'); window.location.href='edit_services_form.php';</script>";
        }
        else {
            echo "<script>alert('Error: Failed to update. Please try again.'); window.location.href='edit_services_form.php';</script>";
        }
        $edit->close(); 
}
    
$update->close();
$conexiune->close();
?>