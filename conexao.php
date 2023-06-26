<?php
//conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'find';

// Cria uma conexão
$conn = mysqli_connect($host, $user, $password, $db_name);

// Verifica se a conexão foi bem sucedida
if (!$conn) {
    die('Erro de conexão: ' . mysqli_connect_error());
}

?>