<?php
    include("DB.php");
    session_start();
    $myArr = array();
    //seleciona todas as mensagens maiores que a ultima
    date_default_timezone_set('America/Bahia');
    $horaAtual = date('Y-m-d H:i:s'); 
    $apelido = $_SESSION['apelido'];
    $select = "SELECT * from user WHERE apelido = '$apelido' and hora <'".$horaAtual."'";
        $result = $conn -> query($select);
         $resposta = $result->num_rows; //verifica se ha resultado
        if($resposta == 0){
            $myJSON = json_encode(false);
            //nenhum resultado encontrado.
            //echo $_SESSION['IdUltimaMsg'];
        }else{
            $myJSON = json_encode(true);
            //se houver resultado entra aqui
           
       }
     $conn -> close();
    echo $myJSON;

?>