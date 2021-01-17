<?php 

require_once("../../conexao.php");

$id = $_POST['id'];

$res = $pdo->prepare("SELECT * from produtos where id = '$id'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$categoria = $dados[0]['categoria'];


$pdo->prepare("DELETE from produtos where id = '$id' ");

echo "Excluído com Sucesso!!";


//INCREMENTAR VALOR DE 1 NA CATEGORIA ONDE O PRODUTO FOI COLOCADO
	$res = $pdo->prepare("SELECT * from categorias where id = '$categoria'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$produtos = $dados[0]['produtos'];
	$total_produtos = $produtos - 1;

	//ATUALIZAR O NOVO VALOR DO CAMPO PRODUTOS NA CATEGORIA
	$pdo->prepare("UPDATE categorias set produtos = '$total_produtos' where id = '$categoria'");


	$res->bindValue(":id", $id);
	$res->bindValue(":categoria", $categoria);
	$res->bindValue(":total_produtos", $total_produtos);
	

$res->execute();



?>