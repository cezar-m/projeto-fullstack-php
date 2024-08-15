<?php
require_once "../auth/auth.php";
verificarAutenticacao();
require_once "../config/Database.php";
require_once "../models/Produto.php";

// Verifica se o ID do produto foi passado na URL
if(!isset($_GET["id"])) {
	$_SESSION["message"] = "ID do produto não fornecido.";
	header("Location: ../views/listagem_produto.php");
	exit;
}

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Cria uma instância do prodduto
$produto = new Produto($db);
$produto->id = htmlspecialchars(strip_tags($_GET["id"]));

// Exclui o Produto
if($produto->delete()) {
	$_SESSION["message"] = "Produto excluído com sucesso.";
} else {
	$_SESSION["message"] = "Erro ao excluir produto.";
}

// Redireciona de volta para a lista de produtos
header("Location: ../views/listagem_produto.php");
exit;
?> 