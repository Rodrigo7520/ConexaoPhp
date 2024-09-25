<?php
// Iniciar a sessão
session_start();

// Receber os dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Verificar se os campos não estão vazios
if (empty($usuario) || empty($senha)) {
    header("Location: ../login.html?erro=empty_fields");
    exit;
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // senha do banco
$dbname = "bancodedados"; // nome do banco

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro de conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Preparar e executar a consulta para verificar se o usuário existe
$sql = $conn->prepare("SELECT id, senha FROM cadastro WHERE usuario = ?");
$sql->bind_param("s", $usuario);
$sql->execute();
$result = $sql->get_result();

// Verificar se encontrou o usuário
if ($result->num_rows > 0) {
    // Obter os dados do usuário
    $row = $result->fetch_assoc();
    
    // Verificar se a senha está correta (comparando com o texto simples)
    if ($senha === $row['senha']) {
        // Senha correta - autenticar o usuário
        $_SESSION['usuario_id'] = $row['id'];  // Armazenar ID do usuário na sessão
        $_SESSION['usuario'] = $usuario;        // Armazenar nome do usuário na sessão
        
        // Redirecionar para a página inicial
        header("Location: ../HTML/iniciosessao.html");
        exit;
    } else {
        // Senha incorreta
        header("Location: ../HTML/login.html?erro=wrong_password");
        exit;
    }
} else {
    // Usuário não encontrado
    header("Location: ../HTML/login.html?erro=user_not_found");
    exit;
}

// Fechar a conexão
$conn->close();
?>
