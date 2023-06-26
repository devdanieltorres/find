<?php
// esse código vai adicionar o usuario a um grupo ou sair do grupo

ob_start(); // Inicia o buffer de saída

require_once 'conexao.php';
require_once 'index.php';

// função do botão que faz o usuário entrar ou criar grupo
if (isset($_POST['botaoAlterar'])) {

// variaveis com nome e senha do grupo inseridas
$alterarEmail = $_POST['alterarEmail'];
$alterarSenha = $_POST['alterarSenha'];

// variaveis global do usuario logado
$email  = $_SESSION['email'];
$senha  = $_SESSION['senha']; 
        
// comando sql para atualizar o campo nome e senha do grupo
$sql = ("UPDATE `tb_geral`
SET `email` = '$alterarEmail', `senha` = '$alterarSenha'
WHERE `email` = '$email' and `senha` = '$senha'");

mysqli_query($conn, $sql);

mysqli_close($conn);

// Limpa o buffer de saída
ob_clean();

header("Location: login.php");
exit();

}

// Libera o buffer de saída e desativa o buffer de saída
ob_end_flush(); 

?>