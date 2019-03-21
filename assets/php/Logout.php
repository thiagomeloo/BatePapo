<?php
	include('DB.php');
	session_start();
	$apelido = isset($_SESSION['apelido'])?$_SESSION['apelido']:"";
	$sql = "DELETE from user where apelido ='".$apelido."'";
    $conn -> query($sql); 
	session_destroy();
	$conn -> close();
	header("location:../../index.php");
?>