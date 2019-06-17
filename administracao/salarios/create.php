<?php
session_start();
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();


}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$salariobase  = $salarioatual = $datasalariobase = $anoatual = "";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM funcionarios WHERE idlogin = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $salariobase = $row["salario_base"];
                $salarioatual = $row["salario_atual"];
                $datasalariobase = $row["data_salario_base"];
                $anoatual = $row["ano_atual"];
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
    <title>Adicionar Salario</title>
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
                        <h2>Adicionar salario</h2>
                    </div>
                    <p>Para adicionar um novo salario por favor complete os campos em baixo e clique no botao submeter.</p>
                    <form action="create_salario_mysql.php" method="post"  enctype="multipart/form-data">
                             <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Salario Base €</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="number" min="0" name="salariobase"  value="<?php echo $salariobase; ?>" >
        	          	    </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Salario atual €</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="number" min="0" name="salarioatual"  value="<?php echo $salarioatual; ?>" required>
                        </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Data salario base </label>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" name="datasalariobase"  value="<?php echo $datasalariobase; ?>"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Utilizador:</label>
                            <div class="col-sm-7">
                                <select id="utilizador" name="utilizador" required="required" class="form-control">
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
                            <label class="col-sm-5 col-form-label">Funcionario:</label>
                            <div class="col-sm-7">
                                <select id="funcionario" name="funcionario" required="required" class="form-control">
                                	<option value="" style="display:none">Escolha uma opção</option>
                                	<?php
                                 $select = "SELECT
                                 idfuncionarios,
                                 nome
                                 FROM
                                 funcionarios" ;
                                 $resultado = mysqli_query($link, $select);
                                 while ($linha=mysqli_fetch_array($resultado))
                                 {
                                  echo '<option value="'.$linha["idfuncionarios"].'">'.utf8_encode($linha["nome"]).'</option>';
                              };
                              ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Ano atual</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="number" name="anoatual"  value="<?php echo $anoatual; ?>"required>
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
                            <label class="col-sm-5 col-form-label">Código vencimento:</label>
                            <div class="col-sm-7">
                                <select id="codigovencimento" name="codigovencimento" required="required" class="form-control">
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
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
                        <a href="/administracao/salarios/index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>