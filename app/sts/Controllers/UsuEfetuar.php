<?php

namespace Sts\Controllers;

class UsuEfetuar
{
    public function index()
    {
        header("Content-Type: application/json");

        $dataForm = json_decode(file_get_contents("php://input"), true);
        if (!$dataForm) {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
            return;
        }

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(["error" => "Usuário não autenticado"]);
            return;
        }

        $model = new \Sts\Models\AdmsDenuncias();
        $idMunicipe = $model->recuperarId($userId);

        if (!$idMunicipe) {
            http_response_code(404);
            echo json_encode(["error" => "Munícipe não encontrado"]);
            return;
        }

        $result = $model->registarDenuncia($dataForm, $idMunicipe);

        if ($result) {
            http_response_code(201);
            echo json_encode(["success" => "Denúncia efetuada com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao registrar denúncia"]);
        }
    }
}
