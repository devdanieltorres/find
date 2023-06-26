<?php
// esse código vai atualizar a localização do usuario no banco de dados

require_once 'index.php';
require_once 'conexao.php';

// obtem a variavel com a latitude e longitude
$local = $_GET['local'];

// separa a latitude da longitude para duas variaveis
list($lat, $long) = explode("/", $local);

// variaveis global do usuario logado
$email  = $_SESSION['email'];
$senha  = $_SESSION['senha'];
                
// comando para atualizar a localização
$sql = ("UPDATE `tb_geral`
SET `latitude` = '$lat', `longitude` = '$long'
WHERE `email` = '$email' and `senha` = '$senha'");

mysqli_query($conn, $sql);

?>

