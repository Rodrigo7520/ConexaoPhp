<?php
// O comando SELECT é utilizado para recuperar dados das tabelas. Vamos fazer uma consulta e ordenar os resultados por nome em ordem alfabética.

$sql = "SELECT id, nome, email FROM cadastro ORDER BY nome ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Saída de cada linha – fetch_assoc()representa acriação de nova linha para mostrar o resultado
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nome: " . $row["nome"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 resultados";
}
 
?>