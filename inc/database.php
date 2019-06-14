<?php
	//aviso sobre erros graves
	mysqli_report(MYSQLI_REPORT_STRICT);
	//abre a conexão com a base de dados
	function open_database() {
	try {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	return $conn;
	} catch (Exception $e) {
	echo $e->getMessage();
	return null;
		}
	}
	//fecha a conexão com a base de dados
	function close_database($conn) {
	try {
	mysqli_close($conn);
	} catch (Exception $e) {
	echo $e->getMessage();
		}
	}


/**
* Pesquisa um Registo pelo ID em uma Tabela
*/
function find( $table = null, $id = null ) {
$database = open_database();
$found = null;
try {
if ($id) {
$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
$result = $database->query($sql);
if ($result->num_rows > 0) {
$found = $result->fetch_assoc();
}
} else {
$sql = "SELECT * FROM " . $table;
$result = $database->query($sql);
if ($result->num_rows > 0) {
$found = $result->fetch_all(MYSQLI_ASSOC);
}
}
} catch (Exception $e) {
$_SESSION['message'] = $e->GetMessage();
$_SESSION['type'] = 'danger';
}
close_database($database);
return $found;
}

/**
* Pesquisa todos os Registos de uma Tabela
*/
function find_all( $table ) {
return find($table);
}

/**
* Insere um registo no BD
*/
function save($table = null, $data = null) {
$database = open_database();
$columns = null;
$values = null;
foreach ($data as $key => $value) {
$columns .= trim($key, "'") . ",";
$values .= "'$value',";
}
// remove a ultima virgula
$columns = rtrim($columns, ',');
$values = rtrim($values, ',');
$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
try {
$database->query($sql);
$_SESSION['message'] = 'Registo inserido com sucesso.';
$_SESSION['type'] = 'success';

} catch (Exception $e) {
$_SESSION['message'] = 'Nao foi possível realizar a operacao.';
$_SESSION['type'] = 'danger';
}
close_database($database);
}

/**
* Atualiza um registo numa tabela, por ID
*/
function update($table = null, $id = 0, $data = null) {
$database = open_database();
$items = null;
foreach ($data as $key => $value) {
$items .= trim($key, "'") . "='$value',";
}
// remove a ultima virgula
$items = rtrim($items, ',');
$sql = "UPDATE " . $table;
$sql .= " SET $items";
$sql .= " WHERE id=" . $id . ";";
try {
$database->query($sql);
$_SESSION['message'] = 'Registo atualizado com sucesso.';
$_SESSION['type'] = 'success';
} catch (Exception $e) {
$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
$_SESSION['type'] = 'danger';
}
close_database($database);
}

/**
* Remove uma linha de uma tabela pelo ID do registo
*/
function remove( $table = null, $id = null ) {
$database = open_database();
try {
if ($id) {
$sql = "DELETE FROM " . $table . " WHERE id = " . $id;
$result = $database->query($sql);
if ($result = $database->query($sql)) {
$_SESSION['message'] = "Registo eliminado com Sucesso.";
$_SESSION['type'] = 'success';
}
}
} catch (Exception $e) {
$_SESSION['message'] = $e->GetMessage();
$_SESSION['type'] = 'danger';
}
close_database($database);
}

?>