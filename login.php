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

if ($result->num_rows === 1) {
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
    if(empty($nume)){
        header('location: dealer_auto.php?error=Numele este obligatoriu');
        exit();
    }
    else if (empty($prenume)){
        header('location: dealer_auto.php?error=Prenumele este obligatoriu');
        exit();
    }
    else if (empty($email)){
        header('location: dealer_auto.php?error=Email-ul este obligatoriu');
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('location: dealer_auto.php?error=Email-ul nu este valid');
        exit();
    }
    else if (empty($id)){
        header('location: dealer_auto.php?error=ID-ul este obligatoriu');
        exit();
    }
}

$stmt->close();
$conexiune->close();
?>