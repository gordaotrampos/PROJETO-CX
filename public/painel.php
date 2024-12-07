<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: index.php");
    exit;
}

require_once "../config/database.php";

$sql = "SELECT * FROM user_data ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Painel Administrativo</h1>
    <a href="logout.php">Sair</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Tipo</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['tipo']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum dado encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>
