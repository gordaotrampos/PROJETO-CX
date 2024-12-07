<?php
session_start();
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Senha criptografada

    $sql = "SELECT * FROM operator_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['operator_logged_in'] = true; // Define sessão
        header("Location: ../public/operator_view.php");
        exit;
    } else {
        echo "<script>alert('Usuário ou senha incorretos!'); window.location.href = '../public/operator_login.html';</script>";
    }
}
?>
