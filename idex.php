<?php
// index.php
require_once 'db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $prato_id = !empty($_POST['prato']) ? intval($_POST['prato']) : null;
    $bebida_id = !empty($_POST['bebida']) ? intval($_POST['bebida']) : null;
    $sobremesa_id = !empty($_POST['sobremesa']) ? intval($_POST['sobremesa']) : null;
    $observacoes = trim($_POST['observacoes'] ?? '');

    // validações mínimas
    if ($nome === '') {
        $error = 'Por favor informe o nome.';
    } else {
        try {
            $conn->beginTransaction();

            // Se o cliente informou email, procuramos o usuário; se não existir, criamos um usuário com senha aleatória (hash)
            $user_id = null;
            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $r = $stmt->fetch();
                if ($r) {
                    $user_id = $r['id'];
                } else {
                    // cria usuário com senha gerada (envie por email se desejar) - usamos password_hash
                    $random_pass = bin2hex(random_bytes(6)); // senha temporária
                    $hashed = password_hash($random_pass, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$nome, $email, $hashed, $telefone]);
                    $user_id = $conn->lastInsertId();
                }
            }
            // Insere pedido
            $stmt = $conn->prepare("INSERT INTO orders (user_id, observacoes) VALUES (?, ?)");
            // se $user_id for null, passe null explicitamente
            $stmt->execute([$user_id, $observacoes]);
            $order_id = $conn->lastInsertId();

            // Função auxiliar para inserir item se existir
            $insert_item = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, quantidade) VALUES (?, ?, ?)");

            if ($prato_id) {
                $insert_item->execute([$order_id, $prato_id, 1]);
            }
            if ($bebida_id) {
                $insert_item->execute([$order_id, $bebida_id, 1]);
            }
            if ($sobremesa_id) {
                $insert_item->execute([$order_id, $sobremesa_id, 1]);
            }

            $conn->commit();
            $message = "Pedido recebido com sucesso! Número do pedido: {$order_id}";
        } catch (Exception $e) {
            $conn->rollBack();
            $error = "Erro ao processar o pedido: " . $e->getMessage();
        }
    }
}

// Pega itens do menu para popular selects
$stmt = $conn->query("SELECT * FROM menu_items ORDER BY tipo, nome");
$menu_items = $stmt->fetchAll();

$pratos = array_filter($menu_items, fn($i) => $i['tipo'] === 'prato');
$bebidas = array_filter($menu_items, fn($i) => $i['tipo'] === 'bebida');
$sobremesas = array_filter($menu_items, fn($i) => $i['tipo'] === 'sobremesa');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Faça seu Pedido - Estação Bebidas & Sabores</title>
  <link rel="stylesheet" href="pedidos.css">
</head>
<body>

  <header>
    <h1>Faça seu Pedido</h1>
  </header>

  <main class="pedido">
    <?php if ($message): ?>
      <div class="sucesso"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="erro"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="index.php" method="POST">
      
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">

      <label for="email">Email (opcional, para criar conta):</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

      <label for="telefone">Telefone (opcional):</label>
      <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">

      <label for="prato">Prato Principal:</label>
      <select id="prato" name="prato" required>
        <option value="">Selecione</option>
        <?php foreach ($pratos as $p): ?>
          <option value="<?= $p['id'] ?>" <?= (isset($_POST['prato']) && $_POST['prato'] == $p['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['nome']) ?> — R$ <?= number_format($p['preco'], 2, ',', '.') ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="bebida">Bebida:</label>
      <select id="bebida" name="bebida">
        <option value="">Selecione</option>
        <?php foreach ($bebidas as $b): ?>
          <option value="<?= $b['id'] ?>" <?= (isset($_POST['bebida']) && $_POST['bebida'] == $b['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($b['nome']) ?> — R$ <?= number_format($b['preco'], 2, ',', '.') ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="sobremesa">Sobremesa:</label>
      <select id="sobremesa" name="sobremesa">
        <option value="">Selecione</option>
        <?php foreach ($sobremesas as $s): ?>
          <option value="<?= $s['id'] ?>" <?= (isset($_POST['sobremesa']) && $_POST['sobremesa'] == $s['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($s['nome']) ?> — R$ <?= number_format($s['preco'], 2, ',', '.') ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="observacoes">Observações:</label>
      <textarea id="observacoes" name="observacoes" rows="4"><?= htmlspecialchars($_POST['observacoes'] ?? '') ?></textarea>

      <button type="submit">Enviar Pedido</button>

    </form>
  </main>

</body>
</html>
