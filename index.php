<?php
//Carregar a sessao
session_start();

//Carregar o composer
require './vendor/autoload.php';

//Instancia a classe ConfigController, que e responsavel em tratar as URL'S
$url = new Core\ConfigController();

//Instancia o metodo para carregar as paginas
$url->loadPage();

    
