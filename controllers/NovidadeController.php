<?php
require_once "../config/Database.php";
require_once "../models/Novidade.php";

class NovidadeController {
	private $db;
	private $novidade;
	
	public function __construct() {
		$database = new Database();
		$this->db = $database->getConnection();
		$this->novidade = new Novidade($this->db);
	}
	
	public function create($titulo, $descricao, $data_criacao, $id_usuario) {
		session_start();
		$this->novidade->titulo = $titulo;
		$this->novidade->descricao = $descricao;
		$this->novidade->data_criacao = $data_criacao;
		$this->novidade->id_usuario = $id_usuario;
		
		if($this->novidade->create()) {
			$_SESSION["message"] = "Novidade criado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao criar a novidade";
		}
		header("Location: ../views/listagem_novidade.php");
	}
	
	public function update($id, $titulo, $descricao, $data_criacao) {
		session_start();
		$this->novidade->id = $id;
		$this->novidade->titulo = $titulo;
		$this->novidade->descricao = $descricao;
		$this->novidade->data_criacao = $data_criacao;
		
		if($this->novidade->update()) {
			$_SESSION["message"] = "Novidade atualizado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao atualizar a novidade";
		}
		header("Location: ../views/editar_novidade.php?id=" . $id);
	}
		
	public function delete($id) {
		session_start();
		$this->novidade->id = $id;
		
		if($this->novidade->delete()) {
			$_SESSION["message"] = "Novidade excluido com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao excluir a novidade.";
		}
		header("Location: ../views/listagem_novidade.php");
	}
}
?>