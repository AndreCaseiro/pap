<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************
require_once "config.php";

$sql = "UPDATE produtos
 SET eliminado = 1
			WHERE idprodutos='".$_POST['idproduto']."'";


		mysqli_query($link,$sql);
		$_SESSION['produto_eliminado_com_sucesso']= "1";

        mysqli_close($link);
header('Location:/administracao/produtos/index.php');
exit();
?>