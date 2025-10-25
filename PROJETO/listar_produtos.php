<?php
// URL do backend
$url = "https://meuservidor.com/api/produtos";

// Inicia cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a requisição
$resposta = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Verifica se deu certo
if ($httpcode == 200 && $resposta !== false) {
    $produtos = json_decode($resposta, true);
} else {
    $produtos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Produtos</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styleListaProdutos" />
  </head>
  <body>
    
    <div class="barra-horizontal">
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="home.html">Home</a>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle mt-1"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Menu
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="buscar_clientes.php">Clientes</a></li>
                      <li><a class="dropdown-item" href="listar_produtos.php">Produtos</a></li>
                      <li><a class="dropdown-item" href="#">Serviços</a></li>
                      <li><a class="dropdown-item" href="#">Vendas</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    
    <div class="container mt-5">
      <main class="main">
        <div class="form-box">
          <h2 class="text-center mb-4">Lista de Produtos</h2>

          <table class="table table-bordered table-striped text-center">
            <thead class="table-secondary">
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço (R$)</th>
                <th>Quantidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <a href="produtos.html" 
              class="btn btn-success position-fixed bottom-0 end-0 m-4 rounded-circle shadow"
              style="width: 60px; height: 60px; font-size: 28px; display: flex; align-items: center; justify-content: center;">
              +
            </a>

            <tbody>
              <?php
              if ($produtos && $produtos->num_rows > 0) {
                  while ($linha = $produtos->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $linha['id'] . "</td>";
                      echo "<td>" . $linha['nome'] . "</td>";
                      echo "<td>" . $linha['categoria'] . "</td>";
                      echo "<td>" . number_format($linha['preco'], 2, ',', '.') . "</td>";
                      echo "<td>" . $linha['quantidade'] . "</td>";
                      echo "<td>
                              <a href='editar_produto.php?id=" . $linha['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                              <a href='excluir_produto.php?id=" . $linha['id'] . "' class='btn btn-danger btn-sm'>Excluir</a>
                            </td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>Nenhum produto encontrado.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
