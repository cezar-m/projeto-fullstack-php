<?php
require_once "../controllers/NovidadeController.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$data_criacao = $_POST["data_criacao"];
	$id_usuario = $_POST["id_usuario"];
	
	$novidadeController = new NovidadeController();
	$novidadeController->create($titulo, $descricao, $data_criacao, $id_usuario);
}

?>