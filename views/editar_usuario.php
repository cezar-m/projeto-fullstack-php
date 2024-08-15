<?php
require_once "../config/Database.php";
require_once "../controllers/UsuarioController.php";
require_once "../auth/auth.php";	
verificarAutenticacao();

$id = $_GET["id"];

$database = new Database();
$db = $database->getConnection();

$usuarioController = new UsuarioController();
$stmt = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$acesso = $_POST["acesso"];
	
	$usuarioController->update($id, $nome, $email, $senha, $acesso);
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

			<h2 class="formatacao">Editar Usuário</h2>
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
			<form method="post" onsubmit="return validarFormCadastro()">
				<div class="form-group row">
					<label forNome="nome" class="col-sm-2 col-form-label">Nome</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							id="nome" 
							name="nome"
							value="<?php echo htmlspecialchars($usuario["nome"])?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label forNome="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-6">
						<input 
							type="email" 
							class="form-control mb-2" 
							id="email" 
							name="email"
							value="<?php echo htmlspecialchars($usuario["email"])?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label forNome="senha" class="col-sm-2 col-form-label">Senha</label>
					<div class="col-sm-6">
						<input 
							type="password" 
							class="form-control mb-2" 
							id="senha" 
							name="senha"
							value="<?php echo htmlspecialchars($usuario["senha"])?>"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label forNome="acesso" class="col-sm-2 col-form-label">Acesso</label>
					<div class="col-sm-6">
						<input 
							type="acesso" 
							class="form-control mb-2" 
							id="acesso" 
							name="acesso"
							value="<?php echo htmlspecialchars($usuario["acesso"])?>"
						/>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Atualizar Usuário</button>
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