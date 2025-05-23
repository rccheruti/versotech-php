<?php

namespace requests;


header('Content-Type: application/json');

use controller\ColorController;

require_once __DIR__ . '/../controller/ColorController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);


    $name = isset($data['name']) ? trim($data['name']) : '';

    if (!empty($name)) {
        $colorController = new ColorController();
        $success = $colorController->store($name);

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Cor adicionada com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar a cor.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'O nome da cor é obrigatório.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
