<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Sessão não configurada.";
} else {
    echo "ID do usuário: " . $_SESSION['user_id'];
}
?>
