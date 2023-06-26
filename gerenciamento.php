<link rel="shortcut icon" href="./imagens/icon.ico">

<?php
// Pagina para gerenciamento de usuarios

require_once 'conexao.php';
session_start();
      
if ($conn->connect_errno)
{
    echo "Ocorreu um erro na conexao com o banco de dados.";
    exit;
}
        
mysqli_set_charset($conn, 'utf8');
 
$id     = -1;
$nome   = "";
$email  = "";
$cidade = "";
$uf     = "";
 
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"]))
{
	if(empty($_POST["nome"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["email"]))
		$erro = "Campo e-mail obrigatório";
	else{  
        $id     = $_POST["id"];		
		$nome   = $_POST["nome"];
		$email  = $_POST["email"];
		$senha = $_POST["senha"];
				
		if($id == -1)
		{
			$stmt = $conn->prepare("INSERT INTO `tb_geral` (`nome`,`email`,`senha`) VALUES (?,?,?)");
			$stmt->bind_param('sss', $nome, $email, $senha);	
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:gerenciamento.php");
				exit;
			}
		}
                
		else
		if(is_numeric($id) && $id >= 1){
			$stmt = $conn->prepare("UPDATE `tb_geral` SET `nome`=?, `email`=?, `senha`=? WHERE id = ? ");
			$stmt->bind_param('sssi', $nome, $email, $senha, $id);
		
			if(!$stmt->execute()){
				$erro = $stmt->error;
			}
			else
			{
				header("Location:gerenciamento.php");
				exit;
			}
		}
		else{   $erro = "Número inválido";
		}
	}
}
else
    
if(isset($_GET["id"]) && is_numeric($_GET["id"])){
        // pegamos aqui o id passado
	$id = (int)$_GET["id"];
        
        if(isset($_GET["del"])){
            $stmt = $conn->prepare("DELETE FROM `tb_geral` WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            header("Location:gerenciamento.php");
            exit;
        }else{
        // montamo a consulta
	$stmt = $conn->prepare("SELECT * FROM `tb_geral` WHERE id = ?"); //
        // passa o id como parâmetro
	$stmt->bind_param('i', $id);
        // executa a consulta
	$stmt->execute();
	// retorna o resultado
	$result = $stmt->get_result();
    $aux_query = $result->fetch_assoc();
	$nome = $aux_query["nome"];
	$email = $aux_query["email"];
	$senha = $aux_query["senha"];
	$stmt->close();
        }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Find - Gerenciamento</title>
    <style>
    /* Estilos para a tabela */
    table {
        border-collapse: collapse;
        margin: 20px auto;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #ddd;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    /* Estilos para o formulário */
    form {
        max-width: 500px;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: none;
        border-bottom: 2px solid #ccc;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-bottom: 2px solid #007bff;
    }

    button[type="submit"] {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .separador {
        border: none;
        border-top: 1px solid #ccc;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?php
	if(isset($erro))
		echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
	else
	if(isset($sucesso))
		echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
	
	?>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
        <h1>Cadastrar usuário</h1>
        Nome:<br />
        <input type="text" name="nome" placeholder="Nome para cadastro." value="<?=$nome?>"><br /><br />
        E-mail:<br />
        <input type="email" name="email" placeholder="E-mail para cadastro." value="<?=$email?>"><br /><br />
        Senha:<br />
        <input type="password" name="senha" placeholder="Senha para cadastro." value=""><br /><br />

        <input type="hidden" value="<?=$id?>" name="id">

        <button type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>
    </form>

    <hr class="separador">

    <table width="700px" border="1" cellspacing="0">
        <tr>
            <h1>Gerenciamento de usuários</h1>

            <td><strong>ID</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Senha</strong></td>
            <td><strong>Editar</strong></td>
            <td><strong>Excluir</strong></td>
        </tr>
        <?php
	$result = $conn->query("SELECT * FROM `tb_geral`");
    while ($aux_query = $result->fetch_assoc()) 
    {
	  echo '<tr>';
	  echo '  <td>'.$aux_query["id"].'</td>';
	  echo '  <td>'.$aux_query["nome"].'</td>';
	  echo '  <td>'.$aux_query["email"].'</td>';
	  echo '  <td>'.$aux_query["senha"].'</td>';

		echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["id"].'">'
	  			. 'Editar</a></td>';
		echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["id"].'&del=true">'
				. 'Excluir</a></td>';
	  echo '</tr>';
    }
	?>
    </table>
</body>

</html>