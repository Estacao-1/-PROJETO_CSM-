<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Bem-vindo</title></head>
<body>
<h1>Bem-vindo, <?=htmlspecialchars($_SESSION['user_name'])?>!</h1>
<p><a href="logout.php">Sair</a></p>
</body>
</html>
