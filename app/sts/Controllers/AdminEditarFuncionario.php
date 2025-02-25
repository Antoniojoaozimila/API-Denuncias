<?php
namespace Sts\Controllers;

class AdminEditarFuncionario
{
    private array|string|null $data = [];

    public function index()
    {
        // Separa a URL pelos '/'
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);

        // Verifica se há partes suficientes na URL
        if (count($url_parts) >= 5) {
            // Obtém o valor do parâmetro 'id' da URL
            $id = $url_parts[4];

            // Verifica se o ID do funcionário foi fornecido
            if (!empty($id)) {
                // Verifica se é uma requisição POST e se o botão de atualizar foi acionado
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AtualizarFunc'])) {
                    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

                    // Instancia o modelo para atualizar os dados do funcionário
                    $funcionarioModel = new \Sts\Models\AdmsFuncionario();
                    $funcionarioModel->update($id, [
                        'nome' => $nome,
                        'telefone' => $telefone,
                        'email' => $email,
                        'senha' => $senha // Note que a senha já está sendo criptografada no método update do modelo
                    ]);

                    // Redireciona para a página de edição do funcionário com uma mensagem de sucesso
                    header("Location: " . URL . "admin-listar-funcionario/index");
                    exit();
                }

                // Instancia o modelo para obter os detalhes do funcionário com base no ID
                $funcionarioModel = new \Sts\Models\AdmsFuncionario();
                $funcionarioDetails = $funcionarioModel->getFuncionarioDetails($id);

                // Verifica se os detalhes do funcionário foram encontrados
                if (!empty($funcionarioDetails['detailsFuncionario'])) {
                    // Passa os detalhes do funcionário para a view
                    $this->data['detailsFuncionario'] = $funcionarioDetails['detailsFuncionario'];

                    // Carrega a view para exibir os dados do funcionário
                    $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-editar-funcionario", $this->data);
                    $loadView->loadDashboardView();
                } else {
                    // Se não foram encontrados detalhes do funcionário, exibe uma mensagem de erro
                    echo "Dados do funcionário não encontrados.";
                }
            } else {
                // Se o ID do funcionário não foi fornecido, exibe uma mensagem de erro
                echo "ID do funcionário não fornecido.";
            }
        } else {
            echo "ID do funcionário não fornecido na URL.";
        }
    }
}
