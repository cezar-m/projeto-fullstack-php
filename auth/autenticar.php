<?php
session_start();

require_once "../config/Database.php";
require_once "../models/Usuario.php";

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Cria uma instância da classe Usuario
$usuario = new Usuario($db);

// Define os dados do usuário a partir do formulário
$usuario->email = $_POST["email"];
$usuario->senha = $_POST["senha"];

// Tenta fazer o login
if($usuario->login()) {
	// Se o login foi bem-sucedido, inicia a sessão
	$_SESSION["id"] = $usuario->id;
	$_SESSION["nome"] = $usuario->nome;
	$_SESSION["acesso"] = $usuario->acesso;
	
	// Redireciona para a página inicial do painel do usuário
	header("Location: ../views/index.php");
	exit;
} else {
	// Login falhou, exibe uma mensagem de error
	$_SESSION["error"] = "Email ou senha incorretos";
	
	// Redireciona de volda para a página de login
	header("Location: ../login.php");
	exit;
}
?>