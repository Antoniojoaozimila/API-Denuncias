<?php

namespace Sts\Models\helper;

use PDOException;
use PDO;

/**
 * Classe que faz a conexao com o banco de dados
 */
abstract class AdmsConn
{
    /**
     * 
     * @var string $host recebe o nome do host da contante Host
     */
    private string $host = HOST;
    /**
     * 
     * @var string $user recebe o nome do usuario da contante USER
     */
    private string $user = USER;
    /**
     * 
     * @var string $pass recebe o nome do password host da contante PASS
     */
    private string $pass = PASS;
    /**
     * 
     * @var string $bdname recebe o nome da base de dados da contante DBNAME
     */
    private string $dbname = DBNAME;
    /**
     * 
     * @var string $host recebe o nome do porta da contante PORT
     */
    private int|string $port = PORT;
    /**
     * 
     * @var string $connect recebe os dados em formato de objecto
     */
    private object $connect;

    /**
     * Realiza a conexao com o banco de dados, caso haja um erro, para com o processamento e apresenta a mensagem de erro.
     */

    public function connectDb(): object
    {
        try {
            //Conexao com a porta
            $this->connect = new PDO("mysql:host={$this->host}; port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;

        } catch (PDOException $err) {
            die("Erro: Por favor tente novamente.Caso o problema persista, entre em contacto com o " . EMAILADM);
        }
    }

}