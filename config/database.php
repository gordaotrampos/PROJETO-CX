<?php
$servername = "localhost";
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "han"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
