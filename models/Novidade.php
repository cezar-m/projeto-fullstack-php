<?php
class Novidade {
    private $conn;
    private $tablename = "novidades";

    public $id;
    public $titulo;
	public $descricao;
	public $data_criacao;
	public $id_usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
		
        $query = "INSERT INTO " . $this->tablename . " SET titulo=:titulo, descricao=:descricao, data_criacao=:data_criacao, id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->data_criacao = htmlspecialchars(strip_tags($this->data_criacao));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":data_criacao", $this->data_criacao);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    } 
	
	public function update() {
		$query = "UPDATE " . $this->tablename . " SET titulo=:titulo, descricao=:descricao, data_criacao=:data_criacao WHERE id=:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		$this->descricao = htmlspecialchars(strip_tags($this->descricao));
		$this->data_criacao = htmlspecialchars(strip_tags($this->data_criacao));
		$this->id = htmlspecialchars(strip_tags($this->id));
		
		$stmt->bindParam(":titulo", $this->titulo);
		$stmt->bindParam(":descricao", $this->descricao);
		$stmt->bindParam(":data_criacao", $this->data_criacao);
		$stmt->bindParam(":id", $this->id);
		
		return $stmt->execute();
	}
	
	public function delete() {
		$query = "DELETE FROM " . $this->tablename . " WHERE id=:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->id = htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(":id", $this->id);
		
		return $stmt->execute();
	}
}
?>