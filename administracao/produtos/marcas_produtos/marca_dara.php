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
                        <h2 class="pull-left">Produtos Dara</h2>
                    </div>
                    <?php
    if(isset($_POST['pesquisar']))
    {
        $valorPesquisar = $_POST['valorPesquisar'];
        // pesquisar em todas as colunas
        // usar concat para juntar mais que um valor na pesquisa
        $query = "SELECT *
        FROM produtos
        WHERE
        (nome LIKE '%".$valorPesquisar."%'
        OR
        preco_base LIKE '%".$valorPesquisar."%'
        OR
        stock LIKE '%".$valorPesquisar."%'
        OR
        iva LIKE '%".$valorPesquisar."%'
        OR
        preco_com_iva LIKE '%".$valorPesquisar."%')
        AND eliminado = 0
        AND empresa_idEmpresa=1";
        $search_result = filterTable($query);
    }
    else {
        $query = "SELECT produtos.* FROM produtos WHERE produtos.eliminado = 0 AND empresa_idEmpresa=1";
        $search_result = filterTable($query);
    }
    // função para fazer a conexão à base de dados e executar a query
    function filterTable($query)
    {
        $connect = mysqli_connect("localhost", "root", "", "pap_database");
        $filter_Result = mysqli_query($connect, $query);
        return $filter_Result;
    }
    ?>
    <form action="" method="post">
    <input type="text" name="valorPesquisar" placeholder="Pesquise um produto">
    <input type="submit" name="pesquisar" value="Pesquisar"></a>
    <br>
    <br>
                    <?php
                    // Include config file
                    require_once "config.php";
                    // Attempt select query execution
                    if($search_result){
                        if(mysqli_num_rows($search_result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nome</th>";
										echo "<th>Preço Base</th>";
                                        echo "<th>Stock</th>";
                                        echo "<th>IVA</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($search_result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['preco_base'] . "€</td>";
										echo "<td>" . $row['stock'] . "</td>";
                                        echo "<td>" . $row['iva'] . "%</td>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($search_result);
                        } else{
                            echo "<p class='lead'><em>Não foram encontrados resultados para a sua pesquisa.</em></p>";
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