<?php
require_once "../config/database.php";

$sql = "SELECT id, username, tipo, senha, sms_code, status, created_at FROM user_data ORDER BY created_at DESC";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$conn->close();
?>
