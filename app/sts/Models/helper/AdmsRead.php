<?php

namespace Sts\Models\helper;

use PDOException;
use PDO;

class AdmsRead extends AdmsConn
{
    private string $select;
    private array $values = [];
    private array|null $result = [];
    private object $query;
    private object $conn;

    /**
     * Retorna o resultado da consulta na base de dados
     *
     * @return array|null
     */
    function getResult(): array|null
    {
        return $this->result;
    }
    /**
     * Funcao que prepara as querys  
     *
     * @param string $table
     * @param [type] $terms
     * @param [type] $parseString
     * @return void
     */
    public function exeRead(string $table, string | null $terms = null, string | null $parseString = null)
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            var_dump($this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        $this->exeInstrution();
    }

    /**
     * Metodo para fazer a leitura filtrada na base de dados
     */
    public function fullRead(string $query, string|null $parseString = null)
    {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->exeInstrution();
    }

    /**
     * Funcao que executa a query no banco de dados
     */
    private function exeInstrution()
    {
        $this->connection();
        try {
            $this->exeParameter();
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }

    /**
     * Funcao que faz a conexao com o banco de dados
     */
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Metodo para subistituir os parametros na query
     */
    private function exeParameter()
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if (($link == 'limit') || ($link == 'offset')) {
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
