<?php

namespace requests;

use controller\ColorController;

require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'] ?? '';

    $colorController = new ColorController();
    $lastId = $colorController->store($name);

    if ($lastId) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Cor adicionada com sucesso!',
            'id' => $lastId
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao adicionar cor.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Método não permitido.'
    ]);
}
