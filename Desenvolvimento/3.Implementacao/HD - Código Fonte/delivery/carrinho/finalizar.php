<?php 

require_once("../conexao.php");



$tipo = $_POST['tipo'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$total = $_POST['total'];
$total_pago = 0;
$troco = 0;


if($tipo == ''){
	echo 'Preencha o Tipo de Pagamento';
	exit();
}


if($tipo == 'Dinheiro'){
	$total_pago = @$_POST['troco'];
	$troco = $total_pago - $total;

	if($troco < 0){
		echo "O valor a pagar não pode ser menor que o valor total da compra!!";
		exit();
	}
}


if($tipo == 'Mercado Pago'){
	$status = 'Aguardando';
}else{
	$status = 'Concluído';
}

$cpf_cliente = @$_SESSION['cpf_usuario'];




if($cpf_cliente != ''){


$res = $pdo->prepare("INSERT into vendas (cliente, total, total_pago, troco, tipo_pgto, data, hora, status, pago) values (:cliente, :total, :total_pago, :troco, :tipo_pgto, curDate(), curTime(), :status, :pago)");

$res->bindValue(":cliente", $cpf_cliente);
$res->bindValue(":total", $total);
$res->bindValue(":total_pago", $total_pago);
$res->bindValue(":troco", $troco);
$res->bindValue(":tipo_pgto", $tipo);
$res->bindValue(":status", $status);
$res->bindValue(":pago", 'Não');

$res->execute();
	
}	

?>