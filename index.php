<?php
// esse código se refere a pagina principal do sistema
require 'config.php';
require_once 'conexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: pagina_de_erro.php"); // Redirecionar para a página de erro
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>FIND</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">

    <link rel="shortcut icon" href="./imagens/icon.ico">
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

</head>

<body>
    <div id='search-box'>
        <form id="form" action='/search' class='search-form' method='get' target='_top'>
            <input id="endereco" class='search-text' name='q' placeholder='Digite sua pesquisa' type='text' />
            <!--botão pesquisar-->
            <button id='search-button' type='submit' title="BUSCAR"><span>
                    <img style="margin-top: 3px;"
                        src="https://icons-for-free.com/download-icon-search+48px-131985193513046498_32.png" /></span></button>
        </form><br><br><br>

        <!--botão sair-->
        <button id='sair' class="round-button" type='submit' title="SAIR"><span>
                <img style="margin-top: 3px;"
                    src="https://icons-for-free.com/download-icon-logout-1330218217127266875_32.png" /></span></button><br><br><br><br>
        <!--botão atualizar-->
        <button id="atualizar" class="round-button" onclick="atualizarPagina();" title="ATUALIZAR"><span>
                <img style="margin-top: 3px;"
                    src="https://icons-for-free.com/download-icon-refreshCW+refresh+reload+update+resume-1330021052157636817_32.ico" /></span></button><br><br><br><br>
        <!--abrir popup config-->
        <button id="config" class="round-button" type='submit' title="CONFIGURAÇÕES"><span>
                <img style="margin-top: 3px;"
                    src="https://icons-for-free.com/download-icon-gear+icon-1320196831785672705_32.ico" /></span></button><br><br><br><br>
        <!--botão chat-->
        <button id="chat" class="round-button" type='submit' title="CHAT"><span>
                <img style="margin-top: 3px;"
                    src="https://icons-for-free.com/download-icon-chat+48px-131985189802507530_32.ico" /></span></button><br><br><br><br>
        <!--Botão de grupo-->
        <button id="group" class="round-button" title="GRUPO">
            <img
                src="https://icons-for-free.com/download-icon-elusive+icons+group-1324449190853841092_32.png" /></button><br><br><br><br>
        <!--Botão que mostra minha localização-->
        <button id="user-location" class="round-button" title="LOCAL">
            <img
                src="https://icons-for-free.com/download-icon-my+location+24px-131987943372958995_32.png" /></button><br><br><br><br>
        <!--Botão que traça uma rota-->
        <button id="user-route" class="round-button" title="TRAJETO">
            <img
                src="https://icons-for-free.com/download-icon-location+map+navigator+target+track+icon-1320086049305773935_32.png" /></button><br><br><br><br>

    </div>

    <!--insere o mapa na pagina-->
    <div class="wrap" id="map"></div>

    <!--POPUPS-->

    <!--popup chat-->
    <div class="popup-wrapper-chat">
        <div class="popup-chat">
            <div class="popup-close-chat">x</div>
            <div class="popup-content-chat">
                <H3 style="color: #3498db; text-align: center;">CHAT DO GRUPO</H3>
                <hr class="separador">
                <div id="chat-container"></div>
                <div class="rolagem">
                    <ul id="message-list"></ul>
                </div>
                <div id="input-container">
                    <input type="text" class="search-form input-chat" id="message-input"
                        placeholder="Digite sua mensagem">
                    <button data-id-Nome="<?php echo $GLOBALS['nome']; ?>"
                        data-id-Grupo="<?php echo $GLOBALS['nomeDoGrupo']; ?>" id="send-button"
                        class="btn-pop custom-enviar">ENVIAR</button><br><br>
                </div>
            </div>
        </div>
    </div>

    <!--popup config-->
    <div class="popup-wrapper-conf">
        <div class="popup-conf">
            <div class="popup-close-conf">x</div>
            <div class="popup-content-conf">
                <form name="formConfig" method="post">
                    <br>
                    <H3 style="color: #3498db;">DADOS DO USUÁRIO</H3>
                    <hr class="separador"><br>
                    <strong><label>ID:</label></strong>
                    <label><?php echo $resultado[0]; ?></label><br><br>
                    <strong><label>Nome:</label></strong>
                    <label><?php echo $resultado[1]; ?></label><br><br>
                    <strong><label>E-mail:</label></strong>
                    <label><?php echo $_SESSION['email']; ?></label><br><br>
                    <strong><label>Senha:</label></strong>
                    <label><?php echo $_SESSION['senha']; ?></label><br><br>
                    <strong><label>Nome do grupo:</label></strong>
                    <label><?php echo $GLOBALS['nomeDoGrupo']; ?></label><br><br>
                    <strong><label>Senha do grupo:</label></strong>
                    <label><?php echo $GLOBALS['senhaDoGrupo']; ?></label><br><br>
                    <strong><label>Horário última localização:</label></strong><br>
                    <label><?php echo $GLOBALS['horario']; ?></label><br><br>
                    <hr class="separador"><br>
                    <button id="alterar" type="submit" class="btn-pop">Alterar email e senha</button><br><br>
                    <button id="deletar" type="submit" class="btn-pop custom-red">Deletar conta</button><br><br>
                </form>
            </div>
        </div>
    </div>

    <!--popup alterar email e senha-->
    <div class="popup-wrapper-alterar">
        <div class="popup-alterar">
            <div class="popup-close-alterar">x</div>
            <div class="popup-content-alterar">
                <form name="formAlterar" method="post" action="alterar_email.php">
                    <br>
                    <H3 style="color: #3498db;">ALTERAR EMAIL E SENHA</H3>
                    <hr class="separador"><br>
                    <label>Novo email:</label><br>
                    <input class="search-form input-chat" type="text" placeholder="Novo email." required="required"
                        name="alterarEmail" id="alterar_Email"><br><br>
                    <label>Nova senha:</label><br>
                    <input class="search-form input-chat" type="text" placeholder="Nova senha." required="required"
                        name="alterarSenha" id="alterar_Senha"><br><br>
                    <button type="submit" class="btn-pop" name="botaoAlterar">Alterar</button><br><br>
                    <hr class="separador"><br>
                    <label>Ao alterar você será deslogado!</label><br><br>
                </form>
            </div>
        </div>
    </div>

    <!--popup deletar conta             name="botaoDeletar"-->
    <div class="popup-wrapper-deletar">
        <div class="popup-deletar">
            <div class="popup-close-deletar">x</div>
            <div class="popup-content-deletar">
                <form name="formDel" method="post" action="deletar_conta.php">
                    <br>
                    <H3 style="color: #3498db;">Deletar conta</H3>
                    <hr class="separador"><br>
                    <label>Deseja mesmo deletar sua conta?</label><br><br>
                    <button type="submit" class="btn-pop custom-red" name="botaoDeletar">Deletar</button><br><br>
                    <hr class="separador"><br>
                </form>
            </div>
        </div>
    </div>

    <!--popup grupo-->
    <div class="popup-wrapper-group">
        <div class="popup-group">
            <div class="popup-close-group">x</div>
            <div class="popup-content-group">
                <form name="formGrupo" method="post" action="grupo.php">
                    <br>
                    <H3 style="color: #3498db;">ENTRAR OU CRIAR NOVO GRUPO</H3>
                    <hr class="separador"><br>
                    <label>Informe o nome do grupo:</label><br>
                    <input class="search-form input-chat" type="text" placeholder="Nome grupo." required="required"
                        name="nomeDoGrupo" id="nome_Grupo"><br><br>
                    <label>Informe a senha do grupo:</label><br>
                    <input class="search-form input-chat" type="text" placeholder="Senha grupo." required="required"
                        name="senhaDoGrupo" id="senha_Grupo"><br><br>
                    <hr class="separador"><br>
                    <button type="submit" class="btn-pop" name="botaoEntrar">Entrar ou Criar Grupo</button><br><br>
                    <button type="submit" class="btn-pop custom-red" name="botaoSair">Sair do Grupo</button><br><br>
                </form>
            </div>
        </div>
    </div>

    <!--popup local-->
    <div class="popup-wrapper-loc">
        <div class="popup-loc">
            <div class="popup-close-loc">x</div>
            <div class="popup-content-loc">
                <form name="" method="" action="">
                    <br>
                    <H3 style="color: #3498db;">CONSULTAR LOCAL</H3>
                    <hr class="separador"><br>
                    <div class="rolagem">
                    <?php 
                    $nomeGrupo = $GLOBALS['nomeDoGrupo'];
                    $senhaGrupo = $GLOBALS['senhaDoGrupo'];

                    // seleciona o nome, latitude, longitude e horario dos usuarios do grupo
                    $sql = "SELECT nome, latitude, longitude, horario FROM tb_geral 
                            WHERE nomeGrupo = '$nomeGrupo' AND senhaGrupo = '$senhaGrupo' 
                            AND nomeGrupo != '' AND senhaGrupo != ''
                            AND latitude != '' AND longitude != '';";
                    
                    $resultado = mysqli_query($conn, $sql);
                    
                    // verifica se a variável $nomeGrupo é igual a "nenhum grupo"
                    if ($nomeGrupo === "nenhum grupo") {
                        echo "Não há pessoas nesse grupo.";
                    } elseif (mysqli_num_rows($resultado) > 0) {
                        while ($linha = mysqli_fetch_assoc($resultado)) {
                            $nomeUsuario = $linha["nome"];
                            $latitudeUsuario = $linha["latitude"];
                            $longitudeUsuario = $linha["longitude"];
                            $horario = $linha["horario"];
                    ?>
                            <!-- gera os botões -->
                            <button type="button" class="btn-pop" id="<?php echo $nomeUsuario; ?>"
                                    onclick="localizar(this); fecharPopupLocal(this)"
                                    data-id-La="<?php echo $latitudeUsuario; ?>"
                                    data-id-Lo="<?php echo $longitudeUsuario; ?>">
                                <?php 
                                    echo $nomeUsuario; 
                                    echo "<br>";
                                    echo $horario; 
                                ?>
                            </button><br><br>
                    <?php
                        }
                    } else {
                        echo "Não há pessoas nesse grupo.";
                    }
                    ?>
                </div>
                    <hr class="separador"><br>
                    <label>Selecione um usuário para consultar a localização que foi compartilhada no horario abaixo do nome!</label><br>
                    </label><br><br>

                </form>
            </div>
        </div>
    </div>

    <!--abrir popup trajeto-->
    <div class="popup-wrapper-trajeto">
        <div class="popup-trajeto">
            <div class="popup-close-trajeto">x</div>
            <div class="popup-content-trajeto">
                <form name="" method="" action="">
                    <br>
                    <H3 style="color: #3498db;">CONSULTAR TRAJETO</H3>
                    <hr class="separador"><br>
                    <div class="rolagem">
                    <?php 
                    $nomeGrupo = $GLOBALS['nomeDoGrupo'];
                    $senhaGrupo = $GLOBALS['senhaDoGrupo'];

                    // seleciona o nome, latitude, longitude e horario dos usuarios do grupo
                    $sql = "SELECT nome, latitude, longitude, horario FROM tb_geral 
                            WHERE nomeGrupo = '$nomeGrupo' AND senhaGrupo = '$senhaGrupo'
                            AND nomeGrupo != '' AND senhaGrupo != ''
                            AND latitude != '' AND longitude != '';";
                    
                    $resultado = mysqli_query($conn, $sql);

                    $email = $_SESSION['email'];
                    $senha = $_SESSION['senha'];

                    // faz a consulta sql
                    $sqlCord = "SELECT * FROM `tb_geral` WHERE `email` = '$email' 
                                AND `senha` = '$senha'";

                    // gera a query
                    $queryCords = mysqli_query($conn, $sqlCord);

                    // adiciona o array à variável resultado
                    $resultadoCords = mysqli_fetch_array($queryCords);

                    // verifica se a variável $nomeGrupo é igual a "nenhum grupo"
                    if ($nomeGrupo === "nenhum grupo") {
                        echo "Não há pessoas nesse grupo.";
                    } elseif (mysqli_num_rows($resultado) > 0) {
                        while ($linha = mysqli_fetch_assoc($resultado)) {
                            $nomeUsuario = $linha["nome"];
                            $latitudeUsuario = $linha["latitude"];
                            $longitudeUsuario = $linha["longitude"];
                            $horario = $linha["horario"];
                    ?>
                            <!-- gera os botões -->
                            <button type="button" class="btn-pop" id="<?php echo $nomeUsuario; ?>"
                                    onclick="trajeto(this); fecharPopupTrajeto(this)"
                                    data-id-La="<?php echo $latitudeUsuario; ?>"
                                    data-id-Lo="<?php echo $longitudeUsuario; ?>"
                                    data-id-MinhaLatitude="<?php echo $resultadoCords[6]; ?>"
                                    data-id-MinhaLongitude="<?php echo $resultadoCords[7]; ?>">
                                <?php   
                                    echo $nomeUsuario; 
                                    echo "<br>";
                                    echo $horario;
                                ?>
                            </button><br><br>
                    <?php
                        }
                    } else {
                        echo "Não há pessoas nesse grupo.";
                    }
                    ?>
                </div>
                    <hr class="separador"><br>
                    <label><label>Selecione um usuário para consultar o trajeto até a localização que foi compartilhada no horario abaixo do nome!</label><br>
                    </label><br><br>
                </form>
            </div>
        </div>
    </div>

    <script src="chat.js"></script>
    <script src="action.js"></script>
    <script src="local.js"></script>
    <script src="localizar.js"></script>
    <script src="trajeto.js"></script>
    <script src="print.js"></script>

</body>

</html>