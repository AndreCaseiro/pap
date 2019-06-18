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

$premios = "";
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
                        <h2 class="pull-left">Salários</h2>
                        <a href="create.php" class="btn btn-primary pull-right">Definir salário</a>
                         <br>
                        <br>
                        <?php
                        if(isset($_POST['pesquisar']))
                        {
                            $valorPesquisar = $_POST['valorPesquisar'];
                            // pesquisar em todas as colunas
                            // usar concat para juntar mais que um valor na pesquisa
                            $query = "SELECT
                                salarios.utilizadores_idlogin AS utilizadores_idlogin,
                                salarios.funcionarios_idfuncionarios AS funcionarios_idfuncionarios,
                                salarios.salario_base AS salario_base,
                                salarios.salario_atual AS salario_atual,
                                salarios.data_salario_base AS data_salario_base,
                                salarios.fk_premios AS fk_premios,
                                utilizadores.utilizador AS utilizador,
                                funcionarios.nome AS nome
                            FROM salarios
                            JOIN funcionarios ON salarios.funcionarios_idfuncionarios = funcionarios.idfuncionarios
                            JOIN utilizadores ON salarios.utilizadores_idlogin = utilizadores.idlogin
                            JOIN premios ON salarios.fk_premios = premios.valor_premio
                            WHERE CONCAT (salarios.data_salario_base, salarios.salario_atual, salarios.salario_base, premios.valor_premio, funcionarios.nome, utilizadores.utilizador) LIKE '%".$valorPesquisar."%'
                            AND salarios.eliminado = 0";
                            $search_result = filterTable($query);
                        }
                         else {
                            $query = "SELECT
                                salarios.utilizadores_idlogin AS utilizadores_idlogin,
                                salarios.funcionarios_idfuncionarios AS funcionarios_idfuncionarios,
                                salarios.salario_base AS salario_base,
                                salarios.salario_atual AS salario_atual,
                                salarios.data_salario_base AS data_salario_base,
                                salarios.fk_premios AS fk_premios,
                                utilizadores.utilizador AS utilizador,
                                funcionarios.nome AS nome
                            FROM salarios
                            JOIN funcionarios ON salarios.funcionarios_idfuncionarios = funcionarios.idfuncionarios
                            JOIN utilizadores ON salarios.utilizadores_idlogin = utilizadores.idlogin
                            WHERE salarios.eliminado = 0";
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
                            <input type="text" name="valorPesquisar" placeholder="Pesquise um salário">
                            <input type="submit" name="pesquisar" value="Pesquisar"></a>
                            <br>
                            <br>
                            <?php
                    require_once "config.php";
                    if ($search_result){
                        if (mysqli_num_rows($search_result) > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Utilizador</th>";
                            echo "<th>Nome do Funcionário</th>";
                            echo "<th>Salário Base</th>";
                            echo "<th>Salário Atual</th>";
                            echo "<th>Data do Salário Base</th>";
                            echo "<th>Prémio Atribuído</th>";
                            echo "<th>Opções</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($search_result)) {
                                echo "<tr>";
                                echo "<td>" . utf8_encode($row['utilizador']) . "</td>";
                                echo "<td>" . utf8_encode($row['nome']) . "</td>";
                                echo "<td>" . $row['salario_base'] . "</td>";
                                echo "<td>" . $row['salario_atual'] . "</td>";
                                echo "<td>" . $row['data_salario_base'] . "</td>";
                                echo "<td>" . $row['fk_premios'] . "</td>";
                                echo "<td>";
                                echo "<a href='read.php?id=". $row['utilizadores_idlogin'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye-open'></span></a>";
                                echo "<a href='update.php?id=". $row['utilizadores_idlogin'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>";
                                echo "<a href='delete.php?id=". $row['utilizadores_idlogin'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span></a>";
                                echo "<a href='atribuirPremio.php?id=". $row['utilizadores_idlogin'] ."' title='AtribuirPremio' data-toggle='tooltip'><span class='fa fa-trophy'></span></a>";
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
                        echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                        </form>
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
     <script src="../dist/js/sb-admin-2.js"></script>
    <?PHP
        if (isset($_SESSION['salario_criado_com_sucesso']))
        {
        ?>
        <script type="text/javascript">
            swal("Sucesso!", "Salário criado com sucesso!", "success");
        </script>
        <?PHP unset($_SESSION["salario_criado_com_sucesso"]);
        }

		if (isset($_SESSION['salario_actualizado_com_sucesso']))
		{
		?>
		<script type="text/javascript">
			swal("Sucesso!", "Salário atualizado com sucesso!", "success");
        </script>
		<?PHP unset($_SESSION["salario_actualizado_com_sucesso"]);
		}

		if (isset($_SESSION['salario_eliminado_com_sucesso']))
		{
		?>
		<script type="text/javascript">
			swal("Sucesso!", "Salário eliminado com sucesso!", "success");
        </script>
		<?PHP unset($_SESSION["salario_eliminado_com_sucesso"]);
        }
	?>
    <?PHP
             if (isset($_SESSION['premio_atribuido_com_sucesso']))
                {
                ?>
                <script type="text/javascript">
                    swal("Sucesso!", "Prémio atribuido com sucesso!", "success");
                </script>
                <?PHP unset($_SESSION["premio_atribuido_com_sucesso"]);
                }
	?>
</body>
</html>