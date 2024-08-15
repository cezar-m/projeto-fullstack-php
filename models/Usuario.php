<?php
class Usuario {
    private $conn;
    private $tablename = "usuarios";

    public $id;
    public $nome;
    public $email;
    public $senha;
    public $acesso;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tablename . " SET nome=:nome, email=:email, senha=:senha, acesso=:acesso";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->acesso = htmlspecialchars(strip_tags($this->acesso));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":acesso", $this->acesso);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
	
	public function update() {
		$query = "UPDATE " . $this->tablename . " SET nome=:nome, email=:email, acesso=:acesso" . (!empty($this->senha) ? ", senha=:senha" : "") . " WHERE id=:id";

		$stmt = $this->conn->prepare($query);
		
		$this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->acesso = htmlspecialchars(strip_tags($this->acesso));
		$this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":acesso", $this->acesso);
		$stmt->bindParam(":id", $this->id);
		 
		// Se a senha foi fornecida, faz o hash e a vincula
		if(!empty($this->senha)) {
			$this->senha = password_hash(htmlspecialchars(strip_tags($this->senha)), PASSWORD_BCRYPT);
			$stmt->bindParam(":senha", $this->senha);
		}
		
		return $stmt->execute();
	}
	
	public function delete() {
		// Inicia a transação
		$this->conn->beginTransaction();
		
		try{
			// Primeiro, exclui os produtos associados ao usuário
			$queryProdutos = "DELETE FROM produtos WHERE id_usuario =:id_usuario";
			$stmtProdutos = $this->conn->prepare($queryProdutos);
			$stmtProdutos->bindParam(":id_usuario", $this->id);
			$stmtProdutos->execute();
			
			// Segundo, exclui as novidade associados ao usuário
			$queryNovidades = "DELETE FROM novidades WHERE id_usuario =:id_usuario";
			$stmtNovidades = $this->conn->prepare($queryNovidades);
			$stmtNovidades->bindParam(":id_usuario", $this->id);
			$stmtNovidades->execute();
			
			// Em seguida, exclui o usuário
			$queryUsuario = "DELETE FROM " . $this->tablename . " WHERE id =:id";
			$stmtUsuario = $this->conn->prepare($queryUsuario);
			$stmtUsuario->bindParam(":id", $this->id);
			$stmtUsuario->execute();
			
			// Confirma a transação
			$this->conn->commit();
			
			return true;
		} catch (Exception $e) {
			// Em caso de erro, reverte a transação
			$this->conn->rollBack();
			return false;
		}
	}
	
	// Método para login
	public function login() {
		$query = "SELECT id, nome, email, senha, acesso FROM " . $this->tablename . " WHERE email = :email LIMIT 0,1";
		
		$stmt = $this->conn->prepare($query);
		
		$this->email = htmlspecialchars(strip_tags($this->email));
		
		$stmt->bindParam(":email", $this->email);
		
		$stmt->execute();
		
		// Se o usuário foi encontrado
		if($stmt->rowCount() > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			// Verifica a senha
			if(password_verify($this->senha, $row["senha"])) {
				// A senha está correta
				$this->id = $row["id"];
				$this->nome = $row["nome"];
				$this->acesso = $row["acesso"];
				return true;
			} else {
				// Senha incorreta
				return false;
			}
		}
		
		// Usuário não encontrado
		return false;
	}
}
?>
