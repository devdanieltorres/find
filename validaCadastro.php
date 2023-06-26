<?php
session_start();
require_once 'conexao.php';
   
if ($conn->connect_errno)
{
    echo "Ocorreu um erro na conexao com o banco de dados.";
    exit;
}
        
mysqli_set_charset($conn, 'utf8');

$nome = "";
$email = "";
$senha = "";

//Validando a existência dos dados
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"])){
    if(empty($_POST["nome"])){
        $erro = "Digite o seu nome!";
    }else{
    if(empty($_POST["email"])){
        $erro = "Preencha o campo com seu e-mail!";                
    }else
    {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
            
    $stmt = $conn->prepare("INSERT INTO `tb_geral` (`nome`,`email`,`senha`) VALUES (?,?,?) ");
    $stmt->bind_param('sss', $nome, $email, $senha);
    
    if(!$stmt->execute())
    {
            $erro = $stmt->error;
    }
    else{
            header("Location:login.php");
    exit;
    }
    }
}}
?>