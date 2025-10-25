<?php

include("conexao.php");


if (method_exists($conn, 'set_charset')) {
    $conn->set_charset('utf8mb4');
}


$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$categoria = trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING));
$preco_raw = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
$quantidade_raw = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);


$preco = null;
if ($preco_raw !== null && $preco_raw !== '') {
    $preco = str_replace(',', '.', $preco_raw);
    $preco = floatval($preco);
}


$quantidade = ($quantidade_raw === null || $quantidade_raw === '') ? 0 : intval($quantidade_raw);


if (empty($nome)) {
    
    echo "Erro: O nome do produto não pode ficar vazio.";
    exit;
}


$sql = "INSERT INTO produtos (nome, categoria, preco, quantidade) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Erro no prepare: " . $conn ->error;
    exit;
}


$preco_param = ($preco === null) ? 0 : $preco;
$stmt->bind_param('ssdi', $nome, $categoria, $preco_param, $quantidade);

if ($stmt->execute()) {
    
    header("Location: listar_produtos.php");
    exit;
} else {
    echo "Erro ao inserir: " . $stmt->error;
    exit;
}
?>
