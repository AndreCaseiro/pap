<!doctype html>
<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session 

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=2)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

//*************************************************************************
include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
//*************************************************************************
?>


<html class="no-js" lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dara - Funcionário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="/funcionario/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/funcionario/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/funcionario/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/funcionario/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Script para mudar botão editar para guardar ------------------------------------------------->
    <script>
        window.addEventListener("load", function() {

            document.getElementById("btnSave").style.display = "none";
            document.getElementById("fileToUpload").style.display = "none";
            document.getElementById("foto").style.display = "none";
        });

    </script>


    <!-- **************************** script do preview da imagem a gravar************************* -->
    <script class="jsbin" src="/funcionario/bibliotecas_javascript_upload/jquery.min.js"></script>
    <script class="jsbin" src="/funcionario/bibliotecas_javascript_upload/jquery-ui.min.js"></script>


    <!--[if IE]>
  	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

    <script language="javascript" type="text/javascript">
        function readURL(input, t) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah2' + t).attr('src', e.target.result);
                }
                document.getElementById("blah2" + t).style.display = "block";
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>

    <script language="javascript" type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                document.getElementById("blah").style.display = "block";
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>


    <!-- ********************************************************************************************* -->

</head>


<!-- Incluir sidebar e navbar -->
<?PHP
	
		include ($_SERVER['DOCUMENT_ROOT']."/funcionario/menu.php"); 
	
	?>
<!------------------------------>

