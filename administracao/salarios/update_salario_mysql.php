<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************
require_once "config.php";

$sql = "UPDATE salarios
                SET
                    salario_base = '".$_POST['salariobase']."',
                    salario_atual = '".$_POST['salarioatual']."',
                    ano_atual = ".$_POST['anoatual'].",
                    fk_codvencimento = '".$_POST['codigovencimento']."'
                	WHERE utilizadores_idlogin='".$_POST['idsalarios']."'";
            //echo $sql;
           //exit();
                     mysqli_query($link,$sql);
                     $_SESSION['salario_actualizado_com_sucesso']= "1";



                      mysqli_close($link);
header('Location:/administracao/salarios/index.php');
exit();
?>