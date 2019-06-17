<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************

require_once "config.php";

$sql = "UPDATE funcionarios
                SET
                    nome = '".$_POST['utilizador']."',
                    data_nascimento = ('".$_POST['datanascimento']."'),
                    bi = ".$_POST['bi'].",
                    data_admicao = '".$_POST['dataadmicao']."',
                    funcao = '".$_POST['funcao']."',
                    endereco = '".$_POST['endereco']."',
                    email = '".$_POST['email']."',
                    cidade = '".$_POST['cidade']."',
                    telemovel = '".$_POST['telemovel']."'
                	WHERE idfuncionarios='".$_POST['idfuncionarios']."'";

                     mysqli_query($link,$sql);
                     $_SESSION['funcionario_actualizado_com_sucesso']= "1";



                      mysqli_close($link);
header('Location:/administracao/funcionarios/index.php');
exit();
?>