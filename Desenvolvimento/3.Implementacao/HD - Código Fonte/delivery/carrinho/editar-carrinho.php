<?php 

require_once("../conexao.php");



$id = $_POST['id'];
$quantidade = $_POST['quantidade'];

$pdo->prepare("UPDATE carrinho SET quantidade = '$quantidade' where id = '$id'");

$res->bindValue(":id", $id);

$res->execute();

echo "Editado com Sucesso!!";




?>