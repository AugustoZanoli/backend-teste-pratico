<?php
header('Content-Type: application/json');

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../src/classes/' . strtolower($class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

$investimento_1 = new Investimento('Bradesco', 'Ação', 34.60, '14/06/2025');

$response = [
    "mensagem" => "Backend PHP funcionando!",
    "status" => 200,
    "dados" => [
        $investimento_1->get_dados(),
    ]
];

echo json_encode($response);
