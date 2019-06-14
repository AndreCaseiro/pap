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
                        <h2 class="pull-left">Salários Funcionários Dara</h2>
                 
                        
                         <br>
                        <br>

                        <?php

                        if(isset($_POST['pesquisar']))
                        {
                            $valorPesquisar = $_POST['valorPesquisar'];
                            // pesquisar em todas as colunas
                            // usar concat para juntar mais que um valor na pesquisa
                            $query = "SELECT * FROM `salarios` WHERE fk_empresa = 1 AND CONCAT (`idsalarios`, `data_salario_base`, `utilizadores_idlogin`, `funcionarios_idfuncionarios`, `fk_empresa`, `fk_premios`, `fk_codvencimento`) LIKE '%".$valorPesquisar."%'";
                            $search_result = filterTable($query);

                        }
                         else {
                            $query = "SELECT * FROM `salarios` WHERE fk_empresa = 1";
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
                            <input type="submit" name="pesquisar" value="Pesquisar"><br><br>

                            <table class='table table-bordered table-striped'>
                                <tr>
                                    <th>Utilizador</th>
                                    <th>Nome do Funcionário</th>
                                    <th>Salário Base</th>
                                    <th>Salário Atual</th>
                                    <th>Data do Salário Base</th>
                                    <th>Prémio Atribuído</th>
                                    <th>Opções</th>
                                </tr>



                                <!-- preencher tabela com dados da base de dados -->
                                <?php
                
                 
                
                while($row = mysqli_fetch_array($search_result)):

                
                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['utilizadores_idlogin'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['funcionarios_idfuncionarios'];?></td>
                                    <td>
                                        <?php echo $row['salario_base'];?>€</td>
                                    <td>
                                        <?php echo $row['salario_atual'];?>€</td>
                                    <td>
                                        <?php echo $row['data_salario_base'];?></td>
                                    <td>
                                        <?php echo $row['fk_premios'];?>€</td>
                                    <td>
                                        <?php echo "<a href='read.php?id=". $row['utilizadores_idlogin'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye-open'></span></a>";?>
                                        <?php echo "<a href='update.php?id=". $row['utilizadores_idlogin'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>";?>
                                        <?php echo "<a href='delete.php?id=". $row['utilizadores_idlogin'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span></a>";?>
                                        <?php echo "<a href='atribuirPremio.php?id=". $row['utilizadores_idlogin'] ."' title='AtribuirPremio' data-toggle='tooltip'><span class='fa fa-trophy'></span></a>";?>
                                    </td>
                                </tr>

                                <?php endwhile;?>
                            </table>
                        </form>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    <?php
                        /*
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM salarios WHERE fk_empresa = 1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Utilizador</th>";
                                        echo "<th>Nome do Funcionário</th>";
										echo "<th>Salário Base</th>";
                                        echo "<th>Salário Atual</th>";
                                        echo "<th>Data do Salário Base</th>";
                                        echo "<th>Prémio Atribuído</th>";
                                        echo "<th>Ações</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['utilizadores_idlogin'] . "</td>";
                                         echo "<td>" . $row['funcionarios_idfuncionarios'] . "</td>";
                                        echo "<td>" . $row['salario_base'] . "€</td>";
										echo "<td>" . $row['salario_atual'] . "€</td>";
                                        echo "<td>" . $row['data_salario_base'] . "</td>";
                                        echo "<td>" . $row['fk_premios'] . "€</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['utilizadores_idlogin'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['utilizadores_idlogin'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['utilizadores_idlogin'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span></a>";
                                            echo "<a href='update.php?id=". $row['utilizadores_idlogin'] ."' title='AtribuirPremio' data-toggle='tooltip'><span class='fa fa-trophy'></span></a>";
                                        echo "</td>";
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
                    */
                    ?>
                    </div>
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