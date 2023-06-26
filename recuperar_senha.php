<html>
<head>
    <title>Find - Recuperar Senha</title>
    <link rel="shortcut icon" href="./imagens/icon.ico">
</head>
<body>
    <div class="container">
        <div class="content">
            <div id="recuperar_senha">
                <h1>Recuperar Senha</h1>
                <link rel="stylesheet" type="text/css" href="estiloLogin.css" />

                <form method="post" action="enviar_senha.php">
                    <p>
                        <label for="email_recuperacao">Digite seu email</label>
                        <input id="email_recuperacao" name="email_recuperacao" maxlength="50" required="required" type="text" placeholder="ex. exemplo@gmail.com" /><br><br>
                    </p>
                    <p>
                        <input type="submit" value="Enviar" />
                    </p>

                    <p class="link">
                        Ja tem conta?
                        <a href="login.php">Ir para Login</a><br><br>
                        Ainda não tem conta?
                        <a href="cadastro.php">Cadastre-se</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
