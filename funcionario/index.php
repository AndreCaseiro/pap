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
    <meta charset="utf-8">
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


</head>

<!-- Incluir sidebar e navbar -->
	<?PHP
	
		include ($_SERVER['DOCUMENT_ROOT']."/funcionario/menu.php"); 
	
	?>
    <!------------------------------>


<body>
        <!-- Conteudo da página -->
    <?php  
                        require_once "config.php";
                         $name = $_SESSION['utilizador'];

                        // echo "<th>Nome admin :>>  $name </th><br />";
                        $sql = "SELECT * FROM utilizadores WHERE utilizador ='" . $_SESSION['utilizador'] . "'";
                        // echo "<th>sql :>>  $sql </th>"; // echo para teste
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
	               ?>

    <?php if($row['fotografia'] != ''){ ?>
    
    
    <?php } else{ ?>
    <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Aviso</span>
        É necessário que finalize o seu perfil para continuar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>

    <?php                             
				}        
			}
			// Free result set
			mysqli_free_result($result);                       
		}
		 // Close connection
		//mysqli_close($link); 
		?>
        
        <div class="col-lg-12 col-md-5" align="center">
            <!--  <img class="user-avatar rounded" src="images/logo.png" alt="LogoDara" width="60%" height="60%"> -->
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicadores -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                    <li data-target="#demo" data-slide-to="3"></li>
                    <li data-target="#demo" data-slide-to="4"></li>
                    <li data-target="#demo" data-slide-to="5"></li>
                    <li data-target="#demo" data-slide-to="6"></li>
                </ul>

                <!-- slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/funcionario/imagens_produtos/collant_crianca_aloevera.jpg" alt="Collants">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/cueca_feminina.jpg" alt="Meias">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/cueca_feminina_avo.jpg" alt="Meias">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/meia_cizenta.jpg" alt="Meias">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/meia_laranja.jpg" alt="Meias">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/meia_laranja_sport.jpg" alt="Meias">
                    </div>
                    <div class="carousel-item">
                        <img src="/funcionario/imagens_produtos/meia_preta.jpg" alt="Meias">
                    </div>
                </div>

                <!-- Controlos esquerda direita -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>

        </div>
        <!-- Fim do conteudo da página -->


    </div><!-- /#right-panel -->

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
