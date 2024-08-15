<?php
session_start();

// Verifica se o usuário está logado
if(isset($_SESSION["nome"])) {
	$nomeUsuario = $_SESSION["nome"];
} else {
	// Se não estiver logado, redireciona para a página de login
	header("Location: ../login.php");
	exit;
}
include("header.php")
?>
<style>
	html, body {
		height: 100%;
		margin: 0;
		display: flex;
		flex-direction: column;
	}

	/* Navbar styling */
	.navbar {
		background-color: #fff;
		padding: 10px 20px;
		width: 100%;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 1000; /* Garante que a navbar esteja acima de outros elementos */
	}
	.pagina_principal {
		margin-left: 15%; /* Cria espaço para a sidebar */
        padding: 20px;
        background-color: #e9e9e9;
        flex: 1;
        margin-top: 60px; /* Cria espaço para a navbar */
	}
	li {
		list-style-type: none;
	}
</style>
<div class="pagina_principal">
	<?php include("navbar.php"); ?>

	<h1>Bem-video(a), <?php echo htmlspecialchars($nomeUsuario); ?>! ao sistema administrativo</h1>
	<a href="../auth/logout.php">Deslogar</a>
</div>
</body>
</html>