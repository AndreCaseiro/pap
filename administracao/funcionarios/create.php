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
// Define variables and initialize with empty values
$utilizador  = $datanascimento = $bi = $dataadmicao = $funcao = $endereco = $email = $cidade = $telemovel = "";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    $sql = "SELECT * FROM funcionarios WHERE idlogin = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $utilizador = $row["nome"];
                $datanascimento = $row["data_nascimento"];
                $bi = $row["bi"];
                $dataadmicao = $row["data_admicao"];
                $funcao = $row["funcao"];
                $endereco = $row["endereco"];
                $email = $row["email"];
                $cidade = $row["cidade"];
                $telemovel = $row["telemovel"];
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
    <title>Adicionar funcionário</title>
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
                        <h2>Adicionar funcionário</h2>
                    </div>
                    <p>Para adicionar um novo funcionário por favor complete os campos em baixo e clique no botao submeter.</p>
                    <form action="create_funcionario_mysql.php" method="post"  enctype="multipart/form-data">
                             <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Nome do funcionário: </label>
                            <div class="col-sm-7">
                                <input type="text" name="utilizador" class="form-control" value="<?php echo $utilizador; ?>" >
        	          	    </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Utilizador</label>
                            <div class="col-sm-7">
                            <select id="idutilizador" name="idutilizador" required="required" class="form-control">
                                	<option value="" style="display:none">Escolha uma opção</option>
                                        <?php
                                 $select = "SELECT
                                 idlogin,
                                 utilizador
                                 FROM
                                 utilizadores" ;
                                 $resultado = mysqli_query($link, $select);
                                 while ($linha=mysqli_fetch_array($resultado))
                                 {
                                  echo '<option value="'.$linha["idlogin"].'">'.utf8_encode($linha["utilizador"]).'</option>';
                              };
                              ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Data de Nascimento </label>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" name="datanascimento"  value="<?php echo $datanascimento; ?>"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">BI</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="bi" maxlength="8" value="<?php echo $bi; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Data de Admição </label>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" maxlength="8" name="dataadmicao" value="<?php echo $dataadmicao; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Função</label>
                            <div class="col-sm-7">
                            <select id="funcao" name="funcao" required="required" class="form-control">
                                	<option value="" style="display:none">Escolha uma opção</option>
                                        <?php
                                 $select = "SELECT
                                 idcodigo_vencimento,
                                 funcao
                                 FROM
                                 codigo_vencimento" ;
                                 $resultado = mysqli_query($link, $select);
                                 while ($linha=mysqli_fetch_array($resultado))
                                 {
                                  echo '<option value="'.$linha["idcodigo_vencimento"].'">'.utf8_encode($linha["funcao"]).'</option>';
                              };
                              ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Empresa:</label>
                            <div class="col-sm-7">
                                <select id="empresa" name="empresa" required="required" class="form-control">
                                	<option value="" style="display:none">Escolha uma opção</option>
                                	<?php
                                 $select = "SELECT
                                 idEmpresa,
                                 nome
                                 FROM
                                 empresa" ;
                                 $resultado = mysqli_query($link, $select);
                                 while ($linha=mysqli_fetch_array($resultado))
                                 {
                                  echo '<option value="'.$linha["idEmpresa"].'">'.utf8_encode($linha["nome"]).'</option>';
                              };
                              ?>
                          </select>
                      </div>
                  </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Endereço</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="endereco" value="<?php echo $endereco; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Email</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="email" name="email" value="<?php echo $email; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Cidade</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="cidade" value="<?php echo $cidade; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Telemovel</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="telemovel" maxlength="9" value="<?php echo $telemovel; ?>"required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/funcionarios/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>