<?php

namespace requests;
use controller\ColorController;
require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $name = $data['name'];

    $colorController = new ColorController();
    $success = $colorController->update($id, $name);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Cor atualizada com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar a cor.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
