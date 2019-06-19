<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pap_database";

	// Criar a conexão á base de dados
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8"); //para carregar correctamente os caracteres especiais (ex: éã)
	// Verificar a conexão
	if (!$conn)
		{
    	die("Connection failed: " . mysqli_connect_error());
		};
?>