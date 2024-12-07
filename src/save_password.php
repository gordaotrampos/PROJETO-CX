<?php
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // Verifica se a senha foi enviada
    if (empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Senha não pode estar vazia.']);
        exit;
    }

    // Atualiza a senha para o último CPF salvo no banco
    $sql = "UPDATE user_data SET senha = '$password' WHERE id = (SELECT MAX(id) FROM user_data)";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Senha salva com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar a senha: ' . $conn->error]);
    }

    $conn->close();
}
