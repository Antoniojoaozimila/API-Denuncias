<?php
namespace Sts\Controllers;

class Home{
    private array $data;
    /**Metodo responsavel em encontrar a pagina Home
     *
     * @return void
     */
    public function index(){
        $this->data=[];
        $loadView= new \Core\ConfigView("sts/Views/Site/home", $this->data);
        $loadView->loadView();
    }
}