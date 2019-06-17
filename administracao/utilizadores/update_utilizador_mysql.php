<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************

require_once "config.php";

$sql = "UPDATE utilizadores
                SET
                    utilizador = '".$_POST['nome']."',
                    password = PASSWORD('".$_POST['password']."'),
                    tentativas = ".$_POST['tentativas'].",
                    permissoes_id_permissoes = '".$_POST['permissoes']."'
                	WHERE idlogin='".$_POST['idlogin']."'";

            //echo $sql;
            //exit();

                     mysqli_query($link,$sql);
                     $_SESSION['utilizador_actualizado_com_sucesso']= "1";
                      mysqli_close($link);
header('Location:/administracao/utilizadores/index.php');
exit();
?>