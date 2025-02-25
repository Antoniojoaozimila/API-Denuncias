<?php
namespace Sts\Controllers;

class UsuVisualizar{
    private array $data;
    /**Metodo responsavel em encontrar a pagina Sobre-Nos
     *
     * @return void
     */
    public function index(){
        $this->data=[];
        $loadView= new \Core\ConfigView("sts/Views/Dashboards/DashboardUser/usu-visualizar", $this->data);
        $loadView->loadDashboardView();
    }

}