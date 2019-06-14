<!doctype html>
<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session 

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
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
    <title>Dara - Administrador</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="/administracao/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/administracao/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/administracao/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/administracao/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/administracao/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/administracao/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/administracao/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


</head>


    <!-- Incluir sidebar e navbar -->
	<?PHP
	
		include ($_SERVER['DOCUMENT_ROOT']."/administracao/menu.php"); 
	
	?>
    <!------------------------------>

<body>
    
    <!-- Conteudo da página -->
        
        

        
          <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Funcionários de Dara</h2>
                        
                        <div class="search-form d-none d-lg-inline-block">
                            <div class="input-group" align="right">
                                <button class="search-trigger"> <i class="fa fa-search"></i></button>
                                <input type="text" name="query" id="search-input" class="form-control" placeholder="Pesquisar um funcionário" autofocus autocomplete="off" />
                            </div>
                            <div id="search-results-container">
                                <ul id="search-results"></ul>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM funcionarios WHERE empresa_idEmpresa = 1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nome Completo</th>";
                                        echo "<th>Nome de Utilizador</th>";
                                        echo "<th>Data de Nascimento</th>";
										echo "<th>Nº de BI</th>";
                                        echo "<th>Data de Admição</th>";
                                        echo "<th>Função</th>";
                                        echo "<th>Empresa</th>";
                                        echo "<th>Endereço</th>";
                                        echo "<th>Cidade</th>";
                                        echo "<th>Telemóvel</th>";
                                        echo "<th>Email</th>";
                                         echo "<th>Ações</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['utilizadores_idlogin'] . "</td>";
                                        echo "<td>" . $row['idade'] . "</td>";
										echo "<td>" . $row['bi'] . "</td>";
                                        echo "<td>" . $row['data_admicao'] . "</td>";
                                        echo "<td>" . $row['funcao'] . "</td>";
                                        echo "<td>" . $row['empresa_idEmpresa'] . "</td>";
                                        echo "<td>" . $row['endereco'] . "</td>";
                                        echo "<td>" . $row['cidade'] . "</td>";
                                        echo "<td>" . $row['telemovel'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['utilizadores_idlogin'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['utilizadores_idlogin'] ."' title='EditarSalario' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['utilizadores_idlogin'] ."' title='EliminarSalario' data-toggle='tooltip'><span class='fa fa-trash'></span></a>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
	
					
    <!-- Fim do conteudo da página -->    
        
        
        
    <!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="/administracao/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/administracao/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="/administracao/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/administracao/assets/js/main.js"></script>


    <script src="/administracao/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="/administracao/assets/js/dashboard.js"></script>
    <script src="/administracao/assets/js/widgets.js"></script>
    <script src="/administracao/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/administracao/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="/administracao/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
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