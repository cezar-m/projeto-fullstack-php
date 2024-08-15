<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 

}
?>
<style>
  /* Sidebar styling */
	.barra {
		background-color: #fff;
		height: calc(100vh - 60px); /* Ajuste para a altura da navbar */
		width: 15%;
		padding: 20px;
		position: fixed;
		top: 60px; /* Ajusta abaixo da navbar */
		left: 0;
		bottom: 0;
		overflow-y: auto;
		box-shadow: 2px 0 5px rgba(0,0,0,0.1);
	}
</style>
<div class="container">
<aside class="barra">
	<!-- Conteúdo da sidebar -->
	<div class="d-flex flex-column p-3">
		<h5 class="mb-4">Menu</h5>
		<ul class="nav flex-column">
			<li class="nav-item">
				<a href="index.php"  class="nav-link link-dark">
					Dashboard
				</a>
			</li>
			<li class="nav-item">
				<a href="listagem_produto.php" class="nav-link link-dark">
					Produtos
				</a>
			</li>
			<?php if(isset($_SESSION['acesso']) && $_SESSION['acesso'] === 'admin'): ?>
			<li class="nav-item">
				<a href="lista_usuario.php" class="nav-link link-dark">
					Usuarios
				</a>
			</li>
			<?php endif; ?>
			<li class="nav-item">
				<a href="listagem_novidade.php" class="nav-link link-dark">
					Novidades
				</a>
			</li>
		</ul>
	</div>
</aside>
</div>