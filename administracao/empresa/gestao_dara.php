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



<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
    }

</style>

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
                <div class="col-md-4">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gastos da Empresa DARA</h2>

                    </div>

                    <br>
                    <form>
                        <label>Selecione o ano:</label>
                        <select id="ano" onchange="getSelectValue();">
                            <option disabled>Por favor selecione o ano...</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                        </select>
                    </form>
                    <br>


                    <script>
                        function getSelectValue() {
                            var selectedValue = document.getElementById("ano").value;
                            console.log(selectedValue);
                        }
                        getSelectValue();

                    </script>


                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    
                    // Attempt select query execution
                    $sql = "SELECT preco_base FROM produtos WHERE ano_atual = 2019 AND empresa_idEmpresa = 1";
                    $sql2 = "SELECT salario_base FROM salarios WHERE ano_atual = 2019 AND fk_empresa = 1";
                    $result = mysqli_query($link, $sql);
                    $result2 = mysqli_query($link, $sql2);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                         $preco_base = $row["preco_base"];
                    }
                    
                    while ($row = mysqli_fetch_assoc($result2)) {
                         $salario_base = $row["salario_base"];
                    }
                    
                    $soma = $preco_base + $salario_base; 
                    
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Gastos da empresa em salários/produtos em 2019</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    echo "<tr>";
                                        echo "<td>" . $soma . "€</td>";
                                        echo "</td>";
                                    echo "</tr>";
                                
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
 
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
