<?php
require_once "../auth/auth.php";
verificarAutenticacao();
require_once "../config/Database.php";
require_once "../models/Novidade.php";

// Verifica se o ID do novidade foi passado na URL
if(!isset($_GET["id"])) {
	$_SESSION["message"] = "ID da novidade não fornecido.";
	header("Location: ../views/listagem_novidade.php");
	exit;
}

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Cria uma instância do novidade
$novidade = new Novidade($db);
$novidade->id = htmlspecialchars(strip_tags($_GET["id"]));

// Exclui o Novidade
if($novidade->delete()) {
	$_SESSION["message"] = "Novidade excluído com sucesso.";
} else {
	$_SESSION["message"] = "Erro ao excluir a novidade.";
}

// Redireciona de volta para a lista de novidade
header("Location: ../views/listagem_novidade.php");
exit;
?> 