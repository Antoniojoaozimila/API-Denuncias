<?php

namespace Sts\Models;

use Sts\Models\helper\AdmsConn;

class AdmsCreateFuncionario extends AdmsConn
{
    private array $data;
    public function create(array $data)
    {
        // Validação dos dados
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            $_SESSION['msg'] = "<p class='alert-danger'>Por favor, preencha todos os campos obrigatórios.</p>";
            return false;
        }
        
        // Hash de senha
        $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

        // Código de upload de imagem (se necessário)

        // Instanciando a classe AdmsCreate para criar o funcionário
        $createFuncionario = new \Sts\Models\helper\AdmsCreate();
        return $createFuncionario->exeCreate("usuarios", $data);
    }
}
