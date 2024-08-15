<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Redefinir senha</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
	<script src="validations/validacao.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2 class="text-center">Redefinir senha</h2>	
		
		<?php
		  // Capturando o e-mail da query string
		  $email  = isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : '';
		  
		  if(isset($_SESSION["error"])) {
			  echo "<p id='error-message' class='error'>" . htmlspecialchars($_SESSION["error"]) . "</p>";
			  // Limpa a mensagem de erro após exibi-label
			  unset($_SESSION["error"]);
		  }
		?>
		
		<!-- Adiciona um elemento para exibir mensagens de erro do JavaScript -->
		<div class="card card-container">
			<p id="error-mensagem-campos" class="error" style="display:none;"></p>
			
			<form class="form-signin" action="./auth/processa_redefinir_senha.php" method="post" onsubmit="return validarFormLogin()">
				<div class="form-group row">
					<label forNome="email" class="col-sm-2 col-form-label">Email: </label>
					<div class="col-sm-10">
						<input 
							type="text" 
							class="form-control mb-2"
							name="email"
							id="email" 
							value="<?php echo $email; ?>" readonly
						>
					</div>
				</div>
				<div class="form-group row">
					<label forNome="senha" class="col-sm-2 col-form-label">Digite outra senha:</label>
					<div class="col-sm-10">
						<input 
							type="password" 
							class="form-control mb-2"
							name="senha"
							id="senha" 
						>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Entrar</button>
			</form>
		</div>
	</div>
	
	<script>
		// Remove a mensagem de erro após 1 segundo
		setTimeout(function() {
			var errorMessage = document.getElementById("error-message");
			if(errorMessage) {
				errorMessage.style.display = 'none';
			}
		}, 1000); // 1000 milessegundos = 1 segundo
	</script>
</body>
</html>