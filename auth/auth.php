<?php
session_start();

function verificarAutenticacao() {
	if(!isset($_SESSION["id"])) {
		// Usuário não está autenticado, redireciona para a página de login
		header("Location: ../login.php");
	}
}