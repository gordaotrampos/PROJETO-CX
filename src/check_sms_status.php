<?php
require_once "../config/database.php";

// Obtém o CPF do usuário a partir do cookie
$username = $_COOKIE['username'] ?? null;

if (!$username) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$sql = "SELECT status FROM user_data WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status' => $row['status']]);
} else {
    echo json_encode(['status' => 'erro']);
}

$conn->close();
?>
