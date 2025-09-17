<?php
require_once 'db.php';
$stmt = $conn->query("SELECT * FROM menu_items ORDER BY tipo, nome");
$items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Cardápio</title>
  <link rel="stylesheet" href="pedidos.css">
</head>
<body>
  <main class="pedido">
    <h2>Cardápio</h2>
    <table>
      <thead><tr><th>Nome</th><th>Tipo</th><th>Preço</th><th>Descrição</th></tr></thead>
      <tbody>
        <?php foreach ($items as $it): ?>
          <tr>
            <td><?= htmlspecialchars($it['nome']) ?></td>
            <td><?= htmlspecialchars($it['tipo']) ?></td>
            <td>R$ <?= number_format($it['preco'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($it['descricao']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</body>
</html>
