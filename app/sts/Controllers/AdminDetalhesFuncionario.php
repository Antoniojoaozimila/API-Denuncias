<?php
namespace Sts\Controllers;

class AdminDetalhesFuncionario
{
    private array $data;

    /**
     * Método responsável por exibir os detalhes de um funcionário específico
     *
     * @param int $id O ID do funcionário
     * @return void
     */
    public function index()
    {
        // Separa a URL pelos '/'
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);

        // Verifica se há partes suficientes na URL
        if (count($url_parts) >= 5) {
            // Obtém o valor do parâmetro 'id' da URL
            $id = $url_parts[4];

            // Verifica se o ID do funcionário foi fornecido
            if (!empty ($id)) {
                // Instancia o modelo para obter os detalhes do funcionário com base no ID
                $funcionarioModel = new \Sts\Models\AdmsFuncionario();
                $funcionarioDetails = $funcionarioModel->getFuncionarioDetails($id);

                // Verifica se os detalhes do funcionário foram encontrados
                if (!empty ($funcionarioDetails['detailsFuncionario'])) {
                    // Passa os detalhes do funcionário para a view
                    $this->data['detailsFuncionario'] = $funcionarioDetails['detailsFuncionario'];

                    // Carrega a view para exibir os detalhes do funcionário
                    $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-detalhes-funcionario", $this->data);
                    $loadView->loadDashboardView();
                } else {
                    // Se não foram encontrados detalhes do funcionário, exibe uma mensagem de erro
                    echo "Detalhes do funcionário não encontrados.";
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
