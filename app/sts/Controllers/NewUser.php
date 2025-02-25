<?php
namespace Sts\Controllers;

class NewUser
{
    /**
     * $data recebe os dados que devem ser enviados para a View
     */
    private array|string|null $data = [];
    /**
     * $dataForm recebe os dados do formulario
     */
    private array|string|null $dataForm;
    /**Metodo responsavel em encontrar a pagina Login
     *
     * @return void
     */
    public function index():void
    {
        //Responsavel em buscar os dados do formulario e colocar num array
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

        if (!empty($this->dataForm['SendNewUser'])) {
            //var_dump($this->dataForm);
            $createNewUser = new \Sts\Models\AdmsNewUser();
            $createNewUser->create($this->dataForm);
            //var_dump($this->data);
            if ($createNewUser->getResult()) {
                $urlRedirect = URL . "login";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }
        } else{
            $this->viewNewUser();
        }
    }

    private function viewNewUser():void{
        $loadView = new \Core\ConfigView("sts/Views/Site/new-user", $this->data);
        $loadView->loadLoginView();
    }
}