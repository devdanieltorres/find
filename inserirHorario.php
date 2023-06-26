<?php
// esse código vai atualizar a localização do usuario no banco de dados

require_once 'index.php';
require_once 'conexao.php';

// obtem a variavel com a data e horario
$horario = $_GET['horario'];

// variaveis global do usuario logado
$email  = $_SESSION['email'];
$senha  = $_SESSION['senha'];

// comando para atualizar horario
$sqlHorario = ("UPDATE `tb_geral`
SET `horario` = '$horario'
WHERE `email` = '$email' and `senha` = '$senha'");

mysqli_query($conn, $sqlHorario);

?>

