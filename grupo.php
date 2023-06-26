<?php
// esse código vai adicionar o usuario a um grupo ou sair do grupo

require_once 'conexao.php';
require_once 'index.php';

if (isset($_POST['botaoEntrar'])) {

// variaveis com nome e senha do grupo inseridas
$nomeDoGrupo = $_POST['nomeDoGrupo'];
$senhaDoGrupo = $_POST['senhaDoGrupo'];

// variaveis global do usuario logado
$email  = $_SESSION['email'];
$senha  = $_SESSION['senha']; 
        
// comando sql para atualizar o campo nome e senha do grupo
$sql = ("UPDATE `tb_geral`
SET `nomeGrupo` = '$nomeDoGrupo', `senhaGrupo` = '$senhaDoGrupo'
WHERE `email` = '$email' and `senha` = '$senha'");

mysqli_query($conn, $sql);

mysqli_close($conn);

}

if (isset($_POST['botaoSair'])) {
    $nomeDoGrupo = $_POST['nomeDoGrupo'];
    $senhaDoGrupo = $_POST['senhaDoGrupo'];
    
    $email  = $_SESSION['email'];
    $senha  = $_SESSION['senha']; 

    // consulta SELECT para verificar o nome e a senha do grupo
    $sql = "SELECT * FROM `tb_geral` WHERE `email` = '$email' and `senha` = '$senha' and `nomeGrupo` = '$nomeDoGrupo' AND `senhaGrupo` = '$senhaDoGrupo'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // o nome e a senha do grupo estão corretos, então o usuário pode sair do grupo
        $sql = ("UPDATE `tb_geral`
        SET `nomeGrupo` = '', `senhaGrupo` = ''
        WHERE `email` = '$email' and `senha` = '$senha'");
        
        mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    } else {
        // o nome e a senha do grupo estão incorretos, então o usuário não pode sair do grupo
        echo '<script>alert("Nome ou senha do grupo incorretos!");</script>';

    }
}
?>