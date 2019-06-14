<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************

require_once "config.php";

$sql = "INSERT INTO funcionarios (nome, data_nascimento , bi , data_admicao , eliminado , funcao , utilizadores_idlogin, empresa_idEmpresa, endereco , email , cidade , telemovel)
VALUES ('".$_POST['utilizador']."', '".$_POST['datanascimento']."', '".$_POST['bi']."','".$_POST['dataadmicao']."', 0 , '".$_POST['funcao']."', '".$_SESSION['id_utilizador']."', '".$_POST['empresa']."', '".$_POST['endereco']."', '".$_POST['email']."', '".$_POST['cidade']."', '".$_POST['telemovel']."')";
//echo $sql;
//exit();

                     mysqli_query($link,$sql);
                      mysqli_close($link);
header('Location:/administracao/funcionarios/index.php');
exit();
?>