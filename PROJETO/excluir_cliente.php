<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
  die("ID inválido.");
}

$id = intval($_GET['id']);
$sql = "DELETE FROM clientes WHERE id = $id";

if ($conn->query($sql)) {
  header("Location: buscar_clientes.php");
  exit();
} else {
  echo "<div class='alert alert-danger text-center mt-3'>Erro ao excluir cliente.</div>";
}
?>
