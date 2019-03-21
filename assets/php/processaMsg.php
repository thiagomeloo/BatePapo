<?php
include('DB.php');
session_start();
	if(isset($_POST['submitMsg'])){
		$mensagem = $_POST['msg'];
		$apelido = $_SESSION['apelido'];
		date_default_timezone_set('America/Bahia');
		$hora = date('Y-m-d H:i:s');
		$horaNova = date('Y-m-d H:i:s', strtotime('+5 min'));
		$sql = "INSERT INTO mensagens (apelido,mensagem,hora) VALUES ('".$apelido."','".$mensagem."','".$hora."');";
    	$conn -> query($sql); 	

    	$update = "UPDATE user SET hora ='".$horaNova."' WHERE apelido ='".$apelido."'";
    	$conn -> query($update);

	}
	
	header("location:../../batepapo.php");
	//submitMsg
	//msg

?>