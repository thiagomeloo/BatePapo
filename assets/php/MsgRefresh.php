<?php
	include("DB.php");
	session_start();
	$myArr = array();
	$id;
	//seleciona todas as mensagens maiores que a ultima
	$select = "SELECT * from mensagens where id > ".$_SESSION['IdUltimaMsg'];
	$result = $conn -> query($select);
	$resposta = $result->num_rows; //verifica se ha resultado
	if($resposta == 0){
	  //nenhum resultado encontrado.
	
	}else{
    	//se houver resultado entra aqui
	    while($row = $result -> fetch_assoc()){
	    	$myArr[] = $row;
	    	$id = $row['id'];
	    }
	   if($id != null){
	   	//echo $id;
	   	$_SESSION['IdUltimaMsg'] = $id;	
	   //echo $_SESSION['IdUltimaMsg'];
	   }
  	}

	 $conn -> close();

	$myJSON = json_encode($myArr);
	echo $myJSON;

?>