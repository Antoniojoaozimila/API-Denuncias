<?php

namespace Core;

abstract class Config{
    public function config(): void{
        //URL do projecto
        define('URL', 'http://135.181.249.37/ProjectoFinal-Curso/');
        define('URLADM', 'http://localhost/ProjectoFinal-Curso/adm/');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        //Credenciais do banco de dados
        define('HOST', '135.181.249.37');
        define('USER', 'root');
        define('PASS', 'Maputo2023@#');
        define('DBNAME', 'projectofinal-curso');
        define('PORT', 3306);

        //Email de suport
        define('EMAILADM', 'antoniojoaozimila@gmail.com');
    }
}
 