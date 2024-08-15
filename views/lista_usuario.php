<?php
	require_once "../auth/auth.php";	
	verificarAutenticacao();
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
		.table-light {
			background-color: #f8f9fa;
		}
		.formatacao { 
			margin-bottom: 3%; 
			margin-top: 3%;
			text-align: center;
		}
	</style>
	<div class="header">
		<?php include("navbar.php"); ?>
		<div class="form-position mt-5">
		<h2 class="formatacao">Lista de Usuários</h2>
		<?php
			if (isset($_SESSION['message'])) {
			$messageClass = strpos($_SESSION['message'], 'Erro') !== false ? 'error' : 'message';
			echo "<p id='message' class='$messageClass'>" . htmlspecialchars($_SESSION['message']) . "</p>";
			// Limpa a mensagem após exibição
			unset($_SESSION['message']);
		}
		?>
		<div class="container d-flex justify-content-center">
			<table class="table table-light mt-4">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">E-mail</th>
						<th scope="col">Acesso</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>	
					<?php 
						require_once "../config/Database.php";
			
						// Cria uma instância da classe Database
						$database = new Database();
						$db = $database->getConnection();
			
						// Buscar os produtos no banco de dados
						$stmt = $db->query("SELECT * FROM usuarios");
						$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
						foreach($usuarios as $usuario):
					?>
					<tr>
						<td width="20%"><?php echo htmlspecialchars($usuario["nome"]); ?></td>
						<td width="20%"><?php echo htmlspecialchars($usuario["email"]); ?></td>
						<td width="20%"><?php echo htmlspecialchars($usuario["acesso"]); ?></td>
						<td width="5%">
							<a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
						</td>
						<td width="5%">
							<a href="../routes/deletar_usuario.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuario?');"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
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
