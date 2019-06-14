<?php
session_start();

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
//*************************************************************************
        // Include config file
require_once "config.php";

$nome = $preco = $iva = $stock = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apagar produto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <h1>Apagar produto</h1>
                    </div>
                    <form name="eliminar_produto <?php echo $_GET['id']?>" id="eliminar_produto<?php echo $_GET['id']?>" method="post" action="delete_mysql.php" enctype="multipart/form-data">
                        <div class="alert alert-danger fade in">
                         <input type="text" name="idproduto" id="idproduto<?php echo $_GET['id']?>" value="<?php echo $_GET['id']?>" style="display:none">
                         <p>Tem a certeza que pretende apagar este produto?</p><br>
                         <p>
                            <input type="submit" value="Sim" class="btn btn-success">
                            <a href="index.php" class="btn btn-danger">Não</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>