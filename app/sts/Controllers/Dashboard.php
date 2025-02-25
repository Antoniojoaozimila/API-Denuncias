<?php

namespace Sts\Controllers;

class Dashboard
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

        // Usuário autenticado, continua com o código da página de dashboard
      //  echo "Página de Dashboard";

        // Remova esta linha, pois a carga da view deve ser feita apenas se o usuário estiver autenticado
        $loadView = new \Core\ConfigView("sts/Views/DashboardUser/dashboard", $this->data);
        $loadView->loadLoginView();
    }
}
