<?php
$request = $_SERVER['REQUEST_URI'];

// Remove qualquer base do diretório (ajuste conforme necessário)
$baseDir = '/cxcxcx/public';
$request = str_replace($baseDir, '', $request);

// Define rotas para os arquivos
$routes = [
    '/' => 'index.html',
    '/operator' => 'operator_view.php',
    '/confirm-sms' => 'confirm_sms.html',
];

// Verifica se a rota existe
if (array_key_exists($request, $routes)) {
    require $routes[$request];
} else {
    // Página de erro personalizada
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
}
