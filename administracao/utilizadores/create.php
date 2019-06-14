<?php
session_start();

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}
// Incluir ficheiro config
require_once "config.php";

//Definir as variaveis
$utilizador  = "";
$utilizador_err  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Validar o nome do produto
    $input_utilizador = trim($_POST["utilizador"]);
    if (empty($input_utilizador)) {
        $utilizador_err = "Por favor introduza o nome do produto";
    } elseif (!filter_var($input_utilizador, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $utilizador_err = "Introduza um nome valido!";
    } else {
        $utilizador = $input_utilizador;
    }

//Verificar se existem erros antes de realizar o insert
    if (empty($utilizador_err)) {
        $sql = "INSERT INTO utilizadores (utilizador, password, tentativas , permissoes_id_permissoes , descricao_bloqueio_id_descricao_bloqueio , eliminado)
		VALUES ('".$_POST['utilizador']."', PASSWORD('".$_POST['password']."'), '".$_POST['tentativas']."', '".$_POST['permissao']."', 1 , 0 )";
        if ($stmt = mysqli_prepare($link, $sql) or die(mysqli_error($link))) {
            mysqli_stmt_bind_param($stmt, "s", $param_utilizador);
            $param_utilizador = $utilizador;

            //Executar o statement!
            if (mysqli_stmt_execute($stmt)) {
                // Se o utilizador foi criado , vai voltar para a pagina index!
                header("location: index.php");
                exit();
            } else {
                echo "Algo correu mal , tente mais tarde.";
            }
        }
        // Fechar o  statement
        mysqli_stmt_close($stmt);
    }
    // Fechar a conexão
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar utilizador</title>
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
                        <h2>Adicionar utilizador</h2>
                    </div>
                    <p>Para adicionar um novo utilizador por favor complete os campos em baixo e clique no botao submeter.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group row<?php echo (!empty($utilizador_err)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-5 col-form-label">Nome do utilizador: </label>
                            <div class="col-sm-7">
                                <input type="text" name="utilizador" class="form-control" value="<?php echo $utilizador; ?>" >
                                <span class="help-block"><?php echo $utilizador_err;?></span>
        	          	    </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Palavra-passe </label>
                            <div class="col-sm-7">
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Tentativas:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="tentativas" name="tentativas"  required="required">
                                    <option  value="" style="display:bolt" >Escolha uma opção</option>
                                    <?php
                                    for ($i=0;$i<21; $i++) {
                                        if ($i==3) {
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        } else {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Permissao</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="permissao" name="permissao" required="required">
                                    <option value="" style="display:bolt">Escolha uma opção</option>
                                    <?php
                                    $select = "SELECT
                                                    id_permissoes,
                                                    descricoes
                                                FROM
                                                    permissoes" ;
                                    $resultado = mysqli_query($link, $select);
                                    while ($linha=mysqli_fetch_array($resultado)) {
                                        echo '<option value="'.$linha["id_permissoes"].'">'.utf8_encode($linha["descricoes"]).'</option>';
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