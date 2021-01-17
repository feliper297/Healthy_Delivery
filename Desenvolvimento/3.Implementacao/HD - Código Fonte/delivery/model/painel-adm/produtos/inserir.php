
<?php 

require_once("../../conexao.php");


$descricao = $_POST['descricao'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$descricao_longa = $_POST['descricao_longa'];
$categoria = $_POST['categoria'];


$combo = @$_POST['combo'];
$adicional = @$_POST['adicional'];

$valor = str_replace(',', '.', $valor);

$nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);


//SCRIPT PARA FOTO NO BANCO
$caminho = '../../images/produtos/' .$_FILES['foto']['name'];
    if ($_FILES['foto']['name'] == ""){
      $imagem = "sem-foto.png";
    }else{
      $imagem = $_FILES['foto']['name']; 
    }
    
    $imagem_temp = $_FILES['foto']['tmp_name']; 
    move_uploaded_file($imagem_temp, $caminho);




if($descricao == ''){
	echo "Preencha a Descrição!!";
	exit();
}

if($nome == ''){
	echo "Preencha o Valor!";
	exit();
}




	//verificar duplicidade de dados
	$res = $pdo->prepare("SELECT * from produtos where nome = '$nome'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);
	if($linhas > 0){
		echo 'Registro já Cadastrado';
		exit();
	}


	$res = $pdo->prepare("INSERT into produtos (nome, descricao, descricao_longa, valor, categoria, imagem, nome_url, combo, adicional) values (:nome, :descricao, :descricao_longa, :valor, :categoria, :imagem, :nome_url, :combo, :adicional)");

	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":imagem", $imagem);
	$res->bindValue(":nome_url", $nome_url);
	$res->bindValue(":categoria", $categoria);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":descricao_longa", $descricao_longa);
	$res->bindValue(":combo", $combo);
	$res->bindValue(":adicional", $adicional);
	
	$res->execute();



	//INCREMENTAR VALOR DE 1 NA CATEGORIA ONDE O PRODUTO FOI COLOCADO
	$res = $pdo->prpare("SELECT * from categorias where id = '$categoria'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$produtos = $dados[0]['produtos'];
	$total_produtos = $produtos + 1;

	//ATUALIZAR O NOVO VALOR DO CAMPO PRODUTOS NA CATEGORIA
	$pdo->prepare("UPDATE categorias set produtos = '$total_produtos' where id = '$categoria'");
	

	echo "Cadastrado com Sucesso!!";



?>