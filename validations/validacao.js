function exibirMensagemErro(mensagem) {
	var errorMensagem = document.getElementById("error-mensagem-campos");
	errorMensagem.textContent = mensagem;
	errorMensagem.style.display = "block";
	
	
	// Ocultar a mensagem após 1 segundo
	setTimeout(function(){
		errorMensagem.style.display = "none";
		
	}, 1000); // 1000 milissegundos = 1 segundo 
}

function campoVazio(campo) {
	return campo.trim() === "";
}

function validarEmail(email) {
	var regex =  /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	return regex.test(email);
}

function validarSenha(senha) {
	return senha.length >= 4;
}

function validarFormLogin() {
	var email = document.getElementById("email").value;
	var senha = document.getElementById("senha").value;
	
	if(campoVazio(email)) {
		exibirMensagemErro("Digite o campo email e obrigatório.");
		return false;
	}
	
	if(campoVazio(senha)) {
		exibirMensagemErro("Digite o campo senha e obrigatório.");
		return false;
	}
	
	if(!validarEmail(email)) {
		exibirMensagemErro("Por favor, insira um email válido.");
		return false;
	}
	
	if(!validarSenha(senha)) {
		exibirMensagemErro("A senha deve ter pelo menos 4 caracteres.");
		return false;
	}
	
	return true;
}

function validarFormCadastro() {
	var nome = document.getElementById("nome").value;
	var email = document.getElementById("email").value;
	var senha = document.getElementById("senha").value;
	var acesso = document.getElementById("acesso").value;
	
	if(campoVazio(nome)) {
		exibirMensagemErro("Digite o campo nome e obrigatório.");
		return false;
	}
	
	if(campoVazio(email)) {
		exibirMensagemErro("Digite o campo email e obrigatório.");
		return false;
	}
	
	if(campoVazio(senha)) {
		exibirMensagemErro("Digite o campo senha e obrigatório.");
		return false;
	}
	
	if(!validarEmail(email)) {
		exibirMensagemErro("Por favor, insira um email válido.");
		return false;
	}
	
	if(!validarSenha(senha)) {
		exibirMensagemErro("A senha deve ter pelo menos 4 caracteres.");
		return false;
	}
	
	if(campoVazio(acesso)) {
		exibirMensagemErro("Digite o campo acesso e obrigatório.");
		return false;
	}
	
	return true;
}

function validarFormProduto() {
	var nome = document.getElementById("nome").value;
	var preco = document.getElementById("preco").value;
	var imagem = document.getElementById("imagem").value;
	var quantidade = document.getElementById("quantidade").value;
	var descricao = document.getElementById("descricao").value;
	
	if(campoVazio(nome)) {
		exibirMensagemErro("Digite o campo nome e obrigatório.");
		return false;
	}
	
	if(campoVazio(preco)) {
		exibirMensagemErro("Digite o campo preço e obrigatório.");
		return false;
	}
	
	if(campoVazio(imagem)) {
		exibirMensagemErro("Digite o campo imagem e obrigatório.");
		return false;
	}
	
	if(campoVazio(quantidade)) {
		exibirMensagemErro("Digite o campo quantidade e obrigatório.");
		return false;
	}
	
	if(campoVazio(descricao)) {
		exibirMensagemErro("Digite o campo descrição e obrigatório.");
		return false;
	}
	
	return true;
}

function validarFormProdutoAtualizacao() {
	var nome = document.getElementById("nome").value;
	var preco = document.getElementById("preco").value;
	var quantidade = document.getElementById("quantidade").value;
	var descricao = document.getElementById("descricao").value;
	
	if(campoVazio(nome)) {
		exibirMensagemErro("Digite o campo nome e obrigatório.");
		return false;
	}
	
	if(campoVazio(preco)) {
		exibirMensagemErro("Digite o campo preço e obrigatório.");
		return false;
	}
	
	if(campoVazio(quantidade)) {
		exibirMensagemErro("Digite o campo quantidade e obrigatório.");
		return false;
	}
	
	if(campoVazio(descricao)) {
		exibirMensagemErro("Digite o campo descrição e obrigatório.");
		return false;
	}
	
	return true;
}



function validarFormNovidade() {
	var titulo = document.getElementById("titulo").value;
	var descricao = document.getElementById("descricao").value;
	var data_criacao = document.getElementById("data_criacao").value;
	
	if(campoVazio(titulo)) {
		exibirMensagemErro("Digite o campo titulo e obrigatório.");
		return false;
	}
	
	if(campoVazio(descricao)) {
		exibirMensagemErro("Digite o campo descrição e obrigatório.");
		return false;
	}
	
	if(campoVazio(data_criacao)) {
		exibirMensagemErro("Digite o campo data de criação e obrigatório.");
		return false;
	}
	
	return true;
}