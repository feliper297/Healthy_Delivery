<?php 

require_once("../../conexao.php");
@session_start();

$descricao = $_POST['descricao'];
$nome = $_POST['nome'];

$nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);


//SCRIPT PARA FOTO NO BANCO
$caminho = '../../images/categorias/' .$_FILES['foto']['name'];
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
	$res = $pdo->query("SELECT * from categorias where nome = '$nome'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);
	if($linhas > 0){
		echo 'Registro já Cadastrado';
		exit();
	}


	$res = $pdo->prepare("INSERT into categorias (nome, descricao, imagem, nome_url) values (:nome, :descricao, :imagem, :nome_url)");

	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":imagem", $imagem);
	$res->bindValue(":nome_url", $nome_url);
	
	$res->execute();

	

	echo "Cadastrado com Sucesso!!";



?>