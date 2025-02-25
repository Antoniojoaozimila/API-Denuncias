<?php

namespace Sts\Models;

use Sts\Models\helper\AdmsConn;
use PDO;

class AdmsLogin extends AdmsConn
{
    private array|string|null $data;
    private object $conn;
    private array|false $resultBd;
    private bool $result = false;
    private string $nivelAcesso = "";
    private string $userId;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getNivelAcesso(): string
    {
       return $this->nivelAcesso;
    }

    public function login(array $data): bool
    {
        $this->data = $data;
        $this->conn = $this->connectDb();

        // Consulta no banco de dados
        $query_val_login = "SELECT id, nome, email, senha, nivel_acesso FROM usuarios WHERE email=:email LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':email', $this->data['email'], PDO::PARAM_STR);
        $result_val_login->execute();

        $this->resultBd = $result_val_login->fetch(PDO::FETCH_ASSOC);

        if ($this->resultBd && $this->valPassword()) {
            return true;
        }

        return false;
    }

    private function valPassword(): bool
    {
        if (password_verify($this->data['password'], $this->resultBd['senha'])) {
            $this->nivelAcesso = $this->resultBd['nivel_acesso'] ?? "";
            $this->userId = $this->resultBd['id'];
            return true;
        }
        
        return false;
    }
}
