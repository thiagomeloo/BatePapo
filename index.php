<?php
    session_start();
    if(isset($_SESSION['autenticado']) == true){
        header("location:batepapo.php");
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

    <script type="text/javascript" language="javascript">
        function valida_form (){
            if(document.getElementById("apelido").value.length < 3){
                alert('Por favor, insira um apelido');
                document.getElementById("apelido").focus();
                return false
            }
        }
    </script>

</head>

<body>
    <div class="newsletter-subscribe">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Bate-Papo</h2>
                <p class="text-center">Insira um apelido para ir ao bate-papo.&nbsp;<br>Observação:<br>Apelidos serão armazenados apenas no momento que estiverem sendo utilizados.</p>
            </div>
            <form id="frmApelido" name="frmApelido" class="form-inline" method="post" action="assets/php/processa.php" onsubmit="return valida_form(this)">
                <div class="form-group"><input class="form-control" type="text" name="apelido" id="apelido" placeholder="Seu apelido"></div>
                <div class="form-group"><button class="btn btn-primary" type="submit" name="entrar">Entrar</button></div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>