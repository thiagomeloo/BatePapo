<?php
	include('DB.php');
	date_default_timezone_set('America/Bahia');
	$horaAtual = date('Y-m-d H:i:s'); 
	$select = "SELECT * from user WHERE hora <'".$horaAtual."'";
    $result = $conn -> query($select);
    $arrayOf = array();
    while($row = $result -> fetch_assoc()){
    	if($horaAtual > $row['hora']){
			$arrayOf[$row['apelido']] = $row['apelido'];
		}  
    }

    $sel = "SELECT * from user WHERE hora = null";
    $resul = $conn -> query($sel);
    while($row = $result -> fetch_assoc()){
			$arrayOf[$row['apelido']] = $row['apelido'];
			echo $row['apelido'];
    }



    foreach ($arrayOf as $key => $value) {
    	$delete = "DELETE from user where apelido='".$key."'";
    	$conn -> query($delete); 
    }

    $conn -> close();
?>