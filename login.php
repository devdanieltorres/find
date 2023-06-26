<?php
// esse código se refere a pagina de login
session_start();
?>
<html>

<head>
    <link rel="shortcut icon" href="./imagens/icon.ico">
    <title>Find - Login</title>
    <link rel="stylesheet" type="text/css" href="estiloLogin.css" />
    <script type="text/javascript">
    function validar() {
        var email_log = formLogin.email_login.value;
        var senha_log = formLogin.senha_login.value;

        if (email_log === "") {
            alert('Preencha o campo com seu email!');
            formLogin.email_login.focus();
            return false;
        }
        if (senha_log === "") {
            alert('Preencha o campo com seu senha!');
            formLogin.senha_login.focus();
            return false;
        }
        document.formLogin.submit();
    }
    </script>

<body>
    <div class="container">
        <div class="content">
            <!--FORMULARIO DE LOGIN-->
            <div id="login">
                <form name="formLogin" method="post" action="validaLogin.php">
                    <h1>Login</h1>
                    <p>
                        <label for="email_login">Seu e-mail</label>
                        <input id="email_login" name="email" maxlength="50" required="required" type="text"
                            placeholder="ex. exemplo@gmail.com" />
                    </p>
                    <p>
                        <label for="senha_login">Sua senha</label>
                        <input id="senha_login" name="senha" maxlength="8" required="required" type="password"
                            placeholder="ex. 12345678" />
                    </p>
                    <p>
                        <input id="manterlogado" name="manterlogado" type="checkbox" value="" />
                        <label for="manterlogado">Manter-me conectado</label>
                    </p>

                    <p>
                        <input type="submit" value="Entrar" onclick="return validar()" />
                    </p>

                    <p class="link">
                        Esqueceu a senha?
                        <a href="recuperar_senha.php">Esqueci minha senha</a><br><br>
                        Ainda não tem conta?
                        <a href="cadastro.php">Cadastre-se</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>