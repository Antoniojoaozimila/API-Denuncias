<?php

namespace Sts\Controllers;

class Admin
{
    private array|string|null $data = null;

    /**
     * Método responsável em encontrar a página Dashboard
     *
     * @return void
     */
    public function index(): void
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['user_id'])) {
            // Usuário não autenticado, redireciona para a página de login
            $urlRedirect = URL . "login/index";
            header("Location: $urlRedirect");
            exit;
        }

        // Instancia um objeto da classe AdmsDenuncias para interagir com os dados das denúncias
        $model = new \Sts\Models\AdmsDenuncias();
        
        // Chama o método index() para obter os dados das denúncias do banco de dados e armazená-los em $this->data
        $this->data = $model->index();


        // Remova esta linha, pois a carga da view deve ser feita apenas se o usuário estiver autenticado
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin", $this->data);
        $loadView->loadDashboardView();
    }

    
}
