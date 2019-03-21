<?php 
#passo 1 : verificar se existe o apelido no banco 
#passo 2 : se existir manda tentar dnv
#passo 3 : se não existir cria uma sessao e insere no banco o apelido 
#passo 4 : retorna para index
include('DB.php');
if (isset($_POST['entrar'])){
	$apelido = isset($_POST['apelido'])?$_POST['apelido']:"";
	$select = "SELECT * from user WHERE apelido='".$apelido."'";
    $result = $conn -> query($select);
    $x = null;
    while($row = $result -> fetch_assoc()){
    	if($row['apelido'] == $apelido){
    		echo "<script>alert('Apelido já existente por favor insira outro. ');window.location = '../../index.php'</script>";
    		$x = 1;

    	}else{
    		$x = null;
    	}
    }
    if($x == null){
        date_default_timezone_set('America/Bahia');
        session_start();
        $_SESSION['autenticado'] = true;
        $_SESSION['apelido'] = $apelido;
        $hora = date('Y-m-d H:i:s', strtotime('+5 min'));
        $sql = "INSERT INTO user (apelido,hora) VALUES ('".$apelido."','".$hora."');";  
        $conn -> query($sql);
        header("location:../../batepapo.php"); 
    }
          
    }else{
        $conn -> close();
        header("location:../../index.php");   
    }
    $conn -> close();
?>