<?php
session_start();
@include 'config.php'; 

$id_serviciu=$_POST['id_serviciu'];
$id_masina=$_POST['id_masina'];
$cost = isset($_POST['cost']) && $_POST['cost'] !== "" ? $_POST['cost'] : null;
$data = isset($_POST['data']) && $_POST['data'] !== "" ? date('Y-m-d', strtotime($_POST['data'])) : null;

$update = $conexiune->prepare("SELECT * FROM servicii WHERE  ID_MASINA=?");
$update->bind_param("i",$id_masina);
$update->execute();
$result = $update->get_result();

$update_1 = $conexiune->prepare("SELECT * FROM servicii WHERE  ID_SERVICIU=?");
$update_1->bind_param("i",$id_serviciu);
$update_1->execute();
$result_1 = $update_1->get_result();


$update_variables=[];
$parameters=[];
$types="";

if(!is_null($cost)){
    $update_variables[] = "COST=?";
    $parameters[] = "$cost";
    $types.="d";
}    

if(!is_null($data)){
    $update_variables[] = "DATA_SERVICIULUI=?";
    $parameters[] = "$data";
    $types.="s";
}    

if(empty($update_variables)){
    echo "<script>alert('Error: No fields to update'); window.location.href='edit_services_form.php';</script>";
    $update->close();
    $update->close();
    $conexiune->close();
    exit();
}

$parameters[]=$id_serviciu;
$types.="i";

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
        $update_fields_string=implode(", ",$update_variables);
        $query = "UPDATE servicii SET $update_fields_string WHERE ID_SERVICIU=?";
        $update_2 = $conexiune->prepare($query);
        $update_2->bind_param($types, ...$parameters);

        if ($update_2->execute()) {
            echo "<script>alert('Update successful'); window.location.href='edit_services_form.php';</script>";
        } else {
            echo "<script>alert('Error: Failed to update. Please try again.'); window.location.href='edit_services_form.php';</script>";
        }
        $update_2->close(); 
}
    
$update->close();
$update_1->close();  
$conexiune->close();
?>