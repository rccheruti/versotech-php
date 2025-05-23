<?php

namespace requests;

use controller\UserController;

require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'], $data['name'], $data['email'], $data['color_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Dados incompletos']);
        exit;
    }

    $id = intval($data['id']);
    $name = trim($data['name']);
    $email = trim($data['email']);
    $colorId = intval($data['color_id']);

    $userController = new UserController();
    $success = $userController->update($id, $name, $email, $colorId);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Usuário atualizado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar usuário.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
