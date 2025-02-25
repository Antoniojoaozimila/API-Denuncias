<?php

namespace Sts\Controllers;

class Logout
{
    public function index()
    {
        // session_start();
        // session_unset();
        session_destroy();

        header("Content-Type: application/json");
        echo json_encode(["success" => "Logout realizado com sucesso"]);
        exit;
    }
}
