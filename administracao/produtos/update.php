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

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM produtos WHERE idprodutos = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $id);
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nome = $row["nome"];
                    $preco = $row["preco_base"];
                    $iva = $row["iva"];
                    $stock = $row["stock"];
                    $familia = $row["familia_produto_idfamilia_produto"];
                    $empresa = $row["empresa_idEmpresa"];
                }
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Produto</title>
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
                        <h2>Atualizar Produto</h2>
                    </div>
                    <p>Por favor edite os campos em baixo para atualizar o produto.</p>
                    <form name="editar_produto <?php echo $_GET['id']?>" id="editar_produto<?php echo $_GET['id']?>" method="post" action="update_mysql.php" enctype="multipart/form-data">  
                        <input type="text" name="idproduto" id="idproduto<?php echo $_GET['id']?>" value="<?php echo $_GET['id']?>" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Nome do produto:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="nome" name="nome" required value="<?php echo $nome; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Preço Base €</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="number" min="0" step="0.01" name="preco" required value="<?php echo $preco; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">IVA</label>
                            <div class="col-sm-7">
                                <select name="iva" type="number" required class="form-control" value="<?php echo $iva; ?>">
                                    <option selected="<?php echo $iva == 23; ?>" value="23">23%</option>
                                    <option selected="<?php echo $iva == 13; ?>" value="13">13%</option>
                                    <option selected="<?php echo $iva == 6; ?>" value="6">6%</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Stock</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="number" min="0" name="stock" required value="<?php echo $stock ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Empresa:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="empresa" name="empresa" required="required">
                                    <option value="0" style="display:none">Escolha uma opção</option>
                                    <?php
                                    $select = "SELECT
                                                    idEmpresa,
                                                    nome
                                                FROM
                                                    empresa" ;
                                    $resultado = mysqli_query($link, $select);
                                    while ($linha=mysqli_fetch_array($resultado))
                                                {
                                                echo '<option value="'.$linha["idEmpresa"].'" '.($empresa == $linha["idEmpresa"] ? "selected" : "").'>'.utf8_encode($linha["nome"]).'</option>';
                                                };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Familia Produto :</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="familiaproduto" name="familiaproduto" required="required">
                                    <option value="0" style="display:none">Escolha uma opção</option>
                                    <br>
                                    <?php
                                    $select = "SELECT
                                                    idfamilia_produto,
                                                    familia
                                                FROM
                                                    familia_produto" ;
                                    $resultado = mysqli_query($link, $select);
                                    while ($linha=mysqli_fetch_array($resultado)){
                                        echo '<option value="'.$linha["idfamilia_produto"].'" '.($familia == $linha["idfamilia_produto"] ? "selected" : "").'>'.utf8_encode($linha["familia"]).'</option>';
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/produtos/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>