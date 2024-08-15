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
		<h2 class="formatacao">Produtos Diponíveis</h2>
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
						<th scope="col">Nome</th>
						<th scope="col">Preço</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Descrição</th>
						<th scope="col">Imagem</th>
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
			
						// Prepara a consulta SQL para buscar produtos do usuário logado
						$query = "SELECT * FROM produtos WHERE id_usuario =:id_usuario";
						$stmt = $db->prepare($query);
						$stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
						$stmt->execute();
						$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
						foreach($produtos as $produto):
					?>
					<tr>
						<td width="15%"><?php echo htmlspecialchars($produto["nome"]); ?></td>
						<td width="15%"><?php echo htmlspecialchars($produto["preco"]); ?></td>
						<td width="15%"><?php echo htmlspecialchars($produto["quantidade"]); ?></td>
						<td width="15%"><?php echo htmlspecialchars($produto["descricao"]); ?></td>
						<td width="15%"><?php if($produto['imagem']){
												echo '<img src="../uploads/' . htmlspecialchars($produto["imagem"]) . '" alt="' . htmlspecialchars($produto["nome"]) . '" style="width:100px; height:auto">';
												}
										?>
						</td>
						<td width="6%">
							<a href="editar_produto.php?id=<?php echo $produto['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
						</td>
						<td width="6%">
							<a href="../routes/deletar_produto.php?id=<?php echo $produto['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<button class="btn btn-primary"><a href="produtos.php" class="botao_link">Cadastrar</a></button>
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
