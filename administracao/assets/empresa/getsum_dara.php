
<!DOCTYPE html>
<html>
    
    
    
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
    

<?php
    
ini_set('display_errors', 1); ini_set('log_errors',1); error_reporting(E_ALL); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','pap_database');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"pap_database");
$sql="SELECT preco_base,salario_base FROM produtos,salarios WHERE produtos.ano_atual AND salarios.ano_atual = '".$q."' AND empresa_idEmpresa = 1 AND fk_empresa = 1";
$result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);  
$preco_base = $row["preco_base"];
                            $salario_base = $row["salario_base"];
    
    while ($row = mysqli_fetch_assoc($result)) {
                         $preco_base = $row["preco_base"];
                            $salario_base = $row["salario_base"];
                    }
    
    $soma = $preco_base + $salario_base; 
  
    echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Gastos da empresa em salários/produtos em ".$q."</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    echo "<tr>";
                                        echo "<td>" . $soma . "€</td>";
                                    echo "</tr>";
                                
                                echo "</tbody>";                            
                            echo "</table>";
   
/*echo "<table>
<tr>
<th>Firstname</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $soma . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con); */
?>

</body>
</html> 