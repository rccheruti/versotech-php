<?php

namespace requests;
use controller\UserController;
require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];

    $userController = new UserController();
    $success = $userController->delete($id);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Usuário excluído com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir usuário.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
