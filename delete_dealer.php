<?php
session_start();
@include 'config.php'; 

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo "<script>alert('Error: No ID provided.'); window.location.href='delete_dealer_form.php';</script>";
    exit();
}

$id = $_POST['id'];
$nume=$_POST['nume'];
$prenume=$_POST['prenume'];

$checkQuery = $conexiune->prepare("SELECT NUME, PRENUME FROM vanzatori WHERE ID_VANZATOR = ?");
$checkQuery->bind_param("i", $id);
$checkQuery->execute();
$result = $checkQuery->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Error: Cannot delete nonexistent ID.'); window.location.href='delete_dealer_form.php';</script>";
    $checkQuery->close();
    $conexiune->close();
    exit();
}

list($admin_nume,$admin_prenume)=explode(' ',$_SESSION['admin_name'],2);
$row = $result->fetch_assoc();
if ($row['NUME'] === $admin_nume && $row['PRENUME'] === $admin_prenume) {
    echo "<script>alert('Error: You cannot delete your own account.'); window.location.href='delete_dealer_form.php';</script>";
    $checkQuery->close();
    $conexiune->close();
    exit();
}

$deleteQuery = $conexiune->prepare("DELETE FROM vanzatori WHERE NUME = ? AND PRENUME=?");
$deleteQuery->bind_param("ss", $nume, $prenume);

if ($deleteQuery->execute()) {
    echo "<script>alert('Delete successful.'); window.location.href='delete_dealer_form.php';</script>";
} else {
    echo "<script>alert('Error: Failed to delete. Please try again.'); window.location.href='delete_dealer_form.php';</script>";
}

$checkQuery->close();
$deleteQuery->close();
$conexiune->close();
?>
