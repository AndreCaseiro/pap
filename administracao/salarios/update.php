<?php
session_start();

if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}

// Include config file
require_once "config.php";

$salariobase  = $salarioatual = $anoatual = $codigovencimento ="";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);

    $sql = "SELECT * FROM salarios WHERE idsalarios = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $salariobase = $row["salario_base"];
                $salarioatual = $row["salario_atual"];
                $anoatual = $row["ano_atual"];
                $codigovencimento = $row["fk_codvencimento"];
            }
        }
    }
   //echo $sql;
    //exit();
    // Close statement
    mysqli_stmt_close($stmt);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Salario</title>
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
                        <h2>Atualizar salario</h2>
                    </div>
                    <p>Edite os campos em baixo para editar o salario!</p>
                    <form name="editar_salario <?php echo $_GET['id']?>" id="editar_salario<?php echo $_GET['id']?>" method="post" action="update_salario_mysql.php" enctype="multipart/form-data">
                    <input type="text" name="idsalarios" id="idsalarios<?php echo $_GET['id']?>" value="<?php echo $_GET['id']?>" style="display:none">
                    <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Salario base: </label>
                            <div class="col-sm-7">
                                <input type="number" name="salariobase" class="form-control" value="<?php echo $salariobase; ?>" >
        	          	    </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Salario atual: </label>
                            <div class="col-sm-7">
                                <input  type="number" name="salarioatual" class="form-control" value="<?php echo $salarioatual; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Ano atual:</label>
                            <div class="col-sm-7">
                                <input type="number" name="anoatual" class="form-control"  maxlength="4" value="<?php echo $anoatual; ?>"required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/salarios/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>