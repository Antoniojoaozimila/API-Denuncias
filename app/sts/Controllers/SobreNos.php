<?php
namespace Sts\Controllers;

class SobreNos{
    private array $data;
    /**Metodo responsavel em encontrar a pagina Sobre-Nos
     *
     * @return void
     */
    public function index(){
        $this->data=[];
        $loadView= new \Core\ConfigView("sts/Views/Site/sobre-nos", $this->data);
        $loadView->loadView();
    }

}