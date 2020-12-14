<?php 

require_once("../../conexao.php");

$id = $_POST['id'];

//VERIFICAR SE EXISTE PRODUTO ASSOCIADO A ESTA CATEGORIA
$res_excluir = $pdo->query("SELECT * from produtos where categoria = '$id'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$linha_excluir = count($dados_excluir);

if($linha_excluir > 0){
	echo "Não é possível excluir a categoria, pois existem produtos relacionados a ela!";
	exit();
}


$pdo->query("DELETE from categorias where id = '$id' ");

echo "Excluído com Sucesso!!";

?>