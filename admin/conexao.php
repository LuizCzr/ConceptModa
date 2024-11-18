<?php
$host = 'localhost'; // Nome do host do banco de dados
$dbname = 'conceptmoda'; // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

try {
    // Cria a conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}

?>
