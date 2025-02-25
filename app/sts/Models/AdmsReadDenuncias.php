<?php

namespace Sts\Models;

class AdmsReadDenuncias
{
    private array $data = [];

    public function index(): array
    {
        $readDenuncias = new \Sts\Models\helper\AdmsRead();
        $readDenuncias->fullRead("SELECT t.nome AS DNOME, c.gravidade DGRAVIDADE, m.nome MNOME, s.status DSTATUS, d.titulo DTITULO FROM denuncia d INNER JOIN tipo_denuncia t ON d.id_tipo = t.id INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id INNER JOIN municipe m ON d.id_municipe = m.id INNER JOIN status_denuncia s ON d.id_status=s.id");
        $this->data['denunciasDetails'] = $readDenuncias->getResult();
        return $this->data;
    }
}

