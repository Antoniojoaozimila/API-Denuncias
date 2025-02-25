<?php

namespace Sts\Controllers;

class UsuListar
{
    public function index()
    {
        header("Content-Type: application/json");

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(["error" => "Usuário não autenticado"]);
            return;
        }

        $model = new \Sts\Models\AdmsReadUDenuncias();
        $data = $model->index($userId);

        if ($data) {
            http_response_code(200);
            echo json_encode(["denuncias" => $data]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Nenhuma denúncia encontrada"]);
        }
    }
}
