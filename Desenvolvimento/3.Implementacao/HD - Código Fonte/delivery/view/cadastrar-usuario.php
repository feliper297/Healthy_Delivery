<?php 

include_once("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];


//CONSULTA PARA TRAZER O CPF E EMAIL CASO JÁ EXISTA NO BANCO
$res = $pdo->prepare("SELECT * from usuarios where usuario = '$email' or cpf = '$cpf'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);
if($linhas > 0){
    $email_recup = $dados[0]['usuario'];
    $cpf_recup = $dados[0]['cpf'];
}


if($email == @$email_recup){
    echo 'Email já Cadastrado!';
    exit();
}

if($cpf == @$cpf_recup){
    echo 'CPF já Cadastrado!';
    exit();
}


$res = $pdo->prepare("INSERT into usuarios (nome, cpf, telefone, usuario, senha, nivel) values (:nome, :cpf, :telefone, :usuario, :senha, :nivel)");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":usuario", $email);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":senha", $senha);
    $res->bindValue(":nivel", 'Cliente');
    $res->bindValue(":telefone", $telefone);

    $res->execute();

    echo 'Cadastrado com Sucesso!!';


    $res = $pdo->prepare("INSERT into clientes (nome, cpf, telefone, email) values (:nome, :cpf, :telefone, :usuario)");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":usuario", $email);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":telefone", $telefone);

    $res->execute();



 ?>