<?php
require_once __DIR__ . '/../src/repository/investimento_repository.php';
require_once __DIR__ . '/../src/services/investimento_service.php';
require_once __DIR__ . '/../src/controllers/investimento_controller.php';
require_once __DIR__ . '/../src/classes/investimento.php';

$db = new Connection();
$repository = new InvestimentoRepository($db);
$service = new InvestimentoService($repository);
$controller = new InvestimentoController($service);

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$basePath = '/backend/public';
$route = substr($path, strlen($basePath));

// DELETE (RESTful) - Deletar um investimento do banco
if (preg_match('#^/api/investimentos/(\d+)$#', $route, $matches)) {
    $id = intval($matches[1]);

    if ($method === 'DELETE') {
        echo json_encode($controller->deletar_investimento($id));
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
    }
    exit;
}

if ($route === '/api/investimentos') {
    switch ($method) {
        // GET - Listar todos os investimentos
        case 'GET':
            echo json_encode($controller->listar_investimentos());
            break;

        // POST - Inserir um novo investimento
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            if (!$input) {
                http_response_code(400);
                echo json_encode(['error' => 'Corpo inválido ou vazio']);
                exit;
            }
            echo json_encode($controller->criar_investimento($input));
            break;

        // PUT - Atualizar um investimento existente
        case 'PUT':
            $input = json_decode(file_get_contents('php://input'), true);
            if (!$input || !isset($input['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Corpo inválido ou id ausente']);
                exit;
            }
            echo json_encode($controller->atualizar_investimento($input));
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            break;
    }
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Rota não encontrada']);
