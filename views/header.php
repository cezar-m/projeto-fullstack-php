<!DOCTYPE html>
<html>
<head>
	<title>Painel Administrativo - Usuários</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/styles-button.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/styles-errors.css" />

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../validations/validacao.js"></script>
</head>
<body>
	<style>
	 .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 10px 20px;
        }

        .navbar {
            background-color: #fff;
            padding: 10px 20px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000; /* Garante que a navbar esteja acima de outros elementos */
        }
	</style>

	<header>
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="navbar-content">
				<a href="index.php" class="navbar-brand ms-3"><img src="../assets/img/logo.png" width="112" height="28" alt="logo" /></a>	
				<div class="ms-auto">
					<div>
						<button class="Btn">
							<div class="sign">
								<svg viewBox="0 0 512 512">
									<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
								</svg>
							</div>
							<div class="text"><a class="botao_link" href="../auth/logout.php">Deslogar</a></div>
						</button>
					</div>
				</div>
			</div>
		</nav>
	</header>