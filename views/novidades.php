<?php
require_once "../auth/auth.php";	
verificarAutenticacao();

if(!isset($_SESSION["id"])) {
	echo "Usuário não está logado";
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
		<h2 class="text-center formatacao">Cadastrar Novidades</h2>
	
		<!-- Adiciona um elemento para exibir mensagens de erro do JavaScript -->
		<p id="error-mensagem-campos" class="error" style="display:none;"></p>
		<?php
			if (isset($_SESSION['message'])) {
			$messageClass = strpos($_SESSION['message'], 'Erro') !== false ? 'error' : 'message';
			echo "<p id='message' class='$messageClass'>" . htmlspecialchars($_SESSION['message']) . "</p>";
			// Limpa a mensagem após exibição
			unset($_SESSION['message']);
		}
		?>

		<div class="container">
			<form action="../routes/novidade.php" method="post" onsubmit="return validarFormNovidade()" enctype="multipart/form-data">
				<div class="form-group row">
					<label htmlFor="titulo" class="col-sm-2 col-form-label">Titulo</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							name="titulo"
							id="titulo" 
							placeholder="Titulo" 
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="descricao" class="col-sm-2 col-form-label">Descrição</label>
					<div class="col-sm-6">
						<input 
							type="text" 
							class="form-control mb-2" 
							name="descricao"
							id="descricao" 
							placeholder="Descrição" 
						>
					</div>
				</div>
				<div class="form-group row">
					<label htmlFor="data_criacao" class="col-sm-2 col-form-label">Data de Criação</label>
					<div class="col-sm-6">
						<input 
							type="date" 
							class="form-control mb-2" 
							name="data_criacao"
							id="data_criacao" 
							placeholder="data_criacao" 
						>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<input 
							type="hidden" 
							class="form-control mb-2" 
							name="id_usuario"
							id="id_usuario" 
							value="<?php echo htmlspecialchars($_SESSION["id"]); ?>"
						>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Cadastrar</button>
			</form>
		<div>
	</div>
	
	<script>
		// Remove a mensagem após 1 minuto
		setTimeout(function() {
			var message = document.getElementById("message");
			if(message) {
				message.style.display = "none";
			}
		}, 1000); // 1000 milissegundos 1 minuto
		// Pré visualização da imagem
		 function previewImagem(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
	</script>
	
</body>
</html>