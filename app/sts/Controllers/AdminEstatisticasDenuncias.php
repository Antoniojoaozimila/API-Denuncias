<?php

namespace Sts\Controllers;

class AdminEstatisticasDenuncias
{
    // Propriedade privada $data para armazenar os dados
    private array $data;

    // Método index para carregar a página de listagem de denúncias
    public function index()
    {
        // Instancia um objeto da classe AdmsDenuncias para interagir com os dados das denúncias
        $model = new \Sts\Models\AdmsDenuncias();

        //efectua as estatisticas
        $model->estatisticasTec();

        // Chama o método index() para obter os dados das denúncias do banco de dados e armazená-los em $this->data
        $this->data = $model->getAllTecnicos();
        // Instancia um objeto da classe ConfigView para carregar a view correspondente com os dados necessários
        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-estatisticas-denuncias", $this->data);

        // Chama o método loadDashboardView() para carregar a view com o layout do dashboard
        $loadView->loadDashboardView();
    }
}
