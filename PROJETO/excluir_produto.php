<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produtos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar_produtos.php");
        exit();
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
} else {
    echo "ID do produto não informado.";
}
?>
