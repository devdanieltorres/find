<?php
// Este código se refere a coleta dos dados para o popup configurações

// Começa ou continua a sessão
session_start();
require_once 'conexao.php';

// Acessa as variáveis globais email e senha do usuário
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$senha = isset($_SESSION['senha']) ? $_SESSION['senha'] : '';

if (!empty($email) && !empty($senha)) {
  // Faz a consulta SQL selecionando toda a linha do usuário
  $sql = "SELECT * FROM `tb_geral` WHERE `email` = '$email' AND `senha` = '$senha'";
  $query = mysqli_query($conn, $sql);
  $resultado = mysqli_fetch_array($query);

  if ($resultado) {
    $GLOBALS['nome'] = $resultado[1];
    $GLOBALS['nomeDoGrupo'] = $resultado[4];
    $GLOBALS['senhaDoGrupo'] = $resultado[5];
    $GLOBALS['horario'] = $resultado[8];
  }
}
?>