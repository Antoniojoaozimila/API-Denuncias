<?php
namespace Sts\Controllers;

class FuncionarioUpdateStatusDenuncia
{
    private array $data;

    public function index()
    {
        // Separa a URL pelos '/'
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);

        // Verifica se há partes suficientes na URL
        if (count($url_parts) >= 4) {
            // Obtém o valor do parâmetro 'id' da URL
            $id = $url_parts[3];

            // Verifica se o ID da denúncia foi fornecido
            if (!empty($id)) {
                // Verifica se uma ação foi especificada
                if (isset($_GET['acao'])) {
                    $acao = $_GET['acao'];

                    // Determina o novo status com base na ação clicada
                    switch ($acao) {
                        case 'aberta':
                            $novoStatus = 1;
                            break;
                        case 'em andamento':
                            $novoStatus = 2;
                            break;
                        case 'em espera':
                            $novoStatus = 3;
                            break;
                        case 'resolvida':
                            $novoStatus = 4;
                            break;
                        case 'reaberta':
                            $novoStatus = 6;
                            break;
                        default:
                            // Ação inválida
                            // Redireciona ou mostra mensagem de erro, conforme necessário
                            break;
                    }

                    // Chama o método para atualizar o status da denúncia
                    $model = new \Sts\Models\AdmsReadFDenuncias();
                    $statusAtualizado = $model->updateStatus($id, $novoStatus);

                    // Verifica se o status foi atualizado com sucesso
                    if ($statusAtualizado) {
                        // Redireciona para a página de listagem de denúncias
                        header("Location: " . URL . "func-listar-denuncias");
                        exit(); // Encerra o script para garantir que o redirecionamento seja realizado corretamente
                    } else {
                        // Mostra mensagem de erro
                        echo "Ocorreu um erro ao atualizar o status da denúncia.";
                    }

                } else {
                    // Se nenhuma ação foi especificada, exibe uma mensagem de erro
                    echo "Ação não fornecida.";
                }
            } else {
                // Se o ID da denúncia não foi fornecido, exibe uma mensagem de erro
                echo "ID da denúncia não fornecido.";
            }
        } else {
            echo "ID da denúncia não fornecido na URL.";
        }

    }
}

