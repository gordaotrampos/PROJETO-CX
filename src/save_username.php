<?php
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $tipo = $_POST['tipo'];

    // Verifica se o CPF foi enviado
    if (empty($username)) {
        echo "<script>alert('CPF não pode estar vazio!'); window.location.href = '../public/index.html';</script>";
        exit;
    }

    // Insere o CPF no banco de dados
    $sql = "INSERT INTO user_data (username, tipo, status) VALUES ('$username', '$tipo', 'aguardando_senha')";
    if ($conn->query($sql) === TRUE) {
        // Configura o cookie
        setcookie('username', $username, time() + 3600, "/"); // Expira em 1 hora
        echo "<script>window.location.href = '../public/user_next.html';</script>";
    } else {
        echo "<script>alert('Erro ao salvar CPF: {$conn->error}'); window.location.href = '../public/index.html';</script>";
    }

    $conn->close();
}
?>
