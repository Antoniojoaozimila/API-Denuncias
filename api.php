<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require './vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Definir controlador com base na URL
$controller = $request[1] ?? 'home';
$action = $request[2] ?? 'index';

// Caminho do controlador
$controllerClass = "\\Sts\\Controllers\\" . ucfirst($controller);

// Verificar se o controlador existe
if (class_exists($controllerClass)) {
    $instance = new $controllerClass();
    if (method_exists($instance, $action)) {
        $instance->$action();
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Ação não encontrada"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "Recurso não encontrado"]);
}
