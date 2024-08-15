<?php
require_once "../controllers/ProdutoController.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$nome = $_POST["nome"];
	$preco = $_POST["preco"];
	$imagem = $_FILES["imagem"]["name"];
	$quantidade = $_POST["quantidade"];
	$descricao = $_POST["descricao"];
	$id_usuario = $_POST["id_usuario"];
	
	// Upload da imagem
	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($imagem);
	move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
	
	$produtoController = new ProdutoController();
	$produtoController->create($nome, $preco, $imagem, $quantidade, $descricao, $id_usuario);
}

?>