<?php

namespace Sts\Controllers;

class AdminAtribuirDenuncias
{
    // Define propriedades para armazenar dados
    private array|string|null $data = null; // Armazena dados vindos do banco de dados
    private array|string|null $dataForm; // Armazena dados do formulário

    // Método principal que será chamado quando a classe for instanciada
    public function index(): void
    {
        // Instancia um objeto do modelo AdmsDenuncias
        $model = new \Sts\Models\AdmsDenuncias();

        // Chama os métodos do modelo para buscar dados necessários
        $this->data = $model->tecnicoDenuncia(); // Busca dados relacionados a denúncias técnicas
        $this->data = $model->tecnicos(); // Busca dados dos técnicos
        $this->data = $model->index(); // Busca dados principais (não está claro o que este método faz)

        // Recebe os dados do formulário via POST e filtra
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verifica se o formulário foi submetido
        if (!empty($this->dataForm['AlocarDenuncia'])) {
            // Instancia um novo objeto do modelo AdmsDenuncias
            $alocarDenuncia = new \Sts\Models\AdmsDenuncias();

            $tecnicoEmail = new \Sts\Models\AdmsDenuncias();

            // Chama o método para alocar a denúncia passando os dados do formulário
            $alocarDenuncia->alocarDenuncia($this->dataForm);

            
             $tecnicoEmail->tecnicoEmail($this->dataForm);
          
             
            // Verifica se a operação foi bem-sucedida
            if ($alocarDenuncia->getResult()) {
                // Define uma mensagem de sucesso na variável de sessão
                $_SESSION['msg'] = "<p style='color:green;'>Denuncia registada com sucesso, faça REFRESH da pág.</p>";
            } else {
                // Se a operação falhar, mantém os dados do formulário e chama a visualização novamente
                $this->data['form'] = $this->dataForm;
                $this->viewFuncDen();
            }
        } else {
            // Se o formulário não foi submetido, apenas carrega a visualização
            $this->viewFuncDen();
        }
    }

    // Método privado para carregar a visualização
    private function viewFuncDen()
    {
        // Instancia um objeto para carregar a visualização passando o caminho do arquivo de visualização e os dados necessários
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-atribuir-denuncias", $this->data);
        
        // Carrega a visualização do dashboard
        $loadView->loadDashboardView();
    }
}  

