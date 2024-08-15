<?php
class Produto {
    private $conn;
    private $tablename = "produtos";

    public $id;
    public $nome;
    public $preco;
    public $imagem;
    public $quantidade;
	public $descricao;
	public $id_usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
		
        $query = "INSERT INTO " . $this->tablename . " SET nome=:nome, preco=:preco, imagem=:imagem, quantidade=:quantidade, descricao=:descricao, id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->imagem = htmlspecialchars(strip_tags($this->imagem));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
		$this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":imagem", $this->imagem);
        $stmt->bindParam(":quantidade", $this->quantidade);
		$stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    } 
	
	public function update() {
		$query = "UPDATE " . $this->tablename . " SET nome=:nome, preco=:preco, imagem=:imagem, quantidade=:quantidade, descricao=:descricao WHERE id=:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		$this->preco = htmlspecialchars(strip_tags($this->preco));
		$this->imagem = htmlspecialchars(strip_tags($this->imagem));
		$this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
		$this->descricao = htmlspecialchars(strip_tags($this->descricao));
		$this->id = htmlspecialchars(strip_tags($this->id));
		
		$stmt->bindParam(":nome", $this->nome);
		$stmt->bindParam(":preco", $this->preco);
		$stmt->bindParam(":imagem", $this->imagem);
		$stmt->bindParam(":quantidade", $this->quantidade);
		$stmt->bindParam(":descricao", $this->descricao);
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