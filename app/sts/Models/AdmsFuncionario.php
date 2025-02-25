<?php

namespace Sts\Models;

use Sts\Models\helper\AdmsConn;
use PDO;
use PDOException;

/**
 * Realiza a conexao na view Login
 */
class AdmsFuncionario extends AdmsConn
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

    //Registar Funcionario
    public function create(array $data = null)
    {
        $this->data = $data;

        if (isset($_FILES['imagem'])) {
            // Diretório onde será salva a imagem
            $diretorio = 'app/sts/assets/adm/img/employes/';

            // Nome do arquivo original
            $nomeOriginal = $_FILES['imagem']['name'];

            // Obter a extensão do arquivo
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);

            // Gerar um nome único para a imagem usando um identificador único para o usuário
            $nomeImagemUnico = uniqid('user_' . $this->data['id_usuario'] . '_') . '.' . $extensao;

            // Movendo a imagem para o diretório
            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagemUnico);

            // Salvando o nome da imagem única na base de dados
            $this->data['imagem'] = $nomeImagemUnico;
        }


        //Instanciar o metodo quando a classe e abstrata
        $this->conn = $this->connectDb();

        $this->data['senha'] = password_hash($this->data['senha'], PASSWORD_DEFAULT);

        $query_new_user = "INSERT INTO usuarios (nome, telefone, email, senha, imagem, nivel_acesso, created_at) VALUES(:nome, :telefone, :email, :senha, :imagem, :nivel_acesso, NOW())";
        $add_new_user = $this->conn->prepare($query_new_user);
        $add_new_user->bindParam(":nome", $this->data['nome'], PDO::PARAM_STR);
        $add_new_user->bindParam(":telefone", $this->data['telefone'], PDO::PARAM_STR);
        $add_new_user->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
        $add_new_user->bindParam(":senha", $this->data['senha'], PDO::PARAM_STR);
        $add_new_user->bindParam(":imagem", $this->data['imagem'], PDO::PARAM_STR);
        $add_new_user->bindParam(":nivel_acesso", $this->data['nivel_acesso'], PDO::PARAM_STR);

        $add_new_user->execute();
        //var_dump($add_new_user);

        $id_usuario = $this->conn->lastInsertId(); // Obtém o ID do usuário inserido

        // Insere na tabela 'tecnico'
        $query_new_tecnico = "INSERT INTO tecnico (id_usuario, nome, telefone, email, senha, imagem, created_at) VALUES(:id_usuario, :nome, :telefone, :email, :senha, :imagem, NOW())";
        $add_new_tecnico = $this->conn->prepare($query_new_tecnico);
        $add_new_tecnico->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $add_new_tecnico->bindParam(":nome", $this->data['nome'], PDO::PARAM_STR);
        $add_new_tecnico->bindParam(":telefone", $this->data['telefone'], PDO::PARAM_STR);
        $add_new_tecnico->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
        $add_new_tecnico->bindParam(":senha", $this->data['senha'], PDO::PARAM_STR);
        $add_new_tecnico->bindParam(":imagem", $this->data['imagem'], PDO::PARAM_STR);

        $add_new_tecnico->execute();


        if ($add_new_user->rowCount()) {
            $_SESSION['msg'] = "<p style='color:green;'>Funcionário cadastrado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro:Funcionário não cadastrado!</p>";
            $this->result = false;
        }
    }

    //Listar Funcionario
    public function read(): array
    {
        $readFuncionario = new \Sts\Models\helper\AdmsRead();
        $readFuncionario->fullRead("SELECT id, nome, email, imagem FROM usuarios WHERE nivel_acesso = 'funcionario'");
        $this->data['funcionarioDetails'] = $readFuncionario->getResult();

        // Adiciona o ID de cada funcionário ao array de detalhes do funcionário
        foreach ($this->data['funcionarioDetails'] as $key => $funcionario) {
            $this->data['funcionarioDetails'][$key]['id'] = $funcionario['id'];
        }

        return $this->data;
    }

    // Método para obter os detalhes de um funcionário com base no ID
    public function getFuncionarioDetails($id)
    {
        $readDetailsFuncionario = new \Sts\Models\helper\AdmsRead();
        $readDetailsFuncionario->fullRead("SELECT nome,telefone, email,senha, imagem FROM usuarios WHERE id = :id", "id={$id}");
        $this->data['detailsFuncionario'] = $readDetailsFuncionario->getResult();

        return $this->data;
    }

    // Método para atualizar os dados do funcionário
    public function update($id, array $data)
    {
        $updateHelper = new \Sts\Models\helper\AdmsUpdate();
        $terms = "WHERE id = :id"; // Condição para atualizar o registro específico
        $parseString = "id={$id}"; // Parâmetros para o SQL
        $updateHelper->exeUpdate("usuarios", $data, $terms, $parseString);

        // Obtém o resultado da atualização
        $this->result = $updateHelper->getResult();
    }


    //Remover funcionario
    public function delete($id)
    {
        $this->conn = $this->connectDb();

        if (!empty($id)) { // Verifica se o ID não está vazio
            try {
                $this->conn->beginTransaction();

                // Excluir registro da tabela 'usuarios'
                $query_delete_usuario = "DELETE FROM usuarios WHERE id = :id";
                $delete_usuario = $this->conn->prepare($query_delete_usuario);
                $delete_usuario->bindParam(":id", $id, PDO::PARAM_INT);
                $delete_usuario->execute();

                // Excluir registro da tabela 'tecnico'
                $query_delete_tecnico = "DELETE FROM tecnico WHERE id_usuario = :id";
                $delete_tecnico = $this->conn->prepare($query_delete_tecnico);
                $delete_tecnico->bindParam(":id", $id, PDO::PARAM_INT);
                $delete_tecnico->execute();

                $this->conn->commit();
                $_SESSION['msg'] = "<p style='color:green;'>Registros removidos com sucesso!</p>";
                $this->result = true;
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: " . $e->getMessage() . "</p>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: ID inválido!</p>";
            $this->result = false;
        }
    }
}
