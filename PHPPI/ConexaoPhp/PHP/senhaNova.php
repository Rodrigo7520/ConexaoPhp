<?php 
// Conectar ao banco de dados usando mysqli
$servername = "localhost";
$username = "root";
$password = ""; // senha do banco
$dbname = "bancodedados"; // nome do banco

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}

// Obtenção de dados via POST
$email = $_POST['email'];
$novaSenha = $_POST['novasenha']; // Usando password_hash
$repetirSenha = $_POST['repetirSenha']; // Senha não hash para comparação
$id = $_POST['id'];

// Verifica se o email foi preenchido
if (empty($email)) {
    echo "<script language='javascript' type='text/javascript'>
    alert('O campo email deve ser preenchido');
    window.location.href='senha.html';
    </script>";
    exit();
}

// Verifica se as senhas coincidem
if ($repetirSenha != $_POST['novasenha']) {
    echo "<script language='javascript' type='text/javascript'>
    alert('As senhas não coincidem!');
    window.location.href='senha.html';
    </script>";
    exit();
}

// Verifica se o email já existe no banco de dados
$query_select = "SELECT email FROM senha WHERE id = ?";
$stmt = mysqli_prepare($conn, $query_select);
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $logarray);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($logarray == $email) {
    echo "<script language='javascript' type='text/javascript'>
    alert('Esse email já existe');
    window.location.href='senha.html';
    </script>";
    exit();
}

// Insere o novo registro
$query_insert = "INSERT INTO senha (email, novaSenha) VALUES (?, ?)";
$stmt_insert = mysqli_prepare($conn, $query_insert);
mysqli_stmt_bind_param($stmt_insert, 'ss', $email, $novaSenha);

if (mysqli_stmt_execute($stmt_insert)) {
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário cadastrado com sucesso!');
    window.location.href='senha.html';
    </script>";
} else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Não foi possível cadastrar esse usuário');
    window.location.href='senha.html';
    </script>";
}

mysqli_stmt_close($stmt_insert);

// Deleta o registro com base no ID
$sql_delete = "DELETE FROM senha WHERE id = ?";
$stmt_delete = mysqli_prepare($conn, $sql_delete);
mysqli_stmt_bind_param($stmt_delete, 's', $id);

if (mysqli_stmt_execute($stmt_delete)) {
    echo "Registro excluído com sucesso";
} else {
    echo "Erro ao excluir: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt_delete);

// Atualiza o registro com base no ID
$sql_update = "UPDATE senha SET email=? WHERE id=?";
$stmt_update = mysqli_prepare($conn, $sql_update);
mysqli_stmt_bind_param($stmt_update, 'ss', $email, $id);

if (mysqli_stmt_execute($stmt_update)) {
    echo "Registro atualizado com sucesso";
} else {
    echo "Erro ao atualizar: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt_update);

// Fechar a conexão
mysqli_close($conn);
?>
