<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <title>Bem-vindo a Dara International</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
<style>
    .loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
    <script type="text/javascript">
        function focus_on_input() {
            document.getElementById('utilizador').focus();
        }
        function limpa_input() {
            document.getElementById('utilizador').value = "";
            document.getElementById('utilizador').focus();
            document.getElementById('password').value = "";
        }

        var timerId = 0;

        function timer1() {
            clearTimeout(timerId);
            timerId = setTimeout(limpa_input, 4000); //***espera 4s e depois executa a função limpa_input()
        }

    </script>
</head>
<body onLoad="focus_on_input()">
    <div class="limiter">
        <body style="background-color: #666666;">
            <div class="limiter">
                <div class="wrap-login100">
                    <form name="login" id="login" method="post" class="login100-form validate-form" action="teste_user.php">
                        <span class="login100-form-title p-b-43">
                            Gestão Dara
                            <br>
                            <p style="font-size:18px; font-weight:bold">
                            </p>
                        </span>
                        <div class="wrap-input100 validate-input m-b-23" data-validate="É necessário nome de utilizador">
                            <span class="label-input100"></span>
                            <input class="input100" type="text" id="utilizador" name="utilizador" placeholder="Utilizador" onKeyPress="timer1()">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                            <?php
                        if (isset($_SESSION['utilizador_nao_existe'])) {
                            echo '<p style="color:#900">Utilizador não registado!</p>';
                            unset($_SESSION["utilizador_nao_existe"]);
                        }
                        if (isset($_SESSION['tentativas_zero'])) {
                            echo '<p style="color:#900">Utilizador bloqueado!</p>';
                            unset($_SESSION["tentativas_zero"]);
                        }
                        ?>
                        </div>
                        <br>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <span class="label-input100"></span>
                            <input class="input100" type="password" id="password" name="password" placeholder="Palavra-Passe" onKeyPress="timer1()">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>
                        <?php
                        if (isset($_SESSION['password_errada'])) {
                            if ($_SESSION['tentativas_restantes']==0) {
                                echo '<p style="color:#900">Password errada! Restam '.$_SESSION['tentativas_restantes'].' tentativa(s). Utilizador bloqueado!</p>';
                            } else {
                                echo '<p style="color:#900">Password errada! Restam '.$_SESSION['tentativas_restantes'].' tentativa(s).</p>';
                            }
                            unset($_SESSION["password_errada"]);
                            unset($_SESSION["tentativas_restantes"]);
                        }
                        ?>
                        <div class="text-right p-t-10 p-b-14">
                            <a href="contactar_administrador.html">
                                Contactar administrador?
                            </a>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">
                                Iniciar sessão
                            </button>
                        </div>
                        <br>
                     <!--   <div align="center">
                         <p id="counter" class="loader"></p>
                        </div> -->
                    </form>
                    <div class="login100-more" style="background-image: url('images/bg-01.jpg'); background-size: 300px 300px;">
                        <br>
                        <br>
                    </div>
                </div>
            </div>


             <script>
            setInterval(function() {
            var div = document.querySelector("#counter");
            var count = div.textContent * 1 - 1;
            div.textContent = count;
            if (count <= 0) {
                window.location.replace("www.example.com");
            }
        }, 1000);
    </script>
                
            <!--===============================================================================================-->
            <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
            <!--===============================================================================================-->
            <script src="vendor/animsition/js/animsition.min.js"></script>
            <!--===============================================================================================-->
            <script src="vendor/bootstrap/js/popper.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
            <!--===============================================================================================-->
            <script src="vendor/select2/select2.min.js"></script>
            <!--===============================================================================================-->
            <script src="vendor/daterangepicker/moment.min.js"></script>
            <script src="vendor/daterangepicker/daterangepicker.js"></script>
            <!--===============================================================================================-->
            <script src="vendor/countdowntime/countdowntime.js"></script>
            <!--===============================================================================================-->
            <script src="js/main.js"></script>

        </body>
        <?php
//**************destroi as variáveis sessão que foram criadas no teste_user.php*************
    unset($_SESSION["permissao_utilizador"]);
    unset($_SESSION["id_utilizador"]);
    unset($_SESSION["utilizador"]);
    session_destroy();
//******************************************************************************************
?>

</html>
