<?php
session_start();
@include 'config.php'; 

$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$email=$_POST['email'];
$id = $_POST['id'];
$id_masina=$_POST['id_masina'];
$role = $_POST['role'];

$stmt_3 = $conexiune->prepare("SELECT * FROM masini WHERE ID_MASINA=?");
$stmt_3->bind_param("i", $id_masina);
$stmt_3->execute();
$result_3= $stmt_3->get_result();


if($result_3->num_rows===0){
    echo "<script>alert('Error: No matching record found for the provided ID_MASINA in sellers table. Cannot proceed with registration.Register the car'); window.location.href='car_register_form.php';</script>";
    $stmt_3->close();
    $conexiune->close();
    exit();
}

//TODO: sa verific ca mail ul apartine unei persoane unice,gen sa pot avea aceleasi email pentru acelasi nume si prenume si sa previn asignarea unui email diferit la ala si invers
$stmt = $conexiune->prepare("SELECT * FROM vanzatori WHERE EMAIL=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Error:Same email. Cannot proceed with registration.'); window.location.href='register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $stmt_2->close();
    $stmt_3->close();
    $conexiune->close();
    exit();
}

$stmt_1 = $conexiune->prepare("SELECT * FROM vanzatori WHERE ID_VANZATOR=?");
$stmt_1->bind_param("i", $id);
$stmt_1->execute();
$result_1 = $stmt_1->get_result();

if($result_1->num_rows > 0){
    echo "<script>alert('Error:Same ID. Cannot proceed with registration.'); window.location.href='register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $stmt_2->close();
    $stmt_3->close();
    $conexiune->close();
    exit();
}

$stmt_2 = $conexiune->prepare("SELECT * FROM vanzatori WHERE ID_MASINA=?");
$stmt_2->bind_param("i", $id_masina);
$stmt_2->execute();
$result_2 = $stmt_2->get_result();

if($result_2->num_rows > 0){
    echo "<script>alert('Error: Same ID_MASINA. Cannot proceed with registration.'); window.location.href='register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $stmt_2->close();
    $stmt_3->close();
    $conexiune->close();
    exit();
}

    $insert=$conexiune->prepare("INSERT INTO vanzatori (NUME,PRENUME,EMAIL,ID_VANZATOR,role,ID_MASINA) VALUES (?,?,?,?,?,?)");
    $insert->bind_param("sssisi", $nume, $prenume, $email, $id, $role, $id_masina);
    if($insert->execute()){
        echo "<script>alert('Registration successful. You can now log in.'); window.location.href='dealer_auto.php';</script>";
    }
    else {
        echo "<script>alert('Error: Failed to register. Please try again.'); window.location.href='register_form.php';</script>";
    }
    
$insert->close(); 
$stmt->close();
$stmt_1->close();
$stmt_2->close();
$stmt_3->close();
$conexiune->close();
?>