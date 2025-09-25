<?php
require_once 'db.php';
$token = $_GET['token'] ?? '';
if ($token==='') { die('Token inválido.'); }
$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expira>NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) { die('Token inválido ou expirado.'); }
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $nova = $_POST['senha'] ?? '';
    if ($nova!=='') {
        $hash = password_hash($nova,PASSWORD_DEFAULT);
        $conn->prepare("UPDATE users SET senha=?,reset_token=NULL,reset_expira=NULL WHERE id=?")
             ->execute([$hash,$user['id']]);
        echo "Senha atualizada com sucesso! <a href='login.php'>Fazer login</a>";
        exit;
    }
}
?>
<form method="post">
  <h1>Definir nova senha</h1>
  <input type="password" name="senha" placeholder="Nova senha" required>
  <button type="submit">Atualizar senha</button>
</form>
