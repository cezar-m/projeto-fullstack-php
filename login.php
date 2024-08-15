<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Login</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
	<script src="validations/validacao.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card card-container">
		
	<?php
	  session_start();
	  if(isset($_SESSION["error"])) {
		  echo "<p id='error-message' class='error'>" . htmlspecialchars($_SESSION["error"]) . "</p>";
		  // Limpa a mensagem de erro após exibi-label
		  unset($_SESSION["error"]);
	  }
	   if(isset($_SESSION["message"])) {
		  echo "<p id='success-message' class='message'>" . htmlspecialchars($_SESSION["message"]) . "</p>";
		  // Limpa a mensagem de sucesso após exibi-label
		  unset($_SESSION["message"]);
	  }
	?>
	
	<!-- Adiciona um elemento para exibir mensagens de erro do JavaScript -->
	<p id="error-message" class="error" style="display:none;"></p>
	<p id="error-mensagem-campos" class="error" style="display:none;"></p>
	<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
		<p id="profile-name" class="profile-name-card"></p>
		<form class="form-signin" action="./auth/autenticar.php" method="post" onsubmit="return validarFormLogin()">
			<span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->
			<a href="./views/usuarios.php" class="link-login">Registre-se</Link>
           	<a id="reset-password-link" href="redefinir_senha.php?email=" class="link-login" onclick="this.href+=''+document.getElementById('email').value">
				Redefinir a Senha
			</a>
        </div><!-- /card-container -->
    </div><!-- /container -->
		
	<script>
		// Remove a mensagem de erro após 1 segundo
		setTimeout(function() {
			var errorMessage = document.getElementById("error-message");
			if(errorMessage) {
				errorMessage.style.display = 'none';
			}
		    var successMessage = document.getElementById("success-message");
            if (successMessage) {
                successMessage.style.display = 'none';
            }
		}, 1000); // 1000 milessegundos = 1 segundo
		
		  // Adiciona validação ao link de redefinição de senha
		document.getElementById('reset-password-link').addEventListener('click', function(event) {
			var emailField = document.getElementById('email');
			var email = emailField.value.trim();
        
			if (email === '') {
				event.preventDefault(); // Evita que o link seja seguido
            
				// Exibe a mensagem de erro
				var errorMessage = document.getElementById('error-message');
				errorMessage.textContent = 'Por favor, preencha seu email antes de tentar redefinir a senha.';
				errorMessage.style.display = 'block';
            
				// Remove a mensagem após 1 segundo
				setTimeout(function() {
					errorMessage.style.display = 'none';
				}, 1000); // 1000 milissegundos = 1 segundo
			} else {
				this.href = 'redefinir_senha.php?email=' + encodeURIComponent(email);
			}
		});
	</script>
</body>
</html>