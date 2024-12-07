<?php
session_start();
session_destroy();
header("Location: ../public/operator_login.html");
exit;
?>
