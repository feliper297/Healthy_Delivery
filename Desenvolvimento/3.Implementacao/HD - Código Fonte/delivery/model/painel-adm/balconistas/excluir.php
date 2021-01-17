<?php 

require_once("../../conexao.php");

$id = $_POST['id'];



$pdo->prepare("DELETE from usuarios where id = '$id' ");

$res->bindValue(":id", $id);

$res->execute();


echo "Excluído com Sucesso!!";


?>