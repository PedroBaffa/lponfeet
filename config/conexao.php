<?php
// config/conexao.php

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'lp_on_feet';

try {
    // Tenta criar a conexão usando PDO (é mais seguro e moderno)
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    
    // Configura para o PHP nos avisar se houver erro no banco
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Se der erro, mostra uma mensagem amigável (e o erro técnico para ti)
    die("Erro na conexão: " . $e->getMessage());
}
?>