<?php

namespace Sts\Controllers;

class Usuario
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

        // Remova esta linha, pois a carga da view deve ser feita apenas se o usuário estiver autenticado
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardUser/usuario", $this->data);
        $loadView->loadDashboardView();
    }
}
