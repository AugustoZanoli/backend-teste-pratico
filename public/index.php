<?php
header('Content-Type: application/json');

// Carregar o env para conexão do banco
require_once __DIR__ . '/../utils/load_env.php';
loadEnv(__DIR__ . '/../.env');

// Conexão com o banco
require_once __DIR__ . '/../src/connection.php';

$db = new Connection();

// Testando o controller
require_once __DIR__ . '/../src/controllers/investimento_controller.php';
require_once __DIR__ . '/../src/services/investimento_service.php';
require_once __DIR__ . '/../src/repository/investimento_repository.php';

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../src/classes/' . strtolower($class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

// Criar investimento:
$repository = new InvestimentoRepository($db);
$service = new InvestimentoService($repository);
$controller = new InvestimentoController($service);

$investimento1 = [
    'nome' => 'caixa',
    'tipo' => 'Acao',
    'valor' => 100,
    'data' => '2025-06-14',
];


$response = $controller->criar_investimento($investimento1);
echo json_encode($response);
