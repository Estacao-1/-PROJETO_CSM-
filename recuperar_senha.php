<?php
require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $email = trim($_POST['email'] ?? '');
    if ($email !== '') {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $token = bin2hex(random_bytes(16));
            $expira = date("Y-m-d H:i:s", strtotime("+15 minutes"));
            $conn->prepare("UPDATE users SET reset_token=?, reset_expira=? WHERE id=?")
                 ->execute([$token, $expira, $user['id']]);
            $link = "resetar_senha.php?token=$token";
            $msg = "Link para redefinir senha: <a href='$link'>$link</a>";
        } else {
            $msg = "Email não encontrado.";
        }
    }
}
?>
<form method="post">
  <h1>Recuperar senha</h1>
  <input type="email" name="email" placeholder="Seu email" required>
  <button type="submit">Enviar link</button>
</form>
<?= $msg ?>