<body>
    <form name="editar_funcionario" method="post" action="editar_funcionario_utilizador_mysql.php" enctype="multipart/form-data">

        <!-- Conteudo da página -->

        <div class="container">
            <h1>Meu Perfil</h1>
            <hr>
            <div class="row">



                <!-- Coluna da informação do funcionário -->
                <div class="col-md-6 personal-info">

                    <h3>Dados de Funcionário</h3>
                    <br>


                    <?php
                    $name = $_SESSION['utilizador'];
                
   
                require_once "config.php";
                    $sql = "SELECT * FROM funcionarios WHERE utilizadores_idlogin = (SELECT idlogin FROM utilizadores WHERE utilizador = '" . $_SESSION['utilizador'] . "')";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            $npesquisa = $result;
                             while($row = mysqli_fetch_array($result)){
                                $varcar = $row['nome'];
                                
                               ?>





                    <input type="text" name="idfuncionarios" id="idfuncionarios<?php echo $_SESSION['utilizador']  ?> value=" <?php echo $_SESSION['utilizador'] ?> style="display:none">

                    <input type="text" name="idlogin_escondido" id="idlogin_escondido<?php echo $_SESSION['id_utilizador']?>" value="" style="display:none">
                    <div class="form-group">

                        <label class="col-lg-5 control-label">Nome completo:</label>

                        <input readonly class="form-control" id="nome_funcionario" name="nome_funcionario" type="text" value="<?php echo $row['nome'];?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-5 control-label">Data de Nascimento:</label>

                        <input readonly class="form-control" id="idade_funcionario" name="idade_funcionario" type="date" value="<?php echo $row['idade'];?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-6 control-label">Bilhete de Identidade/CC:</label>

                        <input readonly class="form-control" id="bi_funcionario" name="bi_funcionario" type="text" value="<?php echo $row['bi'];?>">

                    </div>

                    <div class="form-group">
                                        <label class="col-lg-5 control-label">Função:</label>
                                        <input readonly class="form-control" type="text" id="funcao_funcionario" name="funcao_funcionario" value="<?php
                                            $sql_1 = "SELECT funcao FROM codigo_vencimento WHERE codigo_vencimento.idcodigo_vencimento='".$row['funcao']."'";
                                            $result_1 = mysqli_query($link,$sql_1);
                                            while($row_1 = mysqli_fetch_array($result_1)) {
                                                echo utf8_encode($row_1['funcao']);
                                            }
                                        ?>">
                                    </div>

                    <div class="form-group">
                        <label class="col-lg-5 control-label">Endereço:</label>

                        <input readonly class="form-control" type="text" id="endereco_funcionario" name="endereco_funcionario" value="<?php echo utf8_encode($row['endereco']);?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-5 control-label">Email:</label>

                        <input readonly class="form-control" type="email" id="email_funcionario" name="email_funcionario" value="<?php echo $row['email'];?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Cidade:</label>

                        <input readonly class="form-control" type="text" id="cidade_funcionario" name="cidade_funcionario" value="<?php echo $row['cidade'];?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Telemóvel:</label>

                        <input readonly class="form-control" type="tel" id="telemovel_funcionario" name="telemovel_funcionario" value="<?php echo $row['telemovel'];?>">

                    </div>

                    <br>

                    <?php
                             
                             }
        
                        }
                        mysqli_free_result($result);
                    }
          ?>
                    <?php              
         
        require_once "config.php";
		 $name = $_SESSION['utilizador'];

		
		$sql = "SELECT * FROM utilizadores WHERE utilizador ='" . $_SESSION['utilizador'] . "'";
		
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
	?>
                    <!-- Coluna dados de utilizador -->
                    <h3>Dados de Utilizador</h3>
                    <br>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Nome de Utilizador:</label>
                        <input readonly class="form-control" type="text" id="nome_utilizador" name="nome_utilizador" value="<?php echo $row['utilizador'];?>">

                    </div>
					
                    <div class="form-group">
                        <label class="col-md-5 control-label">Palavra-Passe:</label>
                        <input readonly class="form-control" id="password_utilizador" name="password_utilizador" type="password" value="********">
                    </div>
                    <?php                             
				}        
			}
			
			mysqli_free_result($result);                       
		}
		 
		?>

                    <br>
                    <br>
                    <br>

                </div>



                <!-- Coluna para editar foto de perfil -->
                <div class="col-md-6" align="center">

                    <div class="text-center" align="center">

                        <?php  
                        require_once "config.php";
                         $name = $_SESSION['utilizador'];

                        
                        $sql = "SELECT * FROM utilizadores WHERE utilizador ='" . $_SESSION['utilizador'] . "'";
                        
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
	               ?>

                        <div align="center">

                            <h6><strong>Foto de Perfil</strong></h6><br>
                            <?php if($row['fotografia'] != ''){ ?>
                            <img src="/images/imagens_utilizador/<?php echo $row['fotografia']?>" <?php echo $row['idlogin']?> id="blah" height="140" width="140" />
                            <?php } else{ ?>
                            <img src="/images/desconhecido.png" <?php echo $row['idlogin']?> id="blah2" height="140" width="140" />
                            <?php } ?>

                            <br>
                            <br>
                            <h6 id="foto" name="foto">Selecione uma foto de perfil...</h6>
                            <br>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this,<?php echo $row['idlogin']?>)">
                            <?php
                            if (isset($_SESSION['imagem_demasiado_grande'])) {
                                echo '<p style=" color:#F00; font-weight:bold"">Ficheiro demasiado grande! Tente novamente com outro ficheiro com tamanho inferior a 500KB.</p>';
                                unset($_SESSION["imagem_demasiado_grande"]);    
                            }
                            if (isset($_SESSION['tipo_imagem_errada'])) {
                                echo '<p style=" color:#F00; font-weight:bold"">Tipo de ficheiro errado! Tente com ficheiros do tipo ".jpg; .bmp; jpeg".</p>';
                                unset($_SESSION["tipo_imagem_errada"]); 
                            }                           
                        ?>
                        </div>

                        <?php                             
				}        
			}
			
			mysqli_free_result($result);                       
		}
		?>
                        <hr>
                        <h4 align="center"><span class="fa fa-cog"></span> Opções</h4>
                        <br>
                        <div class="col-md-12" align="center">

                            <!--Script para alterar campos de texto para editáveis-->
                            <script>
                                $(document).ready(function() {

                                    $('#btnEdit').click(function(e) {
                                        e.preventDefault();
                                        $("input[name='nome_utilizador']").prop("readonly", true);
                                        $("input[name='password_utilizador']").prop("readonly", false);
                                        $("input[name='nome_funcionario']").prop("readonly", false);
                                        $("input[name='idade_funcionario']").prop("readonly", false);
                                        $("input[name='bi_funcionario']").prop("readonly", true);
                                        $("input[name='funcao_funcionario']").prop("readonly", true);
                                        $("input[name='endereco_funcionario']").prop("readonly", false);
                                        $("input[name='email_funcionario']").prop("readonly", false);
                                        $("input[name='cidade_funcionario']").prop("readonly", false);
                                        $("input[name='telemovel_funcionario']").prop("readonly", false);
                                    });
                                });

                            </script>

                            <!--Script para alterar campos de texto para não editáveis-->
                            <script>
                                $(document).ready(function() {

                                    $('#btnSave').click(function(e) {
                                        e.preventDefault();
                                        $("input[name='utilizador']").prop("readonly", true);
                                        $("input[name='password']").prop("readonly", true);
                                        $("input[name='nome']").prop("readonly", true);
                                        $("input[name='idade']").prop("readonly", true);
                                        $("input[name='bi']").prop("readonly", true);
                                        $("input[name='funcao']").prop("readonly", true);
                                        $("input[name='endereco']").prop("readonly", true);
                                        $("input[name='email']").prop("readonly", true);
                                        $("input[name='cidade']").prop("readonly", true);
                                        $("input[name='telemovel']").prop("readonly", true);
                                    });
                                });

                            </script>


                            <!--<p align="center"><button type="button" id="btnSave" name="btnSave" onclick="guardar();" class="btn btn-dark"><span class="fa fa-save"></span> Fechar Alterações</button></p>-->

                            <!--Script para esconder botão de guardar alterações e mostrar botão editar perfil-->
                            <script>
                                function guardar() {
                                document.getElementById("btnSave").style.display = "none";
                                document.getElementById("fileToUpload").style.display = "none";
								document.getElementById("foto").style.display = "none";
								document.getElementById("btnEdit").style.display = "block";
                            }

                        </script>



                            <p align="center"><button type="button" id="btnEdit" onclick="editar();" class="btn btn-dark"><span class="fa fa-pencil"></span> Editar Perfil</button></p>
                            
                            <p align="center"><button type="submit" id="guardaralteracoes" name="guardaralteracoes" class="btn btn-dark"><span class="fa fa-save"></span> Guardar Alterações</button></p>
                            
                            <!--Script para esconder botão de editar perfil e mostrar botão guardar alterações-->
                            <script>
                                function editar() {
                                    //document.getElementById("btnSave").style.display = "block";
                                    document.getElementById("fileToUpload").style.display = "block";
                                    document.getElementById("foto").style.display = "block";
                                    document.getElementById("btnEdit").style.display = "none";
                                }

                            </script>
                            <hr>




                        </div>

                    </div>

                </div>

            </div>

        </div>
    </form>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <?PHP 
		if (isset($_SESSION['utilizador_actualizado_com_sucesso']))
		{
		?>
    <script type="text/javascript">
        swal("Sucesso!", "Dados alterados com sucesso!", "success");

    </script>
    <?PHP unset($_SESSION["utilizador_actualizado_com_sucesso"]);	
		}


		if (isset($_SESSION['utilizador_eliminado_com_sucesso']))
		{
		?>
    <script type="text/javascript">
        swal("Sucesso!", "Utilizador eliminado com sucesso!", "success");

    </script>
    <?PHP unset($_SESSION["utilizador_eliminado_com_sucesso"]);	
		}
		
		if (isset($_SESSION['utilizador__empresa_nao_pode_ser_eliminado']))
		{
		?>
    <script type="text/javascript">
        swal("Erro!", "Utilizador não pode ser eliminado!", "error");

    </script>
    <?PHP unset($_SESSION["utilizador__empresa_nao_pode_ser_eliminado"]);	
		}

		if (isset($_SESSION['utilizador_nao_e_empresa_ou_admin']))
		{
		?>
    <script type="text/javascript">
        swal("Erro!", "Não tem permissão para eliminar administradores!", "error");

    </script>
    <?PHP unset($_SESSION["utilizador_nao_e_empresa_ou_admin"]);	
		}
	?>


    <!-- Fim do conteudo da página -->





    <!-- Right Panel -->

    <script src="/funcionario/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/funcionario/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="/funcionario/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/funcionario/assets/js/main.js"></script>
    <script src="/funcionario/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="/funcionario/assets/js/dashboard.js"></script>
    <script src="/funcionario/assets/js/widgets.js"></script>
    <script src="/funcionario/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/funcionario/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="/funcionario/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);

    </script>

    <script>
        function muda_pass(p) {
            if (document.getElementById('muda_password' + p).checked == true) {
                document.getElementById('password' + p).readOnly = false;
                document.getElementById('password' + p).value = "";
            } else {
                document.getElementById('password' + p).readOnly = true;
                document.getElementById('password' + p).value = "*************";
            };
        }

        function altera_dados(e) {
            document.getElementById("idlogin_escondido" + e).value = e;
            f = "editar_utilizador" + e;
            document.getElementById(f).submit();
        }

    </script>

</body>

</html>
