<?php

namespace Sts\Models;

class AdmsReadFuncionario
{
    private array $data = [];

    public function index(): array
    {
        $readFuncionario = new \Sts\Models\helper\AdmsRead();
        $readFuncionario->fullRead("SELECT nome, email, senha, imagem FROM usuarios WHERE nivel_acesso = 'funcionario'");
        $this->data['funcionarioDetails'] = $readFuncionario->getResult();
        return $this->data;
    }
}

