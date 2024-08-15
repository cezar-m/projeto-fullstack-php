<?php
require_once "../config/Database.php";
require_once "../models/Usuario.php";

class UsuarioController {
	private $db;
	private $usuario;
	
	public function __construct() {
		$database = new Database();
		$this->db = $database->getConnection();
		$this->usuario = new Usuario($this->db);
	}
	
	public function create($nome, $email, $senha, $acesso) {
		session_start();
		$this->usuario->nome = $nome;
		$this->usuario->email = $email;
		$this->usuario->senha = password_hash($senha, PASSWORD_BCRYPT);
		$this->usuario->acesso = $acesso;
	
		if($this->usuario->create()) {
			$_SESSION["message"] = "Usuário criado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao criar usuário";
		}
		
		header("Location: ../views/usuarios.php");
	}
	
	public function update($id, $nome, $email, $senha, $acesso) {
		session_start();
		$this->usuario->id = $id;
		$this->usuario->nome = $nome;
		$this->usuario->email = $email;
		$this->usuario->acesso = $acesso;
		
		//Atualiza a senha apenas se fornecida
		if(!empty($senha)) {
			$this->usuario->senha = $senha;
		}
		
		if($this->usuario->update()) {
			$_SESSION["message"] = "Usuário atualizado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao atualizar usuário.";
		}
		
		header("Location: ../views/lista_usuario.php");
		exit;
	}
	
	public function delete($id) {
		session_start();
		$this->usuario->id = $id;
		
		if($this->usuario->delete()) {
			$_SESSION["message"] = "Usuário deletado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao deletar usuário.";
		}
		
		header("Location: ../views/lista_usuario.php");
		exit;
	}
}
?>