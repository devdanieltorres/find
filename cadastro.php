<?php
// esse código se refere a pagina de cadastro
session_start();
?>
<html>

<head>
    <link rel="shortcut icon" href="./imagens/icon.ico">
    <meta http-equiv="Content-type" content="text/html" charset="ISO-8859-1">
    <title>Find - Cadastro</title>
    <link rel="stylesheet" type="text/css" href="estiloLogin.css" />

    <script>
    function validarCadastro() {
        var nome_cadastro = formCadastro.nome_cad.value;
        var email_cadastro = formCadastro.email_cad.value;
        var senha_cadastro = formCadastro.senha_cad.value;

        if (nome_cadastro == "") {
            alert('Campo nome obrigatório!');
            formCadastro.nome_cad.focus();
            return false;
        }
        if (email_cadastro == "") {
            alert('Campo e-mail obrigatório!');
            formCadastro.email_cad.focus();
            return false;
        }
        if (senha_cadastro == "" || (senhaCad.length < 6)) {
            alert('Digite uma senha de no máximo 8 caracteres!');
            formCadastro.senha_cad.focus();
            return false;
        }

        document.formCadastro.submit();

    }
    </script>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="quadrado altura_cadastro">
                <form name="formCadastro" method="post" action="validaCadastro.php">
                    <h1>Cadastro</h1>
                    <p>
                        <label for="nome_cad">seu nome</label>
                        <input id="nome_cad" name="nome" maxlength="60" required="required" type="text"
                            placeholder="ex. nome" />
                    </p>

                    <p>
                        <label for="email_cad">seu e-mail</label>
                        <input id="email_cad" name="email" maxlength="50" required="required" type="text"
                            placeholder="ex. exemplo@gmail.com" />
                    </p>

                    <p>
                        <label for="senha_cad">sua senha</label>
                        <input id="senha_cad" name="senha" maxlength="8" required="required" type="password"
                            placeholder="ex. 12345678" />
                    </p>

                    <p>
                        <input type="submit" value="Cadastrar" onclick="return validarCadastro()" />
                    </p>

                    <p class="link altura_link_cadastro">
                        Ja tem conta?
                        <a href="login.php">Ir para Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>