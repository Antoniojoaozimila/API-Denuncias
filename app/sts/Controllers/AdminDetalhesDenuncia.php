<?php
namespace Sts\Controllers;

class AdminDetalhesDenuncia
{
    /** @var array Armazena os dados */
    private array $data;

    /**
     * Método responsável por encontrar a página Sobre-Nós
     *
     * @return void
     */
    public function index()
    {
        // Separa a URL pelos '/'
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);

        // Verifica se há partes suficientes na URL
        if (count($url_parts) >= 4) {
            // Obtém o valor do parâmetro 'id' da URL
            $id = $url_parts[3];

            // Verifica se o ID do funcionário foi fornecido
            if (!empty($id)) {
                // Instancia o modelo para obter os detalhes do funcionário com base no ID
                $denunciaModel = new \Sts\Models\AdmsDenuncias();
                $denunciaDetails = $denunciaModel->getAdminDenunciaDetails($id);

                // Verifica se os detalhes do funcionário foram encontrados
                if (!empty($denunciaDetails)) {
                    // Passa os detalhes do funcionário para a view
                    $this->data['denunciaDetails'] = $denunciaDetails;

                    // Carrega a view para exibir os detalhes do funcionário
                    $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-detalhes-denuncia", $this->data);
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
