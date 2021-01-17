<?php 

require_once("../../conexao.php");



$nome = $_POST['nome'];



if($nome == ''){
	echo "Preencha o Valor!";
	exit();
}




	//verificar duplicidadade de dados
	$res = $pdo->prepare("SELECT * from locais where nome = '$nome'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);
	if($linhas > 0){
		echo 'Registro já Cadastrado';
		exit();
	}


	$res = $pdo->prepare("INSERT into locais (nome) values (:nome)");

	
	$res->bindValue(":nome", $nome);

	
	$res->execute();

	

	echo "Cadastrado com Sucesso!!";



?>