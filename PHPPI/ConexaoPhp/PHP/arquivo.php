<?php
// Conectar ao banco de dados
$servername = "localhost"; // ou seu servidor
$username = "root"; // seu usuário do banco
$password = ""; // sua senha do banco
$dbname = "bancodedados"; // seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}else{
    echo("Conexão estabelecida com sucesso.");
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Preparar e executar a consulta
$stmt = $conn->prepare("INSERT INTO cadastro (nome, email, usuario, senha) VALUES (?, ?, ?, ?)");

// A função bind_param em PHP é usada para vincular variáveis a parâmetros em uma consulta preparada. Isso ajuda a proteger contra SQL Injection, pois os dados são tratados como valores e não como parte da consulta SQL. 
$stmt->bind_param("ssss", $nome, $email, $usuario, $senha); // "ss" indica que ambos são strings

if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário: " . $stmt->error;
}

/*$sql = "DELETE FROM cadastro WHERE id = '?'";

if ($conn->query($sql) === TRUE) {
    echo "Registro excluído com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

//O comando UPDATE é utilizado para modificar dados existentes em uma tabela. 
$sql2 = "UPDATE cadastro SET email='$email' WHERE id ='?'";

if ($conn->query($sql2) === TRUE) {
    echo "Registro atualizado com sucesso";
} else {
    echo "Erro: " . $sql2. "<br>" . $conn->error;
}*/

// Fechar a conexão
$stmt->close();
$conn->close();
?>
