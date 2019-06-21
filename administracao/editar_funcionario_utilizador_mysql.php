<?php 
require_once "config.php";
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start(); 
$idlogin_escondido = $_SESSION["id_utilizador"];



						/*
***************ESTES ini_set não funcionam sempre, É necessário configurar manualmente no PHP.ini**********************************************************
                        	echo ini_get('upload-max-filesize'),'<br />'
,ini_get('post-max-size');'<br />'; exit(); */
							ini_set('upload_max_filesize', 30000000); //It specifies the maximum file size (in bytes) that the PHP engine will accept. The default value is 2M (2 * 1048576 bytes).
							ini_set('post_max_size', 40000000); //It specifies the maximum size (in bytes) of HTTP POST data that is permitted. The default value is 8M (8 * 1048576 bytes). Make sure this value is greater than that of the upload_max_filesize directive.
							ini_set('memory_limit', 50000000); //It specifies the maximum amount of memory (in bytes) that is allowed for use by a PHP script. The default value is 16M (16 * 1048576 bytes). This value should be greater than that of the post_max_size directive.
							ini_set('max_input_time', 90); //It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to receive the client's HTTP request. The default value is 60. If you need to support large file upload, you may need to increase this value to prevent timeouts. Note that some users may have a slow connection. You have to take that into account.
							ini_set('max_execution_time', 90); // It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to execute. The default value is 30. If you need to process large uploaded files with PHP, you may need to increase this value to prevent timeouts.


//******evita que se introduza diretamento o link no browser e entre*******
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

//include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
/*
echo $_POST['idlogin_escondido'];
$a='nome'.$_POST['idlogin_escondido'];
$a=$_POST[$a];
echo $a;
exit(); */

//$_SESSION['utilizador_actualizado_com_sucesso']= "1";



mysqli_query($link, "UPDATE funcionarios SET nome = '".$_POST['nome_funcionario']."', idade = '".$_POST['idade_funcionario']."', endereco = '".$_POST['endereco_funcionario']."', email = '".$_POST['email_funcionario']."', cidade = '".$_POST['cidade_funcionario']."', telemovel = '".$_POST['telemovel_funcionario']."' WHERE idfuncionarios='".$idlogin_escondido."'");


if($_POST['password_utilizador']!= '********'){
mysqli_query($link, "UPDATE utilizadores SET password = PASSWORD('".$_POST['password_utilizador']."') WHERE idlogin='".$_SESSION['id_utilizador']."'");
}

            //echo $sql;
            //exit();

$_SESSION['utilizador_actualizado_com_sucesso']= "1";

if($_FILES["fileToUpload"]["name"]!='')
	{ 
		$extensao_ficheiro = (pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
		//****************************upload imagem*********************
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/images/imagens_utilizador/";

		$target_file = $target_dir.$idlogin_escondido.".".$extensao_ficheiro;

		//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //exit();
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		chmod($target_file, 777);
		$update="UPDATE utilizadores
					SET fotografia ='".$_SESSION['id_utilizador'].".".$extensao_ficheiro."'
					WHERE idlogin='".$_SESSION['id_utilizador']."'
						LIMIT 1";
		mysqli_query($link,$update);

		//****************************************************************
	}


$sql = "SELECT fotografia FROM utilizadores WHERE idlogin = '" . $_SESSION['id_utilizador']."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['fotografia']= $row['fotografia'];

header('Location:/administracao/pagina_perfil.php');
exit();
?>