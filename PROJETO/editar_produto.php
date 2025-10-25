<?php
include 'conexao.php';

if (!isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: listar_produtos.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM produtos WHERE id = $id";
  $resultado = $conn->query($sql);
  $produto = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);
  $nome = $_POST['nome'];
  $categoria = $_POST['categoria'];
  $preco = $_POST['preco'];
  $quantidade = $_POST['quantidade'];

  $sql = "UPDATE produtos SET nome='$nome', categoria='$categoria', preco='$preco', quantidade='$quantidade' WHERE id=$id";

  if ($conn->query($sql)) {
    header("Location: listar_produtos.php");
    exit();
  } else {
    echo "Erro ao atualizar: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="editar_produto.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.html">Home</a>
    </div>
  </nav>

  <div class="container">
    <main class="main">
      <div class="form-box">
        <h2 class="text-center mb-4">Editar Produto</h2>
        <form method="POST" action="editar_produto.php">
          <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

          <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required>
          </div>

          <div class="mb-3">
            <label for="categoria" class="form-label">Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $produto['categoria']; ?>" required>
          </div>

          <div class="mb-3">
            <label for="preco" class="form-label">Preço (R$):</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $produto['preco']; ?>" required>
          </div>

          <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
          </div>

          <div class="text-end">
            <a href="listar_produtos.php" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
