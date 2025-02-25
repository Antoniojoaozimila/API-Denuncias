<?php

namespace Sts\Controllers;

class AdminRegistarFuncionario
{
    // Declaração das propriedades da classe
    private array|string|null $data = null; // Declaração de uma propriedade privada chamada $data
    private array|string|null $dataForm; // Declaração de uma propriedade privada chamada $dataForm

    // Método index
    public function index(): void
    {
        // Responsável por buscar os dados do formulário e colocá-los em um array
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
        
        // Verifica se o campo 'RegistarFunc' não está vazio no formulário enviado
        if(!empty($this->dataForm['RegistarFunc'])){
            // Cria uma nova instância da classe AdmsFuncionario
            $createFuncionario = new \Sts\Models\AdmsFuncionario();
            
            // Chama o método create do objeto $createFuncionario, passando os dados do formulário
            $createFuncionario->create($this->dataForm);
            $urlRedirect = URL . "admin-listar-funcionario";
            header("Location: $urlRedirect");
            // Verifica se o resultado da criação do funcionário foi bem sucedido
            if($createFuncionario->getResult()){
                // Redireciona para a página de listar funcionários em caso de sucesso
                
            }else{
                // Se houver falha, armazena os dados do formulário em $this->data['form'] e chama o método viewNewFunc()
                $this->data['form'] = $this->dataForm;
                $this->viewNewFunc();
            }
        }else{
            // Se o campo 'RegistarFunc' estiver vazio, chama o método viewNewFunc()
            $this->viewNewFunc();
        }
    }

    // Método responsável por carregar a view do novo funcionário
    private function viewNewFunc(){
        // Instancia um objeto ConfigView, passando o caminho da view e os dados
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-resgistar-funcionario", $this->data);
        
        // Carrega a view do dashboard
        $loadView->loadDashboardView();
    }
}
