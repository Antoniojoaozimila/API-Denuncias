<?php

namespace Sts\Controllers;

use Firebase\JWT\JWT;
use Sts\Models\AdmsLogin;

class Login
{
    private array|null $dataForm;

    public function index()
    {
        header("Content-Type: application/json");

        $this->dataForm = json_decode(file_get_contents("php://input"), true);

        if (!$this->validateInput()) {
            $this->sendResponse(400, ["error" => "Dados inválidos ou incompletos"]);
        }

        $valLogin = new AdmsLogin();
        $isAuthenticated = $valLogin->login($this->dataForm);

        if ($isAuthenticated) {
            $nivelAcesso = $valLogin->getNivelAcesso();
            $token = $this->generateJWT($this->dataForm['email'], $nivelAcesso);
            $this->sendResponse(200, [
                "success" => "Login efetuado com sucesso!",
                "nivelAcesso" => $nivelAcesso,
                "token" => $token
            ]);
        } else {
            $this->sendResponse(401, ["error" => "E-mail ou senha incorretos"]);
        }
    }

    private function validateInput(): bool
    {
        if (empty($this->dataForm['email']) || empty($this->dataForm['password'])) {
            return false;
        }

        $email = filter_var($this->dataForm['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->sendResponse(400, ["error" => "E-mail inválido"]);
        }

        return true;
    }

    private function generateJWT(string $email, string $nivelAcesso): string
    {
        $key = "secreta"; // Idealmente, armazene essa chave em variáveis de ambiente
        $payload = [
            "email" => $email,
            "nivelAcesso" => $nivelAcesso,
            "exp" => time() + 3600 // Expiração em 1 hora
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    private function sendResponse(int $statusCode, array $data)
    {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
