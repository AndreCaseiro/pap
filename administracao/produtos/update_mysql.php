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
                SET
                    nome = '".$_POST['nome']."',
                    preco_base = ".$_POST['preco'].",
                    iva = ".$_POST['iva'].",
                    preco_com_iva = ((".$_POST['preco']." * (100 + ".$_POST['iva']." ))/100),
                    stock = '".$_POST['stock']."',
                    empresa_idEmpresa = '".$_POST['empresa']."',
                    familia_produto_idfamilia_produto = '".$_POST['familiaproduto']."'
                	WHERE idprodutos='".$_POST['idproduto']."'";

                     mysqli_query($link,$sql);
                     $_SESSION['produto_actualizado_com_sucesso']= "1";



                      mysqli_close($link);
header('Location:/administracao/produtos/index.php');
exit();
?>