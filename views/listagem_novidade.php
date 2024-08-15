<?php
	require_once "../auth/auth.php";	
	verificarAutenticacao();
	
	if(!isset($_SESSION["id"])) {
		die("Usuário não autenticado.");
	}
	
	$id_usuario = $_SESSION["id"];
	
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
		.botao_link {
			text-decoration: none; 
			color: #fff;
		}

		.botao_link:link {
			text-decoration: none;
			color: #fff;
		}

		.botao_link:visited {
			text-decoration: none;
			color: #fff;
		}

		.botao_link:focus {
			text-decoration: none;
			color: #fff;
		}

		.botao_link:hover {
			text-decoration: none; 
			color: #fff;
		}

		.botao_link:active {
			text-decoration: none;
			color: #fff;	
		}
	</style>
	<div class="header">
		<?php include("navbar.php"); ?>
		<div class="form-position mt-5">
		<h2 class="formatacao">Novidades</h2>
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
		<div class="container d-flex justify-content-center">
			<table class="table table-light mt-4">
				<thead>
					<tr>
						<th scope="col">Titulo</th>
						<th scope="col">Descrição</th>
						<th scope="col">Data de Criação</th>
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
			
						// Prepara a consulta SQL para buscar novidade do usuário logado
						$query = "SELECT * FROM novidades WHERE id_usuario =:id_usuario";
						$stmt = $db->prepare($query);
						$stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
						$stmt->execute();
						$novidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
						foreach($novidades as $novidade):
					?>
					<tr>
						<td width="15%"><?php echo htmlspecialchars($novidade["titulo"]); ?></td>
						<td width="15%"><?php echo htmlspecialchars($novidade["descricao"]); ?></td>
						<td width="15%"><?php echo htmlspecialchars(date('d/m/Y', strtotime($novidade["data_criacao"]))); ?></td>
						<td width="6%">
							<a href="editar_novidade.php?id=<?php echo $novidade['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
						</td>
						<td width="6%">
							<a href="../routes/deletar_novidade.php?id=<?php echo $novidade['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir a novidade?');"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<button class="btn btn-primary"><a href="novidades.php" class="botao_link">Cadastrar</a></button>
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
	
	</ul>
</body>
</html>