<?php
require_once "../auth/auth.php";
verificarAutenticacao();
require_once "../config/Database.php";
require_once "../models/Novidade.php";

// Verifica se o ID da novidade foi passado na urldecode
if(!isset($_GET["id"])) {
	echo "Novidade não encontrado!";
	exit;
}

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Cria uma instância da novidade
$novidade = new Novidade($db);
$novidade->id = htmlspecialchars(strip_tags($_GET["id"]));

// Carrega os detalhes do Novidade
$stmt = $db->prepare("SELECT * FROM novidades WHERE id =:id");
$stmt->bindParam(":id", $novidade->id);
$stmt->execute();

if($stmt->rowCount() == 0) {
	echo "Novidade não encontrada!";
	exit;
}

// Atribui os resultados ao objeto $novidade
$novidadeDados = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o formulário foi enviado, processa a atualização
if($_SERVER["REQUEST_METHOD"] === "POST") {
	$novidade->titulo = $_POST["titulo"];
	$novidade->descricao = $_POST["descricao"];
	$novidade->data_criacao = $_POST["data_criacao"];
	
	// Converte a data de d/m/Y para Y-m-d
	$data_criacao = DateTime::createFromFormat('d/m/Y', $novidade->data_criacao);
	if($data_criacao) {
		$novidade->data_criacao = $data_criacao->format('y-m-d');	
	} else {
		// Se a coversão falhar, define uma mensagem de erro ou uma data padrão
		$_SESSION["message"] = "Erro ao processar a data. Formato inválido.";
		header("Location: editar_novidade?id=" . $novidade->id);
		exit;
	}
	
	if($novidade->update()) {
		$_SESSION["message"] = "Novidade atualizado com sucesso.";
	} else {
		$_SESSION["message"] = "Erro ao atualizar novidade.";
	}
	header("Location: listagem_novidade.php");
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
		<div class="form-position">

			<h2 class="formatacao">Editar Novidade</h2>
			<!-- Adiciona um elemento para exibir mensagens de erro do JavaScript -->
			<?php
				if (isset($_SESSION['message'])) {
				$messageClass = strpos($_SESSION['message'], 'Erro') !== false ? 'error' : 'message';
				echo "<p id='message' class='$messageClass'>" . htmlspecialchars($_SESSION['message']) . "</p>";
				// Limpa a mensagem após exibição
				unset($_SESSION['message']);
			}
			?>
			<p id="error-mensagem-campos" class="error" style="display:none;"></p>
			<div class="container">
				<form action="editar_novidade.php?id=<?php echo $novidade->id; ?>" method="post" onsubmit="return validarFormNovidade()"  enctype="multipart/form-data">
				<div class="form-group row">
					<label forName="titulo" class="col-sm-2 col-form-label">Titulo</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="titulo" 
							name="titulo"
							value="<?php echo htmlspecialchars($novidadeDados["titulo"])?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label forName="descricao" class="col-sm-2 col-form-label">Descrição</label>
					<div class="col-sm-6">
						<input 
							type="descricao" 
							class="form-control mb-2" 
							id="descricao" 
							name="descricao"
							value="<?php echo htmlspecialchars($novidadeDados["descricao"])?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label forName="data_criacao" class="col-sm-2 col-form-label">Data de Criação</label>
					<div class="col-sm-6">
						<input 
							type="data_criacao" 
							class="form-control mb-2" 
							id="data_criacao" 
							name="data_criacao"
							value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($novidadeDados["data_criacao"])))?>"
						/>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Atualizar Novidade</button>
			</form>
			</div>
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
	</script>
	
</body>
</html>