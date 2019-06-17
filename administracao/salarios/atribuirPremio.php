<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$premios = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Prémios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <div class="page-header">
         <h2>Atribuir Prémio</h2>
     </div>
            <form name="atribuirpremio"  <?php echo $_GET['id']?> id="atribuirpremio<?php echo $_GET['id']?>" action="updatePremio_mysql.php" method="post"  enctype="multipart/form-data">
                <p>Por favor selecione o prémio que deseja atribuir.</p>
                <input type="text" name="idfuncionarios" id="idfuncionarios<?php echo $_GET['id']?>" value="<?php echo $_GET['id']?>" style="display:none">
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Prémio:</label>
                    <div class="col-sm-10">
                        <select id="premio" name="premio" required="required" class="form-control">
                        <option value="0" style="">Escolha uma opção</option>
                            <?php
                                 $select = "SELECT
                                       valor_premio,
                                       observacoes
                                             FROM
                                             premios" ;
                                             $resultado = mysqli_query($link, $select);
                                             while ($linha=mysqli_fetch_array($resultado))
                                            {
                                              echo '<option value="'.$linha["valor_premio"].'">'.utf8_encode($linha["observacoes"]).'</option>';
                                            };
                            ?>
                            </select>
                              </div>
                              </div>
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/salarios/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
            </form>

    </div>
    </div>
    </div>
    </div>
    <?PHP
             if (isset($_SESSION['premio_atribuido_com_sucesso']))
                {
                ?>
                <script type="text/javascript">
                    swal("Sucesso!", "Premio atribuido com sucesso!", "success");
                </script>
                <?PHP unset($_SESSION["premio_atribuido_com_sucesso"]);
                }
	?>
</body>

</html>
