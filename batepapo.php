<?php
    session_start();
    if(isset($_SESSION['autenticado']) == true){
        include('assets/php/DB.php');
    }else{
        header("location:index.php");
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RascunhoBatePapo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
    <script src="assets/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        function valida_form (){
            if(document.getElementById("apelido").value.length < 3){
                alert('Por favor, insira um apelido');
                document.getElementById("apelido").focus();
                return false
            }
        }
        function loadall(){
            var objDiv = document.getElementById("msgs");
            objDiv.scrollTop = objDiv.scrollHeight;
        }

    </script>

</head>

<body onload="loadall()">
    <div class="container" style="margin-top:10px;">

        <?php
            echo "<a href='assets/php/Logout.php' id='sair' style='float:right;'>Sair</a>"
        ?>
        
        <h3 id="titulobemvindo">Bem Vindo <?php echo $_SESSION['apelido']?></h3>
        <h5 class="text-secondary" id="titulomsg" style="margin:10px;">Mensagens:</h5>
        <div id="msgs">
            <?php 
                
                
                $sel = "SELECT * from mensagens order by (id) desc limit 15 " ;
                $resu = $conn -> query($sel);
                $SemMsg = $resu->num_rows;
                $arrayMSG = array();
                $arrayApelido = array();
                $arrayHrMsg = array();
                while($row = $resu -> fetch_assoc()){
                    $arrayMSG[$row['id']] = $row['mensagem'];
                    $arrayApelido[$row['id']] = $row['apelido'];
                    $arrayHrMsg[$row['id']] = $row['hora'];
                }

                //para pegar o indice da ultima msg
                if($SemMsg == 0){
                    $_SESSION['IdUltimaMsg'] = 0;
                }else{
                    foreach ($arrayMSG as $key => $value) {
                        $_SESSION['IdUltimaMsg'] = $key;
                      break;
                    }
                }

                $arrayMsgInverse = array_reverse($arrayMSG);
                $arrayApelido = array_reverse($arrayApelido);
                $arrayHrMsg = array_reverse($arrayHrMsg);

                foreach ($arrayMsgInverse as $key => $value) {
                        
                        echo'<div class="card">';
                        echo'<div class="card-header">';
                        if($_SESSION['apelido'] == $arrayApelido[$key]){
                            echo'<h5 class="mb-0 text-danger">'.$arrayApelido[$key].'</h5>';
                        }else{
                            echo'<h5 class="mb-0">'.$arrayApelido[$key].'</h5>';
                        }
                        
                        echo'</div>';
                        echo'<div class="card-body">';
                        echo'<p class="card-text">'.$value.'</p>';
                        echo'</div>';
                        echo'</div>';                        
                }
            ?>
        </div>
        <form id="frmMsg" style="height:55px;" action="assets/php/processaMsg.php" method="post" onsubmit="return valida_form(this)">
            <input class="form-control d-inline d-inline-flex" type="text" name="msg" id="msg" style="width:70%;margin:10px;">
            <button class="btn btn-primary" type="submit" name="submitMsg" id="submitMsg" style="width:20%;">Enviar</button>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- SCRIPTS -->
    <?php 
      if(isset($_SESSION['autenticado']) == true){
    ?>
    <script>
      setInterval(function(){
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText); 
                console.log(myObj);
                myObj.forEach(function(o, index){
                    console.log(o.id); //para pegar o id do objeto
                      $("#msgs").append(
                        '<div class="card">'+
                        '<div class="card-header">'+
                        '<h5 class="mb-0 ">'+o.apelido+'</h5>'+
                        '</div>'+
                        '<div class="card-body">'+
                        '<p class="card-text">'+o.mensagem+'</p>'+
                        '</div>'+
                        '</div>'
                        );                 
                var objDiv = document.getElementById("msgs");
                objDiv.scrollTop = objDiv.scrollHeight;
                }); 
                         
            }
        };
        xmlhttp.open("GET", "assets/php/MsgRefresh.php", true);
        xmlhttp.send();

        }, 2000);

        setInterval(function(){
        var xml = new XMLHttpRequest();

        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                my = JSON.parse(this.responseText); 
                console.log(my);
                if(my){
                
                    console.log(my); //para pegar o id do objeto
                    alert('Você foi desconectado por inatividade.');
                    window.location.assign("assets/php/Logout.php");  
                } 
                         
            }
        };
        xml.open("GET", "assets/php/Logoff.php", true);
        xml.send();

        }, 1000);    

    </script>
</body>

</html>

<?php 
    }
        $conn -> close();
?>