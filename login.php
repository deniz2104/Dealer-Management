<?php
session_start();
@include 'config.php'; 

$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$email=$_POST['email'];
$id = $_POST['id'];
$role = $_POST['role'];

$stmt = $conexiune->prepare("SELECT * FROM vanzatori WHERE NUME = ? AND PRENUME = ? AND EMAIL=? AND ID_VANZATOR = ?  AND role = ?");
$stmt->bind_param("sssis", $nume, $prenume,$email,$id, $role);
$stmt->execute();
$result = $stmt->get_result();

$stmt_1 = $conexiune->prepare("SELECT * FROM vanzatori WHERE NUME = ? AND PRENUME = ? AND EMAIL=?");
$stmt_1->bind_param("sss", $nume, $prenume,$email);
$stmt_1->execute();
$result_1 = $stmt_1->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if($user['role']==='admin'){
        $_SESSION['admin_name']=$user['NUME'] .' '.$user['PRENUME']; 
        header("Location:admin_dashboard.php");
        exit();
    }
    elseif($user['role']==='seller'){
        $_SESSION['seller_name']=$user['NUME'].' '.$user['PRENUME'];
        header("Location:seller_dashboard.php");
        exit();
    }
}else {
    echo "<script>alert('Invalid login credentials. Please try again.'); window.location.href='dealer_auto.php';</script>";}

$stmt->close();
$conexiune->close();
?>