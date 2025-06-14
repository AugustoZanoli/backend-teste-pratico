<?php
header('Content-Type: application/json');

$response = [
    "mensagem" => "Backend PHP funcionando!",
    "status" => 200,
    "dados" => [
        ["id" => 1, "nome" => "Augusto"],
        ["id" => 2, "nome" => "Sofia"]
    ]
];

echo json_encode($response);
