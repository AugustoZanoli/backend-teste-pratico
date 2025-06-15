<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header('Content-Type: application/json');

require_once __DIR__ . '/../utils/load_env.php';
loadEnv(__DIR__ . '/../.env');

require_once __DIR__ . '/../src/connection.php';
require_once __DIR__ . '/../src/repository/investimento_repository.php';
require_once __DIR__ . '/../src/services/investimento_service.php';
require_once __DIR__ . '/../src/controllers/investimento_controller.php';
require_once __DIR__ . '/../src/classes/investimento.php';

// Instancia banco, repository, service e controller
$db = new Connection();
$repository = new InvestimentoRepository($db);
$service = new InvestimentoService($repository);
$controller = new InvestimentoController($service);

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

$basePath = '/backend/public';
$route = substr($path, strlen($basePath));

switch ($route) {
    case '/api/investimentos':
        // Listar investimentos
        if ($method === 'GET') {
            $response = $controller->listar_investimentos();
            echo json_encode($response);
        }

        // Inserir novo investimento
        elseif ($method === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            if ($input === null) {
                http_response_code(400);
                echo json_encode(['error' => 'Corpo inválido ou vazio']);
                exit;
            }
            $response = $controller->criar_investimento($input);
            echo json_encode($response);
        }

        // Atualizar investimento
        elseif ($method === 'PUT') {
            $input = json_decode(file_get_contents('php://input'), true);
            if ($input === null || !isset($input['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Corpo inválido ou vazio']);
                exit;
            }
            $response = $controller->atualizar_investimento($input);
            echo json_encode($response);
        }

        // Deletar um investimento
        elseif ($method === 'DELETE') {
            http_response_code(400);
            echo json_encode(['error' => 'Corpo inválido ou vazio']);
            exit;
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}
