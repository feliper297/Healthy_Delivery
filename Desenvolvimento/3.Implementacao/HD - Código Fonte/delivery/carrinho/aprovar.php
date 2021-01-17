<?php 

require_once("../conexao.php");

$id = $id_venda;
$pdo->prepare("UPDATE vendas set status = 'Concluído', pago = 'Sim' where id = '$id'");

$res->bindValue(":id", $id);

$res->execute();

?>