<?php
session_start();
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id FROM user_data WHERE username = '$username' AND senha = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Configura o ID do usuário na sessão
        header("Location: user_next.html"); // Redireciona após login
        exit;
    } else {
        echo "Login inválido.";
    }
}
?>
