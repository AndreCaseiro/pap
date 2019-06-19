<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session $_SESSION['permissao'] depois de logout******

//******evita que se introduza diretamento o link no browser e entre*******
if (!isset($_POST['utilizador']))
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

//******************************deteta se o user existe********************************
$select = "SELECT 
				utilizadores.idlogin, 
				utilizadores.utilizador, 
				utilizadores.tentativas,
				utilizadores.descricao_bloqueio_id_descricao_bloqueio, 
				utilizadores.permissoes_id_permissoes 
			FROM 
				utilizadores 
			WHERE utilizadores.utilizador ='".$_POST['utilizador']. "' 
			
			LIMIT 1" ;

//echo $select;
//exit();
		
$resultado = mysqli_query($conn, $select);

$numero_de_linhas = mysqli_num_rows($resultado);

if($numero_de_linhas==0)
	{
		$_SESSION['utilizador_nao_existe']= "1";
		mysqli_close($conn);
		header('Location:/index.php');
		exit();
	}
//*************************************************************************************
else
//*****************deteta se tem tentativas ou se está bloqueado na descrição**********
	{
		$linha=mysqli_fetch_array($resultado);
		if($linha["tentativas"]==0 || $linha["descricao_bloqueio_id_descricao_bloqueio"]!=1)
			{
			$_SESSION['tentativas_zero']= "1";
			mysqli_close($conn);
			header('Location:/index.php');
			exit();	
			}
//**************************************************************************************
		else
			{
			$select = "SELECT 
							utilizadores.idlogin, 
							utilizadores.utilizador, 
                            utilizadores.fotografia,
							utilizadores.tentativas,
							utilizadores.descricao_bloqueio_id_descricao_bloqueio, 
							utilizadores.permissoes_id_permissoes
					 
						FROM 
							utilizadores
						WHERE utilizadores.utilizador ='".$_POST['utilizador']. "' 
						AND utilizadores.password =PASSWORD('".$_POST['password']. "') 
						LIMIT 1" ;
			$resultado = mysqli_query($conn, $select);

			$numero_de_linhas = mysqli_num_rows($resultado);
			if($numero_de_linhas==0)
				{
				$update="UPDATE utilizadores
							SET tentativas = tentativas-1 
								WHERE utilizadores.utilizador ='".$_POST['utilizador']."'
								LIMIT 1";
				mysqli_query($conn,$update);
				
				$_SESSION['tentativas_restantes']= $linha["tentativas"]-1;				
				$_SESSION['password_errada']= "1";
				
				if($_SESSION['tentativas_restantes']==0)
					{
					$update="UPDATE utilizadores
							SET descricao_bloqueio_id_descricao_bloqueio = 2 
								WHERE utilizadores.utilizador ='".$_POST['utilizador']."'
								LIMIT 1";
					mysqli_query($conn,$update);	
					}
				
				mysqli_close($conn);
				header('Location:/index.php');
				exit();
				}
			else
				{
				$update="UPDATE utilizadores
							SET tentativas = 3 
								WHERE utilizadores.utilizador ='".$_POST['utilizador']."'
								LIMIT 1";
				mysqli_query($conn,$update);
				
				
				$linha=mysqli_fetch_array($resultado);
				$_SESSION['permissao_utilizador']= $linha["permissoes_id_permissoes"];
				$_SESSION['id_utilizador']= $linha["idlogin"];
				$_SESSION['utilizador']= $linha["utilizador"];
				$_SESSION['fotografia']= $linha["fotografia"];
                
                $sql_select = "SELECT * FROM funcionarios";
                $resultado_select = mysqli_query($conn, $sql_select);
                $linha_select=mysqli_fetch_array($resultado_select);
                
                if($linha_select > 0) {
                    $_SESSION['idfuncionario'] = $linha_select['idfuncionarios'];
                }

//***************marca entrada na tabela dos logs******************************************
				$insert = "INSERT INTO logs (utilizadores_idlogin, datein)
								VALUES (".$_SESSION['id_utilizador'].",NOW())";
				//echo $insert;
				//exit();
				mysqli_query($conn,$insert);				
				mysqli_close($conn);
//*****************************************************************************************
				
				if($linha["permissoes_id_permissoes"]==1) 
					{
						header('Location:/administracao/index.php');
					};
				if($linha["permissoes_id_permissoes"]==2) 
					{
						header('Location:/funcionario/index.php');
					};
					
				exit();	
				}
			}
	}
?>