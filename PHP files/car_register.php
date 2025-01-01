<?php
session_start();
@include 'config.php'; 

$marca = $_POST['marca'];
$model = $_POST['model'];
$capacitate=$_POST['capacitate_cilindrica'];
$an = $_POST['an'];
$id_masina=$_POST['id_masina'];
$pret = $_POST['pret'];

$stmt = $conexiune->prepare("SELECT * FROM masini WHERE MARCA = ? AND MODEL = ? AND CAPACITATE_MOTOR=? AND AN_FABRICATIE= ? AND ID_MASINA=? AND PRET= ?");
$stmt->bind_param("ssiiid",$marca,$model,$capacitate,$an,$id_masina,$pret);
$stmt->execute();
$result = $stmt->get_result();

$stmt_1 = $conexiune->prepare("SELECT * FROM masini WHERE ID_MASINA=?");
$stmt_1->bind_param("i",$id_masina);
$stmt_1->execute();
$result_1= $stmt_1->get_result();

    if($result_1->num_rows>0){
        echo "<script>alert('Error:You can not enter this ID'); window.location.href='car_register_form.php';</script>";
        $stmt->close();
        $stmt_1->close();
        $conexiune->close();
        exit();
    }
    else{
        $insert=$conexiune->prepare("INSERT INTO masini (MARCA,MODEL,CAPACITATE_MOTOR,AN_FABRICATIE,PRET,ID_MASINA) VALUES (?,?,?,?,?,?)");
        $insert->bind_param("sssisi", $marca, $model, $capacitate, $an, $pret, $id_masina);
        if($insert->execute()){
            echo "<script>alert('Registration successful. You can now register it with a dealer.'); window.location.href='register_form.php';</script>";
        }
        else {
            echo "<script>alert('Error: Failed to register. Please try again.'); window.location.href='car_register_form.php';</script>";
        }
        $insert_stmt->close(); 
}
    
$stmt->close();
$stmt_1->close();
$conexiune->close();
?>