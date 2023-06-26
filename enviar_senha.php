<?php

require_once 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem o email fornecido pelo usuário
    $email_recuperacao = $_POST["email_recuperacao"];

    // Verifique se o email existe na sua base de dados
    $consulta = mysqli_query($conn, "SELECT * FROM `tb_geral` WHERE email = '$email_recuperacao'");
    $usuario = mysqli_fetch_assoc($consulta);

    // Se o email existe, envia a senha para o usuário
    if ($usuario) {
        $senha = $usuario["senha"];

        // Envie o email com a senha para o usuário
        $assunto = "Recuperar Senha - FIND";
        $mensagem = "Sua senha: " . $senha;
        mail($email_recuperacao, $assunto, $mensagem);

        // Redirecione o usuário para uma página de sucesso
        header("Location: sucesso_email.php");
        exit();
    } else {
        // Se o email não existe, redirecione o usuário para uma página de erro
        header("Location: erro_email.php");
        exit();
    }
}
?>
