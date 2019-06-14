<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************

require_once "config.php";

$sql = "INSERT INTO salarios (salario_base, salario_atual, data_salario_base, utilizadores_idlogin, funcionarios_idfuncionarios, ano_atual, fk_empresa , fk_codvencimento)
VALUES ('".$_POST['salariobase']."', '".$_POST['salarioatual']."', '".$_POST['datasalariobase']."','".$_POST['utilizador']."', '".$_POST['funcionario']."', '".$_POST['anoatual']."',
 '".$_POST['empresa']."', '".$_POST['codigovencimento']."')";
//echo $sql;
//exit();

                     mysqli_query($link,$sql);
                      mysqli_close($link);
header('Location:/administracao/funcionarios/index.php');
exit();
?>