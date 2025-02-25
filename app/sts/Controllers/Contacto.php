<?php
namespace Sts\Controllers;

class Contacto{
    private array |string|null $data;
    /**Metodo responsavel em encontrar a pagina Contacto
     *
     * @return void
     */
    public function index(){
        $this->data=null;
        $loadView= new \Core\ConfigView("sts/Views/Site/contacto", $this->data);
        $loadView->loadView();
    }

}