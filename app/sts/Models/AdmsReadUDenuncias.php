<?php

namespace Sts\Models;

class AdmsReadUDenuncias
{
    private array $data = [];

    public function index($userId): array
    {
        $readUserDenuncias = new \Sts\Models\helper\AdmsRead();

        $readUserDenuncias->fullRead("SELECT d.id AS ID, t.nome AS DTIPO, c.gravidade DGRAVIDADE, m.nome MNOME, s.status DSTATUS, d.titulo DTITULO FROM denuncia d INNER JOIN tipo_denuncia t ON d.id_tipo = t.id INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id INNER JOIN municipe m ON d.id_municipe = m.id INNER JOIN status_denuncia s ON d.id_status=s.id WHERE m.id_usuario = :userId", "userId={$userId}");
        $this->data['denunciasUserDetails'] = $readUserDenuncias->getResult();
        return $this->data;
    }

    // Método para listar os detalhes da Denuncia com base no ID
    public function getDenunciaDetails($id)
    {
        $readDenuncias = new \Sts\Models\helper\AdmsRead();
        $readDenuncias->fullRead(
            "SELECT 
            d.id AS ID, 
            t.nome AS DTIPO, 
            c.gravidade AS DGRAVIDADE, 
            m.nome AS MNOME, 
            s.status AS DSTATUS, 
            d.titulo AS DTITULO, 
            d.descricao AS DDESCRICAO, 
            d.localizacao AS DLOCALIZACAO, 
            d.latitude AS DLATITUDE, 
            d.longitude AS DLONGITUDE 
        FROM 
            denuncia d 
        INNER JOIN 
            tipo_denuncia t ON d.id_tipo = t.id 
        INNER JOIN 
            classificacao_denuncia c ON d.id_classificacao = c.id 
        INNER JOIN 
            municipe m ON d.id_municipe = m.id 
        INNER JOIN 
            status_denuncia s ON d.id_status = s.id 
        WHERE 
            d.id = :id",
            "id={$id}"
        );
        // Retorna apenas o resultado da consulta
        return $readDenuncias->getResult();
    }
}
