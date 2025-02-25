<?php

namespace Sts\Models;

class AdmsReadFDenuncias
{
    private array $data = [];

    public function index($email): array
    {
        $readFuncDenuncias = new \Sts\Models\helper\AdmsRead();
        $readFuncDenuncias->fullRead("SELECT td.id_denuncia AS ID, d.titulo AS DTITULO, t.nome AS DTIPO, c.gravidade AS DGRAVIDADE, m.nome AS DMUNICIPE, s.status AS DSTATUS FROM tecnico_denuncia td INNER JOIN denuncia d ON td.id_denuncia = d.id INNER JOIN tipo_denuncia t ON d.id_tipo = t.id INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id INNER JOIN municipe m ON d.id_municipe = m.id INNER JOIN status_denuncia s ON d.id_status = s.id INNER JOIN tecnico te ON td.id_tecnico = te.id WHERE te.email=:email", "email={$email}");
        $this->data['denunciasFuncDetails'] = $readFuncDenuncias->getResult();
        return $this->data;
    }

    // Método para atualizar o status da denúncia
    public function updateStatus($idDenuncia, $novoStatus): bool
    {
        $updateFuncDenuncia = new \Sts\Models\helper\AdmsUpdate();
        $updateFuncDenuncia->exeUpdate(
            "denuncia",
            ["id_status" => $novoStatus],
            "WHERE id = :id",
            "id={$idDenuncia}"
        );

        return $updateFuncDenuncia->getResult();
    }
}

