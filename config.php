<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database='query_initial';
$conexiune=mysqli_connect($host,$user,$password) or die("No connection");
$bazadate=mysqli_select_db($conexiune,$database) or die("No database information available");
?>

