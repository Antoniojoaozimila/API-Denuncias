<?php

namespace Sts\Controllers;

class FuncDetalhesDenuncia
{
    /** @var array Armazena os dados */
    private array $data;
    private array|string|null $dataForm;

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
                $denunciaDetails = $denunciaModel->getDenunciaDetails($id);


                // Responsável por buscar os dados do formulário e colocá-los num array
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['alterarStatus'])) {
                    // Obtém o ID da denúncia do formulário
                    $id_denuncia = $this->dataForm['id_denuncia'] ?? null;

                    //Alterando o Status da denuncia para 2 (Em andamento depois de alocar a denuncia)
                    $model = new \Sts\Models\AdmsReadFDenuncias();
                    $model->updateStatus($id_denuncia, 2);
                    $urlRedirect = URL . "funcionario";
                    header("Location: $urlRedirect");
                }


                // Responsável por buscar os dados do formulário e colocá-los num array
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['Registarmedidas'])) {
                    // Obtém o ID da denúncia do formulário
                    $id_denuncia = $this->dataForm['id_denuncia'] ?? null;

                    // Obtém a descrição das ações tomadas do campo de texto
                    $descricao = $this->dataForm['descricao'] ?? null;

                    $denunciaModel2 = new \Sts\Models\AdmsDenuncias();
                    $denunciaModel2->TecnicoAcaoTomadas($id_denuncia, $descricao);
                }

                // Verifica se os detalhes do funcionário foram encontrados
                if (!empty($denunciaDetails)) {
                    // Passa os detalhes do funcionário para a view
                    $this->data['denunciaDetails'] = $denunciaDetails;

                    // Carrega a view para exibir os detalhes do funcionário
                    $this->viewDetalhes();
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


    private function viewDetalhes()
    {
        // Carrega a view para exibir os detalhes do funcionário
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardFunc/func-detalhes-denuncia", $this->data);
        $loadView->loadDashboardView();
    }
}
