<?php

namespace Sts\Controllers;

class AdminListarFuncionario
{
    private array $data;

    public function index()
    {
        $model = new \Sts\Models\AdmsFuncionario();
        $this->data['funcionarios'] = $model->read(); 

        $loadView = new \Core\ConfigView("sts/Views/Dashboards/DashboardAdm/admin-listar-funcionario", $this->data);
        $loadView->loadDashboardView();
    }
}
