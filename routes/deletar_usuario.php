<?php

require_once "../controllers/UsuarioController.php";

// Verifica se o ID foi passado pela URL
if(isset($_GET["id"])) {
	$id = $_GET["id"];
	
	// Cria uma instância do controlador de usuário
	$usuarioController = new UsuarioController();
	
	// Chama o método delete para remover o usuário com ID fornecido
	$usuarioController->delete($id);
} else {
	// Se o ID não foi fornecido, redireciona para lista de usuários com uma mensagem de error
	session_start();
	$_SESSION["message"] = "ID de usuário não fornecido.";
	header("Location: ../views/lista_usuario.php");
	exit;
}

?>