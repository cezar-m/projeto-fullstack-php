<?php
require_once "../config/Database.php";
require_once "../models/Produto.php";

class ProdutoController {
	private $db;
	private $produto;
	
	public function __construct() {
		$database = new Database();
		$this->db = $database->getConnection();
		$this->produto = new Produto($this->db);
	}
	
	public function create($nome, $preco, $imagem, $quantidade, $descricao, $id_usuario) {
		session_start();
		$this->produto->nome = $nome;
		$this->produto->preco = $preco;
		$this->produto->imagem = $imagem;
		$this->produto->quantidade = $quantidade;
		$this->produto->descricao = $descricao;
		$this->produto->id_usuario = $id_usuario;
		
		if($this->produto->create()) {
			$_SESSION["message"] = "Produto criado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao criar produto";
		}
		header("Location: ../views/listagem_produto.php");
	}
	
	public function update($id, $nome, $preco, $imagem, $quantidade, $descricao) {
		session_start();
		$this->produto->id = $id;
		$this->produto->nome = $nome;
		$this->produto->preco = $preco;
		$this->produto->imagem = $imagem;
		$this->produto->quantidade = $quantidade;
		$this->produto->descricao = $descricao;
		
		if($this->produto->update()) {
			$_SESSION["message"] = "Produto atualizado com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao atualizar produto";
		}
		header("Location: ../views/editar_produto.php?id=" . $id);
	}
	
	public function delete($id) {
		session_start();
		$this->produto->id = $id;
		
		if($this->produto->delete()) {
			$_SESSION["message"] = "Produto excluido com sucesso.";
		} else {
			$_SESSION["message"] = "Erro ao excluir produto.";
		}
		header("Location: ../views/listagem_produto.php");
	}
}
?>