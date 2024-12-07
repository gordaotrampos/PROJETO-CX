<?php
session_start();
require_once "../config/database.php";

error_log("Sessão: " . print_r($_SESSION, true)); // Log para depuração

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'unauthorized']);
    exit;
}

$userId = intval($_SESSION['user_id']);
$sql = "SELECT status FROM user_data WHERE id = $userId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status' => $row['status']]);
} else {
    echo json_encode(['status' => 'not_found']);
}
exit;
?>
