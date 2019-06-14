<?php
session_start();

if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1) {
    header('Location:/index.php');
    exit();
}

    // Include config file
require_once "config.php";

    // Define variables and initialize with empty values
$nome = $preco = $iva = $stock = "";
$nome_err = $preco_err = $iva_err = $stock_err = "";


    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
      	 // Validar o nome do produto
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Por favor introduza o nome do produto";
    }  else{
        $nome = $input_nome;
    }

        // Validar o preço
    $input_preco = trim($_POST["preco"]);
    if(empty($input_preco)){
        $preco_err = "Por favor introduza o preço.";
    } else{
        $preco = $input_preco;
    }

        // Validar o IVA
    $input_iva = trim($_POST["iva"]);
    if(empty($input_iva)){
        $iva_err = "Insira a percentagem do iva.";
    } else{
        $iva = $input_iva;
    }

    	// Validar o stock
    $input_stock = trim($_POST["stock"]);
    if(empty($input_stock)){
        $stock_err = "Por favor introduza o stock para o produto.";
    } else{
        $stock = $input_stock;
    }

        // Check input errors before inserting in database
    if(empty($nome_err) && empty($preco_err) && empty($iva_err) && empty($stock_err)){
            // Prepare an insert statement
        $sql = "INSERT INTO produtos (nome, preco_base, iva, preco_com_iva, stock, empresa_idEmpresa, familia_produto_idfamilia_produto) VALUES ('".$_POST['nome']."', ".$_POST['preco'].", ".$_POST['iva']." ,((".$_POST['preco']." * (100 + ".$_POST['iva']." ))/100), '".$_POST['stock']."' , '".$_POST['empresa']."' ,'".$_POST['familiaproduto']."')";
           //  echo $sql;
    		//exit();

        if($stmt = mysqli_prepare($link, $sql) or die(mysqli_error($link))){
                // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nome, $param_preco, $param_iva, $param_stock);

                // Set parameters
            $param_nome = $nome;
            $param_preco = $preco;
            $param_iva = $iva;
            $param_stock = $stock;

                // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

            // Close statement
        mysqli_stmt_close($stmt);
    }

        // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
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
                        <h2>Adicionar Produto</h2>
                    </div>

                    <p>Para adicionar um novo produto por favor complete os campos em baixo e clique no botao submeter.</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row<?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-5 col-form-label">Nome do produto: </label>
                            <div class="col-sm-7">
                                <input type="text" required name="nome" class="form-control" value="<?php echo $nome; ?>">
                                <span class="help-block"><?php echo $nome_err;?></span>
                            </div>
                        </div>

                        <div class="form-group row<?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-5 col-form-label">Preço Base:</label>
                            <div class="col-sm-7">
                                <input type="number" min="0" step="0.01" name="preco" required class="form-control" value="<?php echo $preco; ?>">
                                <span class="help-block"><?php echo $preco_err;?></span>
                            </div>
                        </div>

                        <div class="form-group row<?php echo (!empty($iva_err)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-5 col-form-label">IVA</label>
                            <div class="col-sm-7">
                                <select name="iva" type="number" required class="form-control" value="<?php echo $iva; ?>">
                                <option value="0" required style="display:none">Escolha uma opção</option>
                                    <option value="23">23%</option>
                                    <option value="13">13%</option>
                                    <option value="6">6%</option>
                                </select>
                                <span class="help-block"><?php echo $iva_err;?></span>
                            </div>
                        </div>

                        <div class="form-group row<?php echo (!empty($stock_err)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-5 col-form-label">Stock</label>
                            <div class="col-sm-7">
                                <input type="number" min="0" name="stock" required class="form-control" value="<?php echo $stock ; ?>">
                                <span class="help-block"><?php echo $stock_err;?></span>
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
                    <label class="col-sm-5 col-form-label">Familia Produto :</label>
                    <div class="col-sm-7">
                        <select id="familiaproduto" name="familiaproduto" style="" required="required" class="form-control">
                           <option value="" style="display:bolt">Escolha uma opção</option>
                           <?php
                           $select = "SELECT
                           idfamilia_produto,
                           familia
                           FROM
                           familia_produto" ;
                           $resultado = mysqli_query($link, $select);
                           while ($linha=mysqli_fetch_array($resultado))
                           {
                              echo '<option value="'.$linha["idfamilia_produto"].'">'.utf8_encode($linha["familia"]).'</option>';
                          };

                          ?>
                      </select>
                  </div>
              </div>
              <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Submeter</button>
              <a href="index.php" class="btn btn-outline-secondary btn-lg btn-block">Cancelar</a>
          </form>
      </div>
  </div>
</div>
</div>
</body>
</html>