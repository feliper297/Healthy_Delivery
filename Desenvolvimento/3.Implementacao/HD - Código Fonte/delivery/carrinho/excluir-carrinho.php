<?php 

require_once("../conexao.php");



$id = $_POST['id'];




$pdo->prepare("DELETE * FROM carrinho where id = '$id'");

$res->bindValue(":id", $id);

$res->execute();
	

echo "Excluido com Sucesso!!";




?>