<?php
// Roteador
$request = trim($_SERVER['REQUEST_URI'], '/');

// Remova a base do diretório, se necessário
$baseDir = 'cxcxcx/public';
$request = str_replace($baseDir, '', $request);

// Defina as rotas
$routes = [
    '' => 'index.html',             // Página inicial
    'operator' => 'operator_view.php',  // Painel do operador
    'confirm-sms' => 'confirm_sms.html', // Página de confirmação SMS
];

if (array_key_exists($request, $routes)) {
    require $routes[$request];
} else {
    http_response_code(404);
    echo '<h1>404 - Página não encontrada</h1>';
}
