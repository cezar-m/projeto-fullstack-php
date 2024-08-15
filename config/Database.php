<?php 
class Database {
	private $host = "localhost";
	private $dbname = "autenticacao_sistema";
	private $username = "root";
	private $password = "";
	public $conn;

	public function getConnection() {
		$this->conn = null;
		
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
			$this->conn->exec("set names utf8");
		} catch(PDOException $exception) {
			echo "Erro na coneção com o banco: " . $exception->getMessage();
		}
		
		return $this->conn;
	}
}
?>