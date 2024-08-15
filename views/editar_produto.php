<?php
require_once "../auth/auth.php";
verificarAutenticacao();
require_once "../config/Database.php";
require_once "../models/Produto.php";

// Verifica se o ID do produto foi passado na urldecode
if(!isset($_GET["id"])) {
	echo "Produto não encontrado!";
	exit;
}

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Cria uma instância do produto
$produto = new Produto($db);
$produto->id = htmlspecialchars(strip_tags($_GET["id"]));

// Carrega os detalhes do Produto
$stmt = $db->prepare("SELECT * FROM produtos WHERE id =:id");
$stmt->bindParam(":id", $produto->id);
$stmt->execute();

if($stmt->rowCount() == 0) {
	echo "Produto não encontrado!";
	exit;
}

$produtoData = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o formulário foi enviado, processa a atualização
if($_SERVER["REQUEST_METHOD"] === "POST") {
	$produto->nome = $_POST[nome];
	$produto->preco = $_POST[preco];
	$produto->quantidade = $_POST[quantidade];
	$produto->descricao = $_POST[descricao];
	
	// Verifica se uma nova imagem foi enviada
	if(!empty($_FILES["imagem"]["name"])) {
		$produto->imagem = $_FILES["imagem"]["name"];
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($produto->imagem);
		move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
	} else {
		// Mantém a imagem antiga se não foi enviada uma nova
		$produto->imagem = $produtoData["imagem"];
	}
	
	if($produto->update()) {
		$_SESSION["message"] = "Produto atualizado com sucesso.";
	} else {
		$_SESSION["message"] = "Erro ao atualizar produto.";
	}
	header("Location: listagem_produto.php");
	exit;
}
include("header.php");

?>

<style>
		html, body {
			height: 100%;
			margin: 0;
			display: flex;
			flex-direction: column;
		}

		.header {
			margin-left: 15%; /* Cria espaço para a sidebar */
			padding: 20px;
			background-color: #e9e9e9;
			flex: 1;
			margin-top: 60px; /* Cria espaço para a navbar */
		}
		.formatacao { 
			margin-bottom: 3%; 
			margin-top: 3%;
			text-align: center;
		}
	</style>
	<div class="header">
		<?php include("navbar.php"); ?>
		<h2 class="text-center formatacao">Editar Produto</h2>
		
		<?php
			if(isset($_SESSION["message"])) {
				$messageClass = strpos($_SESSION["message"], "Error") !== false ? "error" : "message";
				echo "<p id='message' class='$messageClass'>" . htmlspecialchars($_SESSION["message"]) . "</p>";
				unset($_SESSION["message"]);
			}
		?>
		<p id="error-mensagem-campos" class="error" style="display:none;"></p>
		<div class="container">

			<form action="editar_produto.php?id=<?php echo $produto->id; ?>" method="post" onsubmit="return validarFormProdutoAtualizacao()" enctype="multipart/form-data">
				<div class="form-group row">
					<label htmlFor="nome" class="col-sm-2 col-form-label">Nome</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="nome" 
							name="nome"
							value="<?php echo htmlspecialchars($produtoData["nome"]); ?>"
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="preco" class="col-sm-2 col-form-label">Preço</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="preco" 
							name="preco"
							value="<?php echo htmlspecialchars($produtoData["preco"]); ?>"
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="quantidade" class="col-sm-2 col-form-label">Quantidade</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="quantidade" 
							name="quantidade"
							value="<?php echo htmlspecialchars($produtoData["quantidade"]); ?>"
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="descricao" class="col-sm-2 col-form-label">Descrição</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="descricao" 
							name="descricao"
							value="<?php echo htmlspecialchars($produtoData["descricao"]); ?>"
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="imagem" class="col-sm-2 col-form-label">Imagem</label>
					<div class="col-sm-6">
						<input 
							type="file" 
							class="form-control mb-2" 
							id="imagem" 
							name="imagem"
						>
						<?php if($produtoData["imagem"]) : ?>
							<img id="previewImagem" src="../uploads/<?php echo htmlspecialchars($produtoData["imagem"])?>" alt="<?php echo htmlspecialchars($produtoData["nome"])?>" style="width:200px; height:auto; margin-top: 10px;">
						<?php else: ?>
							<img id="previewImagem" src="#" alt="Pré visualização da Imagem" style="width:200px; height:auto; margin-top: 10px; display: none;">
						<?php endif; ?>
						<p>
					</div>
				</div>	
				<button class="btn btn-primary" type="submit">Atualizar Produtos</button>
			</form>
		</div>
	</div>
	
	<script>
		// Remove a mensagem após 1 minuto
		setTimeout(function() {
			var message = document.getElementById("message");
			if(message) {
				message.style.display = "none";
			}
		}, 1000); // 1000 milissegundos 1 minuto
	
		document.getElementById("imagem").addEventListener("change", function(event) {
			var reader = new FileReader();
			reader.onload = function() {
				var img = document.getElementById("previewImagem");
				img.src = reader.result;
				img.style.display = "block";
			}
			reader.readAsDataURL(event.target.files[0]);
		});
	</script>
	
</body>
</html>