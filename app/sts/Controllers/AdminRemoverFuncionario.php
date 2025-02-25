<?php

namespace Sts\Controllers;

class AdminRemoverFuncionario
{
    public function index()
    {
        // Separa a URL pelos '/'
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);

        // Verifica se há partes suficientes na URL
        if (count($url_parts) >= 5) {
            // Obtém o valor do parâmetro 'id' da URL
            $id = $url_parts[4];

            if (!empty($id)) {
                // Remova a verificação de vazios, pois agora é tratada no método delete
                $deleteFuncionario = new \Sts\Models\AdmsFuncionario();
                $deleteFuncionario->delete($id);
                if ($deleteFuncionario->getResult()) {
                    $urlRedirect = URL . "admin-listar-funcionario";
                    header("Location: $urlRedirect");
                    exit(); // Após redirecionamento, saia do script
                } else {
                    echo "Erro ao excluir o funcionário.";
                }
            }
        } else {
            echo "ID do funcionário não fornecido na URL.";
        }
    }
}
