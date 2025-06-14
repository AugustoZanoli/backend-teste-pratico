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

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../src/classes/' . strtolower($class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

$data_investimento = new DateTime('2025-06-14');

$investimento_1 = new Investimento('Ita[u', 'Titulo', 200.60, $data_investimento );

$controller = new Investimento_controller( $db );

$investimento_2 = new Investimento('Itaú','Titulo',200.60, $data_investimento );
$response = $controller->update_investimento( $investimento_2 );


echo json_encode($response);

