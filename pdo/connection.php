<?php
// Definindo as variáveis de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aula";

try {
    // Tentando criar uma nova instância de PDO para a conexão
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Configurando o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Se a conexão falhar, exibe a mensagem de erro
    echo "Conexão falhou: " . $e->getMessage();
}
?>
