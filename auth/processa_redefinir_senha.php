<?php
require_once "../config/Database.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {
	// Captura o e-mail e a nova senha do formulário
	$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
	$nova_senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : '';
	
	// Verifica se o e-mail e a senha foram fornecidos
	if(empty($email) || empty($nova_senha)) {
		$_SESSION["error"] = "E-mail e senha são obrigatórios.";
		header("Location: ../redefinir_senha.php?email=" . urldecode($email));
		exit;
	}
	
	// Conecta ao banco de dados
	$database = new Database();
	$db = $database->getConnection();
	
	// Hash da nova senha para armazenamento seguro
	$senha_hashed = password_hash($nova_senha, PASSWORD_DEFAULT);
	
	// Prepara a consulta SQL para atualizar a senha
	$query = "UPDATE usuarios SET senha =:senha WHERE email =:email";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":senha", $senha_hashed);
	$stmt->bindParam(":email", $email);
	
	// Executa a consulta
	if($stmt->execute()) {
		$_SESSION["message"] = "Senha atualizada com sucesso.";
		header("Location: ../login.php");
		exit;
	} else {
		$_SESSION["error"] = "Erro ao atualizar a senha.";
		header("Location: ../redefinir_senha.php?email=" . urldecode($email));
		exit;
	}
} else {
	$_SESSION["error"] = "Método de requisição inválido.";
	header("Location: ../redefinir_senha.php");
	exit;
}
?>