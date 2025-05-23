<?php

namespace requests;

use controller\UserController;

require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['name'], $data['email'], $data['color_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Dados incompletos']);
        exit;
    }

    $name = trim($data['name']);
    $email = trim($data['email']);
    $colorId = intval($data['color_id']);

    $userController = new UserController();
    $success = $userController->store($name, $email, $colorId);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Usuário adicionado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar usuário.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
