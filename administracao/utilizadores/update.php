<?php
session_start();

if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}

// Include config file
require_once "config.php";

$nome = $password = $tentativas = $permissoes = "";


if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    $sql = "SELECT * FROM utilizadores WHERE idlogin = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $nome = $row["utilizador"];
                $password = $row["password"];
                $tentativas = $row["tentativas"];
                $permissao = $row["permissoes_id_permissoes"];
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
    <title>Atualizar Utilizador</title>
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
                        <h2>Atualizar utilizador </h2>
                    </div>
                    <p>Por favor edite os campos em baixo para atualizar o produto.</p>


                    <form name="editar_utilizador <?php echo $_GET['id']?>" id="editar_utilizador<?php echo $_GET['id']?>" method="post" action="update_utilizador_mysql.php" enctype="multipart/form-data">
                        <input type="text" name="idlogin" id="idlogin<?php echo $_GET['id']?>" value="<?php echo $_GET['id']?>" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Nome do utilizador:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="nome" name="nome" required value="<?php echo utf8_encode($nome); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Password:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="password" name="password" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Tentativas</label>
                            <div class="col-sm-7">
                            <input class="form-control" type="number" min="0" max="20" name="tentativas" required value="<?php echo $tentativas; ?>">
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Permissoes:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="permissoes" name="permissoes" required="required">
                                    <option value="0" style="display:bolt">Escolha uma opção</option>
                                    <br>
                                    <?php
                                    $select = "SELECT
                                                    id_permissoes,
                                                    descricoes
                                                FROM
                                                    permissoes" ;
                                    $resultado = mysqli_query($link, $select);
                                    while ($linha=mysqli_fetch_array($resultado)) {
                                        echo '<option value="'.$linha["id_permissoes"].'" '.($permissao == $linha["id_permissoes"] ? "selected" : "").'>'.utf8_encode($linha["descricoes"]).'</option>';
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/utilizadores/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>