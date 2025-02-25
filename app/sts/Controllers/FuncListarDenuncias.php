<?php
namespace Sts\Controllers;

class FuncListarDenuncias{
    private array $data;
    /**Metodo responsavel em encontrar a pagina Sobre-Nos
     *
     * @return void
     */
    public function index(){
        $email = $_SESSION['user_email']; //'email' o identificador do usuário na sua sessão
        $model = new \Sts\Models\AdmsReadFDenuncias();
        $this->data = $model->index($email);

        $loadView= new \Core\ConfigView("sts/Views/Dashboards/DashboardFunc/func-listar-denuncias", $this->data);
        $loadView->loadDashboardView();
    }

}