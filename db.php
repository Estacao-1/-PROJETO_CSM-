<?php
// db.php
// Ajuste as credenciais conforme seu ambiente (XAMPP: usuário root, senha vazia)
$host = 'localhost';
$dbname = 'estacao_bebidas_sabores';
$username = 'root';
$password = '';

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // Em produção, registre o erro em log e mostre uma mensagem genérica
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
