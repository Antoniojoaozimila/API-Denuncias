<?php

namespace Sts\Models;

use Sts\Models\helper\AdmsConn;
use PDO;

/**
 * Realiza a conexao na view Login
 */
class AdmsNewUser extends AdmsConn
{
    /**
     * variavel que recebe os dados da view
     */
    private array|string|null $data;
    /**
     * Variavel que recebe a conexao
     */
    private object $conn;
    /**
     * Variavel que retorna os dados da pesquisa
     */
    private $resultBd;
    private $result;

    function getResult()
    {
        return $this->result;
    }

    public function create(array $data = null)
    {
        $this->data = $data;
        //var_dump($this->data);

        //Instanciar o metodo quando a classe e abstrata
        $this->conn = $this->connectDb();

        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

        $query_new_user = "INSERT INTO usuarios (nome, telefone, email, senha, created_at) VALUES(:name, :telefone, :email, :password, NOW())";
        $add_new_user = $this->conn->prepare($query_new_user);
        $add_new_user->bindParam(":name", $this->data['name'], PDO::PARAM_STR);
        $add_new_user->bindParam(":telefone", $this->data['telefone'], PDO::PARAM_STR);
        $add_new_user->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
        $add_new_user->bindParam(":password", $this->data['password'], PDO::PARAM_STR);

        $add_new_user->execute();

        $id_usuario = $this->conn->lastInsertId(); // Obtém o ID do usuário inserido

        // Insere na tabela 'municipe'
        $query_new_municipe = "INSERT INTO municipe (id_usuario, nome, telefone, email, created_at) VALUES(:id_usuario, :nome, :telefone, :email, NOW())";
        $add_new_municipe = $this->conn->prepare($query_new_municipe);
        $add_new_municipe->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $add_new_municipe->bindParam(":nome", $this->data['name'], PDO::PARAM_STR);
        $add_new_municipe->bindParam(":telefone", $this->data['telefone'], PDO::PARAM_STR);
        $add_new_municipe->bindParam(":email", $this->data['email'], PDO::PARAM_STR);

        $add_new_municipe->execute();


        if ($add_new_user->rowCount()) {
            $_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro:Usuário não cadastrado!</p>";
            $this->result = false;
        }
    }
}
