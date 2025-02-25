<?php

namespace core;
/**
 * Classe que carrega as paginas da pasta View
 * @param string $nameView indica o nome/endereco da view que sera carregada
 * @param array|string|null $data indica os dados que a view deve receber
 */
class ConfigView
{

    public function __construct(private string $nameView, private array|string|null $data)
    {

    }

    /**
     * Metodo para renderisar/carregar a pagina. 
     * Ele verifica se o arquivo existe, caso exista carrega, caso contrario mata o processamento e retorna um erro
     */
    public function loadView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/sts/Views/Site/include/header.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/Views/Site/include/footer.php';
        } else {
            die('Ocorreu um erro por favor contacte o ' . EMAILADM);
        }
    }


    /**
     * Metodo para renderisar/carregar as paginas do Login. 
     * Ele verifica se o arquivo existe, caso exista carrega, caso contrario mata o processamento e retorna um erro
     */
    public function loadLoginView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/' . $this->nameView . '.php';
        } else {
            die('Ocorreu um erro por favor contacte o ' . EMAILADM);
        }
    }

        /**
     * Metodo para renderisar/carregar as paginas do Dashboards. 
     * Ele verifica se o arquivo existe, caso exista carrega, caso contrario mata o processamento e retorna um erro
     */
    public function loadDashboardView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/sts/Views/Dashboards/include/header.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/Views/Dashboards/include/footer.php';
        } else {
            die('Ocorreu um erro por favor contacte o ' . EMAILADM);
        }
    }

}