<?php
// esse código vai adicionar o usuario a um grupo ou sair do grupo

ob_start(); // Inicia o buffer de saída

require_once 'conexao.php';
require_once 'index.php';

if (isset($_POST['botaoDeletar'])) {

$email  = $_SESSION['email'];
$senha  = $_SESSION['senha']; 
    
// comando sql para deletar o usuario do banco de dados 
$sql = ("DELETE FROM `tb_geral`
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