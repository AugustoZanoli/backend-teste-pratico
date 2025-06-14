<?php
header('Content-Type: application/json');

// Carregar o env para conexão do banco
require_once __DIR__ . '/../utils/load_env.php';
loadEnv(__DIR__ . '/../.env');


// -------- Teste de funcionamento da classe Investimento: (OK)

// spl_autoload_register(function ($class) {
//     $path = __DIR__ . '/../src/classes/' . strtolower($class) . '.php';
//     if (file_exists($path)) {
//         require_once $path;
//     }
// });

// $data_investimento = new DateTime('2025-06-14');

// $investimento_1 = new Investimento('Bradesco', 'Acao', 34.60, $data_investimento );

// $response = [
//     "mensagem" => "Backend PHP funcionando!",
//     "status" => 200,
//     "dados" => [
//         $investimento_1->get_dados(),
//     ]
// ];


// echo json_encode($response);

// -------- Teste de funcionamento da classe Connection: (OK)
require_once __DIR__ . '/../src/connection.php';

$db = new Connection();
$conn = $db->connect();

if($conn) {
    echo json_encode([
        "status" => 200,
        "mensagem" => "Conexão com o banco bem-sucedida!"
    ]);
} else {
    echo json_encode([
        "status" => 500,
        "mensagem" => "Erro na conexão com o banco."
    ]);
}
