<?php
// Definir o campos da base de dados
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pap_database');

// Tentativa de conexão á base de dados
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar a conexão
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>