<?php

namespace Core;
/**
 * Classe que recebe e manipula as URL'S
 * Carrega as controllers das paginas
 */
class ConfigController extends Config{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlParameter;
    private string $urlSlugController;
    private array $format;

    public function __construct()
    {
        $this->config();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
           // var_dump($this->url);

            $this->clearUrl();

            $this->urlArray = explode("/", $this->url);
           // var_dump($this->urlArray);

            if (isset($this->urlArray[0])) {
               // var_dump($this->urlArray[0]);
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }

        } else {
            $this->urlController = $this->slugController(CONTROLLER);
        }

        //echo "Controller: {$this->urlController}<br>";
    }
    /**
     * Funcao que trata e limpa a URL quando sao introduzidos caracteres especiais
     *
     * @return void
     */
    private function clearUrl()
    {
        //Eliminar as tags na URL
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco na URL
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        //Eliminar caracteres especiais na URL
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);

    }

    /**
     * Funcao que trata a URL 
     *
     * @param [type] $slugController
     * @return void
     */
    private function slugController($slugController)
    {
        //Converter para minusculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar espaco em branco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }

    public function loadPage()
    {
        $classLoad = "\\Sts\\Controllers\\" . $this->urlController;
        $classPage = new $classLoad();
        $classPage->index();
    }
}