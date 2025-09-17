<?php
// register.php
require_once 'db.php';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
        $error = 'Preencha todos os campos corretamente.';
    } else {
        // verifica se já existe
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hash]);
            $message = 'Cadastro realizado com sucesso. Você pode fazer pedidos informando seu email no formulário.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Registrar - Estação Bebidas & Sabores</title>
  <link rel="stylesheet" href="pedidos.css">
</head>
<body>
  <main class="pedido">
    <h2>Registrar usuário</h2>
    <?php if ($message): ?><div class="sucesso"><?= htmlspecialchars($message) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="erro"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form action="register.php" method="POST">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" required>

      <button type="submit">Cadastrar</button>
    </form>
  </main>
</body>
</html>
