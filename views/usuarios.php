<html>
<head>
	<title>Cadastrar Usuário</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css" />
	<script src="../validations/validacao.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<h2>Cadastro</h2>
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

		<form action="../routes/usuario.php" method="post" onsubmit="return validarFormCadastro()">
			<div class="form-group row">
				<label forName="nome" class="col-sm-2 col-form-label">Nome</label>
				<div class="col-sm-6">
					<input 
						type="text" 
						class="form-control mb-2"
						name="nome"
						id="nome" 
						placeholder="Nome" 
					>
				</div>
			</div>
			<div class="form-group row">
				<label forName="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-6">
					<input 
						type="email" 
						class="form-control mb-2" 
						name="email"
						id="email" 
						placeholder="Email" 
					>
				</div>
			</div>
			<div class="form-group row">
				<label forName="senha" class="col-sm-2 col-form-label">Senha</label>
				<div class="col-sm-6">
					<input 
						type="password" 
						class="form-control mb-2" 
						name="senha"
						id="senha" 
						placeholder="Senha" 
					>
				</div>
			</div>
			<div class="form-group row">
				<label forName="acesso" class="col-sm-2 col-form-label">Acesso</label>
				<div class="col-sm-6">
					<select class="form-control form-select" name="acesso" id="acesso">
						<option value="">Seleciona o acesso</option>
						<option value="admin">Admin</option>
						<option value="usuario">Usuario</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Cadastrar</button>
			<a href="../login.php" class="link-cad">Voltar ao Login</a>
		</form>
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