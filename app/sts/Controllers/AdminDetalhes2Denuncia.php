<?php
namespace Sts\Controllers;

class AdminDetalhes2Denuncia
{
    /** @var array Armazena os dados */
    private array|string|null $data = null; // Armazena dados vindos do banco de dados
    private array|string|null $dataForm; // Armazena dados do formulário

    /**
     * Método responsável por encontrar a página Sobre-Nós
     *
     * @return void
     */
    public function index()
    {
        // Recebe os dados do formulário via POST e filtra
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verifica se o formulário foi submetido
        if (!empty($this->dataForm['AlocarDenuncia'])) {
            // Instancia um novo objeto do modelo AdmsDenuncias
            $alocarDenuncia = new \Sts\Models\AdmsDenuncias();
            $tecnicoEmail = new \Sts\Models\AdmsDenuncias();

            // Chama o método para alocar a denúncia passando os dados do formulário
            $alocarDenuncia->alocarDenuncia($this->dataForm);
            // Envia Email para o funcionario 
            $tecnicoEmail->tecnicoEmail($this->dataForm);
            $urlRedirect = URL . "admin";
            header("Location: $urlRedirect");
        
            // Verifica se a operação foi bem-sucedida
            if ($alocarDenuncia->getResult()) {
               
                exit(); // Adiciona exit após o header para garantir que a execução seja interrompida

            } else {
                // Se a operação falhar, mantém os dados do formulário e chama a visualização novamente
                $this->data['form'] = $this->dataForm;
            }
        }

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
                $this->data = $denunciaModel->tecnicos(); // Busca dados dos técnicos

                // Verifica se os detalhes do funcionário foram encontrados
                if (!empty($denunciaDetails)) {
                    // Passa os detalhes do funcionário para a view
                    $this->data['denunciaDetails'] = $denunciaDetails;
                    // Carrega a view para exibir os detalhes do funcionário
                    $this->viewFuncDen();
                } else {
                    // Se não foram encontrados detalhes do funcionário, define mensagem de erro
                    $_SESSION['msg'] = "<p style='color:red;'>Detalhes do funcionário não encontrados.</p>";
                }
            } else {
                // Se o ID do funcionário não foi fornecido, define mensagem de erro
                $_SESSION['msg'] = "<p style='color:red;'>ID do funcionário não fornecido.</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>ID do funcionário não fornecido na URL.</p>";
        }
    }

    // Método privado para carregar a visualização
    private function viewFuncDen()
    {
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-detalhes2-denuncia", $this->data);
        $loadView->loadDashboardView();
    }
}
