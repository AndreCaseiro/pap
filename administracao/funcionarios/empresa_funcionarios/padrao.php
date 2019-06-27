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
    include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
    //*************************************************************************
    ?>

    <html class="no-js" lang="pt">
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
                            <h2 class="pull-left">Funcionários Padrão</h2>
                            <a href="create.php" class="btn btn-primary pull-right">Adicionar Funcionário</a>
                                </div>
                                </div>
                        </div>
                                <?php
                            if(isset($_POST['pesquisar']))
                            {
                                $valorPesquisar = $_POST['valorPesquisar'];
                                    $query = "SELECT
                                    funcionarios.idfuncionarios AS idfuncionarios,
                                    funcionarios.nome AS nome,
                                    funcionarios.utilizadores_idlogin AS utilizadores_idlogin,
                                    funcionarios.data_nascimento AS data_nascimento,
                                    funcionarios.bi AS bi,
                                    funcionarios.data_admicao AS data_admicao,
                                    codigo_vencimento.funcao AS funcao,
                                    funcionarios.empresa_idEmpresa AS empresa_idEmpresa,
                                    funcionarios.endereco AS endereco,
                                    funcionarios.email AS email,
                                    funcionarios.cidade AS cidade,
                                    funcionarios.telemovel AS telemovel
                                FROM funcionarios
                                JOIN utilizadores ON funcionarios.utilizadores_idlogin = utilizadores.idlogin
                                JOIN empresa ON funcionarios.empresa_idEmpresa = empresa.idEmpresa
                                JOIN codigo_vencimento ON funcionarios.funcao = codigo_vencimento.idcodigo_vencimento
                                WHERE
                                (
                                    funcionarios.nome LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.utilizadores_idlogin LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.data_nascimento LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.bi LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.data_nascimento LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.data_admicao LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.empresa_idEmpresa LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.endereco  LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.email LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.cidade LIKE '%".$valorPesquisar."%'
                                OR
                                    funcionarios.telemovel LIKE '%".$valorPesquisar."%'
                                OR
                                    utilizadores.utilizador LIKE '%".$valorPesquisar."%'
                                OR
                                    empresa.nome LIKE '%".$valorPesquisar."%'
                                OR
                                    codigo_vencimento.funcao LIKE '%".$valorPesquisar."%'
                                )
                                AND funcionarios.eliminado = 0
                                AND empresa_idEmpresa=2";
                                $search_result = filterTable($query);
                            }
                            else
                            {
                                $query = "SELECT
                                    funcionarios.idfuncionarios AS idfuncionarios,
                                    funcionarios.nome AS nome,
                                    funcionarios.utilizadores_idlogin AS utilizadores_idlogin,
                                    funcionarios.data_nascimento AS data_nascimento,
                                    funcionarios.bi AS bi,
                                    funcionarios.data_admicao AS data_admicao,
                                    codigo_vencimento.funcao AS funcao,
                                    funcionarios.empresa_idEmpresa AS empresa_idEmpresa,
                                    funcionarios.endereco AS endereco,
                                    funcionarios.email AS email,
                                    funcionarios.cidade AS cidade,
                                    funcionarios.telemovel AS telemovel
                                FROM funcionarios
                                JOIN utilizadores ON funcionarios.utilizadores_idlogin = utilizadores.idlogin
                                JOIN empresa ON funcionarios.empresa_idEmpresa = empresa.idEmpresa
                                JOIN codigo_vencimento ON funcionarios.funcao = codigo_vencimento.idcodigo_vencimento
                                WHERE funcionarios.eliminado = 0
                                AND empresa_idEmpresa=2";
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
                                <input type="text" name="valorPesquisar" placeholder="Pesquise um funcionario">
                                <input type="submit" name="pesquisar" value="Pesquisar"></a>
                                <br>
                                <br>
                        <?php
                        // Include config file
                        require_once "config.php";
                        if($search_result){
                            if(mysqli_num_rows($search_result) > 0){
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
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($search_result)){
                                        echo "<tr>";
                                            echo "<td>" . utf8_encode($row['nome']) . "</td>";
                                            $select = "SELECT
                                        utilizadores.utilizador
                                        FROM
                                        utilizadores
                                        WHERE
                                        utilizadores.idlogin =".$row['utilizadores_idlogin'];
                                        $resultado1 = mysqli_query($conn, $select);
                                        $linha1=mysqli_fetch_array($resultado1);
                                        echo "<td>" . $linha1['utilizador'] . "</td>";
                                            echo "<td>" . $row['data_nascimento'] . "</td>";
                                            echo "<td>" . $row['bi'] . "</td>";
                                            echo "<td>" . $row['data_admicao'] . "</td>";
                                            echo "<td>" . utf8_encode($row['funcao']) . "</td>";
                                            $select = "SELECT
                                        empresa.nome
                                        FROM
                                        empresa
                                        WHERE
                                        empresa.idEmpresa =".$row['empresa_idEmpresa'];
                                        $resultado1 = mysqli_query($conn, $select);
                                        $linha1=mysqli_fetch_array($resultado1);
                                        echo "<td>" . $linha1['nome'] . "</td>";
                                            echo "<td>" . utf8_encode($row['endereco']) . "</td>";
                                            echo "<td>" . $row['cidade'] . "</td>";
                                            echo "<td>" . $row['telemovel'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
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
            if (isset($_SESSION['funcionario_criado_com_sucesso']))
            {
            ?>
            <script type="text/javascript">
                swal("Sucesso!", "Funcionário criado com sucesso!", "success");
            </script>
            <?PHP unset($_SESSION["funcionario_criado_com_sucesso"]);
            }

            if (isset($_SESSION['funcionario_actualizado_com_sucesso']))
            {
            ?>
            <script type="text/javascript">
                swal("Sucesso!", "Funcionário atualizado com sucesso!", "success");
            </script>
            <?PHP unset($_SESSION["funcionario_actualizado_com_sucesso"]);
            }

            if (isset($_SESSION['funcionario_eliminado_com_sucesso']))
            {
            ?>
            <script type="text/javascript">
                swal("Sucesso!", "Funcionário eliminado com sucesso!", "success");
            </script>
            <?PHP unset($_SESSION["funcionario_eliminado_com_sucesso"]);
            }
        ?>
    </body>
    </html>