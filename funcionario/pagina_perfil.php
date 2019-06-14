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


/*
echo '<p style="color:#F00"> Bem vindo: '.$_SESSION['utilizador'].' </p>';
*/

?>


<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt"> 
<!--<![endif]-->

<head>
<meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dara - Funcionário</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

      <!-- **************************** script do preview da imagem a gravar************************* -->
    <script class="jsbin" src="bibliotecas_javascript_upload/jquery.min.js"></script>
    <script class="jsbin" src="bibliotecas_javascript_upload/jquery-ui.min.js"></script>
	<!--[if IE]>
  	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 
    <script language="javascript" type="text/javascript">
	    function readURL(input,t) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah2'+t).attr('src', e.target.result);
            }
            document.getElementById("blah2"+t).style.display="block";
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
	
	</script>

    <script language="javascript" type="text/javascript">
	    function readdURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            document.getElementById("blah").style.display="block";
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
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
    
    <!-- Conteudo da página -->
        
<div class="container">
    <h1>Meu Perfil</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-4">
        <div class="text-center">
         <img src="/images/desconhecido.jpg" id="blah" height="140" width="140" />
            <br>
            <br>
          <h6>Seleciona uma foto de perfil...</h6>
          
        <input type="file" name="fileToUpload" id="fileToUpload" onchange="readdURL(this);">
            
             <?PHP
						
						if (isset($_SESSION['imagem_demasiado_grande']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Ficheiro demasiado grande! Tente novamente com outro ficheiro com tamanho inferior a 500KB.</p>';
								unset($_SESSION["imagem_demasiado_grande"]);	
								}
						if (isset($_SESSION['tipo_imagem_errada']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Tipo de ficheiro errado! Tente com ficheiros do tipo ".jpg; .bmp; jpeg".</p>';
								unset($_SESSION["tipo_imagem_errada"]);	
								}							
						?>
            
            
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-7 personal-info">
        
        <h3>Dados de Funcionário</h3>
        <br>
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nome Completo:</label>
            
              <input class="form-control" type="text" value="Ex: João Pedro">
             
             
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Idade:</label>
            
              <input class="form-control" type="text" value="Ex: 30">
           
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Número BI:</label>
            
              <input class="form-control" type="text" value="Ex: 123456789">
            
          </div>
         
            <div class="form-group">
            <label class="col-lg-3 control-label">Função:</label>
            
              <input class="form-control" type="text" value="Ex: Operador de Máquina">
            
          </div>
            
            
            <div class="form-group">
            <label class="col-md-3 control-label"></label>
            
              <input type="button" class="btn btn-primary" value="Salvar Alterações">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancelar">
            
          </div>
          <br>
            <hr>
        <h3>Dados de Utilizador</h3>
            <br>
            
          <div class="form-group">
            <label class="col-md-4 control-label">Nome de Utilizador:</label>
           
              <input class="form-control" type="text" value="janeuser">
            
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Palavra-Passe:</label>
            
              <input class="form-control" type="password" value="11111122333">
            
          </div>
        
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            
              <input type="button" class="btn btn-primary" value="Salvar Alterações">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancelar">
            
          </div>
        </form>
      </div>
  </div>
</div>
					
    <!-- Fim do conteudo da página -->    
        
        
        
    <!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
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

</body>

</html>
