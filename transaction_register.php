<?php

session_start();
@include 'config.php';

$id_tranzactie=$_POST['id_tranzactie'];
$id_client=$_POST['id_client'];
$id_masina=$_POST['id_masina'];
$id_vanzator=$_POST['id_vanzator'];
$data_tranzactie=$_POST['data_tranzactie'];

$stmt=$conexiune->prepare("SELECT ID_TRANZACTIE FROM tranzactii");
$stmt->bind("i",$id_tranzactie);
$stmt->execute();
$result=$stmt->get_result();

$stmt_1=$conexiune->prepare("SELECT ID_CLIENT FROM clienti");
$stmt_1->bind("i",$id_client);
$stmt_1->execute();
$result_1=$stmt_1->get_result();

$stmt_2=$conexiune->prepare("SELECT ID_MASINA FROM masini");
$stmt_2->bind("i",$id_masina);
$stmt_2->execute();
$result_2=$stmt_2->get_result();

$stmt_3=$conexiune->prepare("SELECT ID_VANZATOR FROM vanztori");
$stmt_3->bind("i",$id_vanzator);
$stmt_3->execute();
$result_3=$stmt_3->get_result();

if($result->num_rows >0){
    echo "<script>alert('Error: Same ID. Cannot proceed with transaction.'); window.location.href='transaction_register_form.php';</script>";
    $stmt->close();
    $conexiune->close();
    exit();
}

else if($result_1->num_rows == 0){
    echo "<script>alert('Error: Unexistent ID. Cannot proceed with transaction.'); window.location.href='transaction_register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $conexiune->close();
    exit();
}

else if($result_2->num_rows == 0){
    echo "<script>alert('Error: Unexistent ID. Cannot proceed with transaction.'); window.location.href='transaction_register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $stmt_2->close();
    $conexiune->close();
    exit();
}

else if($result_3->num_rows == 0){
    echo "<script>alert('Error: Unexistent ID. Cannot proceed with transaction.'); window.location.href='transaction_register_form.php';</script>";
    $stmt->close();
    $stmt_1->close();
    $stmt_2->close();
    $stmt_3->close();
    $conexiune->close();
    exit();
}
else {
    $stmt_4=$conexiune->prepare("INSERT INTO tranzactii (ID_TRANZACTIE, ID_CLIENT, ID_MASINA, ID_VANZATOR, DATA_TRANZACTIE) VALUES (?,?,?,?,?)");
    $stmt_4->bind_param("iiiiis", $id_tranzactie, $id_client, $id_masina, $id_vanzator, $data_tranzactie);
    if($stmt_4->execute()){
        echo "<script>alert('Transaction registered successfully.'); window.location.href='transaction_register_form.php';</script>";
    }
    else {
        echo "<script>alert('Error: Failed to register transaction. Please try again.'); window.location.href='transaction_register_form.php';</script>";
    }
    $stmt_4->close();
}

$stmt->close();
$stmt_1->close();
$stmt_2->close();
$stmt_3->close();
$conexiune->close();


?>