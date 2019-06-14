<!doctype html>
<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************

//*************************************************************************
include($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
//*************************************************************************

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

    <!-- Script para mudar botão editar para guardar ------------------------------------------------->
    <script>
        function botao() {
            document.getElementById("btnSave").style.display = "none";
            document.getElementById("fileToUpload").style.display = "none";
            document.getElementById("foto").style.display = "none";
        }

    </script>


    <!-- **************************** script do preview da imagem a gravar************************* -->
    <script class="jsbin" src="/administracao/bibliotecas_javascript_upload/jquery.min.js"></script>
    <script class="jsbin" src="/administracao/bibliotecas_javascript_upload/jquery-ui.min.js"></script>


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
<?php
    
        include($_SERVER['DOCUMENT_ROOT']."/administracao/menu.php");
    
    ?>
<!------------------------------>

<body onload="botao()">


    <!-- Conteudo da página -->

    <div class="container">
        <h1>Meu Perfil</h1>
        <hr>
        <div class="row">


            <!-- edit form column -->
            <div class="col-md-7 personal-info">

                <h3>Dados de Funcionário</h3>
                <br>


                <?php
        $name = $_SESSION['utilizador'];
        require_once "config.php";
          $sql = "SELECT * FROM funcionarios WHERE utilizadores_idLogin = (SELECT idlogin FROM utilizadores WHERE utilizador = '" . $_SESSION['utilizador'] . "')";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            $npesquisa = $result;
                            while ($row = mysqli_fetch_array($result)) {
                                $varcar = $row['nome']; ?>
                    <input type="text" name="idlogin_escondido" id="idlogin_escondido<?php  $row['nome']?>" value="" style="display:none">
                    <div class="form-group">

                        Nome Completo:<input readonly class="form-control" type="readonly" id="nome" name="nome" value="<?php echo $row['nome']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">Data de Nascimento:</label>

                        <input readonly class="form-control" id="idade" name="idade" type="date" value="<?php echo $row['idade']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bilhete de Identidade/CC:</label>

                        <input readonly class="form-control" id="bi" name="bi" type="text" value="<?php echo $row['bi']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Função:</label>

                        <input readonly class="form-control" type="text" id="funcao" name="funcao" value="<?php echo $row['funcao']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Endereço:</label>

                        <input readonly class="form-control" type="text" id="endereco" name="endereco" value="<?php echo $row['endereco']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>

                        <input readonly class="form-control" type="text" id="email" name="email" value="<?php echo $row['email']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Cidade:</label>

                        <input readonly class="form-control" type="text" id="cidade" name="cidade" value="<?php echo $row['cidade']; ?>">

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Telemóvel:</label>

                        <input readonly class="form-control" type="text" id="telemovel" name="telemovel" value="<?php echo $row['telemovel']; ?>">

                    </div>

                    <br>

                    <?php
                            }
                        }
                        // Free result set
                        mysqli_free_result($result);
                    }
                             // Close connection
                   //mysqli_close($link); // nao posso ainda fechar a base de dados
                    //echo "<th> Result :  $npesquisa </th>";
          ?>
                    <?php
        require_once "config.php";
         $name = $_SESSION['utilizador'];

        // echo "<th>Nome admin :>>  $name </th><br />";
        $sql = "SELECT * FROM utilizadores WHERE utilizador ='" . $_SESSION['utilizador'] . "'";
        // echo "<th>sql :>>  $sql </th>"; // echo para teste
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <h3>Dados de Utilizador</h3>
                    <br>


                    <div class="form-group">
                        <label class="col-md-4 control-label">Nome de Utilizador:</label>
                        <input readonly class="form-control" type="text" id="utilizador" name="utilizador" value="<?php echo $row['utilizador']; ?>">

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Palavra-Passe:</label>
                        <input readonly class="form-control" id="password" name="password" type="password" value="<?php echo $row['password']; ?>">
                    </div>

                    <?php
                }
            }
            // Free result set
            mysqli_free_result($result);
        }
         // Close connection
        //mysqli_close($link);
        ?>
            </div>



            <!-- left column -->
            <div class="col-md-5" align="center">

                <div class="text-center" align="center">

                    <?php
                        require_once "config.php";
                         $name = $_SESSION['utilizador'];

                        // echo "<th>Nome admin :>>  $name </th><br />";
                        $sql = "SELECT * FROM utilizadores WHERE utilizador ='" . $_SESSION['utilizador'] . "'";
                        // echo "<th>sql :>>  $sql </th>"; // echo para teste
                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>

                    <form name="editar_foto<?php echo $row['idlogin']?>" id="editar_foto<?php echo $row['idlogin']?>" method="post" action="editar_utilizador_mysql.php" enctype="multipart/form-data">

                        <div align="center">

                            <!--     <img src="/images/desconhecido.jpg" id="blah" height="140" width="140" /> -->

                            <!--  <img src="/images/imagens_utilizador/<?php //echo $row['fotografia']?>" id="blah<?php // echo $row['idlogin']?>" height="140" width="140" /> -->

                            <h6><strong>Foto de Perfil</strong></h6><br>
                            <?php if ($row['fotografia'] != '') { ?>
                            <img src="/images/imagens_utilizador/<?php echo $row['fotografia']?>" <?php echo $row['idlogin']?> id="blah" height="140" width="140" />
                            <?php } else { ?>
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
                                    } ?>
                            </div>
                    </form>
                    <?php
                                }
                            }
                            // Free result set
                            mysqli_free_result($result);
                        }
         // Close connection
        //mysqli_close($link);
        ?>
                    <hr>
                    <h4 align="center"><span class="fa fa-cog"></span> Opções</h4>
                    <br>
                    <div class="col-md-12" align="center">



                        <p align="center"><button type="button" id="btnSave" name="btnSave" onclick="guardar();" class="btn btn-dark"><span class="fa fa-save"></span> Guardar alterações</button></p>

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

                        <!--Script para esconder botão de editar perfil e mostrar botão guardar alterações-->
                        <script>
                            function editar() {
                                document.getElementById("btnSave").style.display = "block";
                                document.getElementById("fileToUpload").style.display = "block";
                                document.getElementById("foto").style.display = "block";
                                document.getElementById("btnEdit").style.display = "none";
                            }

                        </script>
                        <hr>

                        <!--Script para alterar campos de texto para editáveis-->
                        <script>
                            $(document).ready(function() {

                                $('#btnEdit').click(function(e) {
                                    e.preventDefault();
                                    $("input[name='utilizador']").prop("readonly", false);
                                    $("input[name='password']").prop("readonly", false);
                                    $("input[name='nome']").prop("readonly", false);
                                    $("input[name='idade']").prop("readonly", false);
                                    $("input[name='bi']").prop("readonly", true);
                                    $("input[name='funcao']").prop("readonly", true);
                                    $("input[name='endereco']").prop("readonly", false);
                                    $("input[name='email']").prop("readonly", false);
                                    $("input[name='cidade']").prop("readonly", false);
                                    $("input[name='telemovel']").prop("readonly", false);
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
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <?php
        if (isset($_SESSION['utilizador_actualizado_com_sucesso'])) {
            ?>
    <script type="text/javascript">
        swal("Sucesso!", "Utilizador atualizado com sucesso!", "success");

    </script>
    <?php unset($_SESSION["utilizador_actualizado_com_sucesso"]);
        }


        if (isset($_SESSION['utilizador_eliminado_com_sucesso'])) {
            ?>
    <script type="text/javascript">
        swal("Sucesso!", "Utilizador eliminado com sucesso!", "success");

    </script>
    <?php unset($_SESSION["utilizador_eliminado_com_sucesso"]);
        }
        
        if (isset($_SESSION['utilizador__empresa_nao_pode_ser_eliminado'])) {
            ?>
    <script type="text/javascript">
        swal("Erro!", "Utilizador não pode ser eliminado!", "error");

    </script>
    <?php unset($_SESSION["utilizador__empresa_nao_pode_ser_eliminado"]);
        }

        if (isset($_SESSION['utilizador_nao_e_empresa_ou_admin'])) {
            ?>
    <script type="text/javascript">
        swal("Erro!", "Não tem permissão para eliminar administradores!", "error");

    </script>
    <?php unset($_SESSION["utilizador_nao_e_empresa_ou_admin"]);
        }
    ?>


    <!-- Fim do conteudo da página -->





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
