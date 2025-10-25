<?php
include("conexao.php");

$termo = isset($_GET["termo"]) ? $_GET["termo"] : "";

$sql = "SELECT * FROM clientes 
        WHERE nome LIKE '%$termo%' 
        OR razaoSocial LIKE '%$termo%' 
        OR cpf LIKE '%$termo%' 
        OR cnpj LIKE '%$termo%'";

$result = $conn->query($sql);

$clientes = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

echo json_encode($clientes);
$conn->close();
?>
