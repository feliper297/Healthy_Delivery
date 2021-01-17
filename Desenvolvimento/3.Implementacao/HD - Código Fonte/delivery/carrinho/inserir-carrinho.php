<?php 

require_once("../conexao.php");

@session_start();

$id_produto = $_POST['idproduto'];
$cpf_cliente = @$_SESSION['cpf_usuario'];


//VERIRICAR SE O PRODUTO JÁ EXISTE NO CARRINHO
$res_p = $pdo->prepare("SELECT * from carrinho where id_produto = '$id_produto' ");
$dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
$linhas_p = count($dados_p);
if($linhas_p > 0){
	$quant_p = $dados_p[0]['quantidade'];
	$quant_p = $quant_p + 1;

	$res = $pdo->prepare("UPDATE carrinho set quantidade = '$quant_p' where id_produto = '$id_produto'");
	echo "Cadastrado com Sucesso!!";
	exit();


}


if($cpf_cliente != ''){


$quantidade = 1;

$res = $pdo->prepare("INSERT into carrinho (id_venda, id_produto, cpf, quantidade) values ('0', '$id_produto', '$cpf_cliente', '$quantidade')");

	
}	

$res->bindValue(":id_venda", $id_venda);
$res->bindValue(":id_produto", $id_produto);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":quantidade", $quantidade);



$res->execute();


echo "Cadastrado com Sucesso!!";




?>