<?php
require_once "../controllers/UsuarioController.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$acesso = $_POST["acesso"];
	
	$usuarioController = new UsuarioController();
	$usuarioController->create($nome, $email, $senha, $acesso);
}

?>