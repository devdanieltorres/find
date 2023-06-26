<?php
session_start();
require_once 'conexao.php';

if ($conn->connect_errno)
{
    echo "Ocorreu um erro na conexao com o banco de dados.";
    exit;
}
        
mysqli_set_charset($conn, 'utf8');

$email  = $_POST["email"];
$senha  = $_POST["senha"];

$result = $conn->query("SELECT * FROM `tb_geral` where `email` = '$email' and `senha` = '$senha'");
if(mysqli_num_rows($result) > 0 ){
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('location:index.php');
}
else{
        unset ($_SESSION['email']);
        unset ($_SESSION['senha']);
        header('location:erro_login.php');
    }
?>

