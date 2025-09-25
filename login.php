<?php
session_start();
require_once 'db.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($email === '' || $senha === '') {
        $erro = 'Preencha email e senha.';
    } else {
        $stmt = $conn->prepare("SELECT id, nome, senha FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            header("Location: welcome.php");
            exit;
        } else {
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<?php if ($erro): ?><p style="color:red;"><?=htmlspecialchars($erro)?></p><?php endif; ?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
</form>
<a href="recuperar_senha.php">Esqueci minha senha</a>
</body>
</html>
