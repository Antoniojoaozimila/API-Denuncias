<?php

namespace Sts\Models;

// Importa a classe AdmsConn para estender suas funcionalidades
use Sts\Models\helper\AdmsConn;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Define a classe AdmsDenuncias, que estende a classe AdmsConn
class AdmsDenuncias extends AdmsConn
{

    public static int $totalDenuncias = 0;
    public static int $totalDenunciasP = 0;
    public  static int $totalDenunciasR = 0;
    // Declaração de propriedades
    private array $data = []; // Armazena dados retornados das consultas ao banco de dados
    private object $conn; // Objeto de conexão com o banco de dados
    private $result; // Armazena o resultado de uma operação no banco de dados
    private int $id_municipe; // Armazena o ID do munícipe
    private ?string $tecnicoEmail = null;


    // Método para retornar o resultado de uma operação no banco de dados
    function getResult()
    {
        return $this->result;
    }

    // Método para buscar dados relacionados às denúncias
    public function index(): array
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar detalhes das denúncias, incluindo latitude e longitude
        $readDenuncias->fullRead("SELECT 
                                d.id AS id, 
                                t.nome AS DNOME, 
                                c.gravidade AS DGRAVIDADE, 
                                m.nome AS MNOME, 
                                s.status AS DSTATUS, 
                                d.titulo AS DTITULO, 
                                d.latitude AS DLATITUDE, 
                                d.longitude AS DLONGITUDE,
                                d.localizacao AS DLOCALIZACAO,
                                d.descricao AS DDESCRICAO,
                                d.AcoesTomadasTec AS DACOESTEC,
                                d.created_at AS DCREATED
                              FROM denuncia d 
                              INNER JOIN tipo_denuncia t ON d.id_tipo = t.id 
                              INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id 
                              INNER JOIN municipe m ON d.id_municipe = m.id 
                              INNER JOIN status_denuncia s ON d.id_status=s.id");

        // Armazena o resultado da consulta no array $data
        $this->data['denunciasDetails'] = $readDenuncias->getResult();

        // Retorna os dados
        return $this->data;
    }

    // Método para buscar dados relacionados às denúncias de técnicos
    public function tecnicoDenuncia()
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar detalhes das denúncias de técnicos
        $readDenuncias->fullRead("SELECT d.titulo AS TITULO, d.localizacao AS LOCALIZACAO, s.status AS STATUS, t.nome AS NOME, t.email AS EMAIL FROM tecnico_denuncia td INNER JOIN denuncia d ON td.id_denuncia=d.id INNER JOIN status_denuncia s ON d.id_status=s.id INNER JOIN tecnico t ON td.id_tecnico=t.id");

        // Armazena o resultado da consulta no array $data
        $this->data['tecnicoDenuncia'] = $readDenuncias->getResult();

        // Retorna os dados
        return $this->data;
    }

    // Método para buscar dados dos técnicos
    public function tecnicos()
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readTecnicos = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar dados dos técnicos
        $readTecnicos->fullRead("SELECT id, nome FROM tecnico");

        // Armazena o resultado da consulta no array $data
        $this->data['tecnicos'] = $readTecnicos->getResult();

        // Retorna os dados
        return $this->data;
    }


    public function getTecnicoEmail(): ?string
    {
        return $this->tecnicoEmail;
    }

    public function tecnicoEmail($dataForm)
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readTecnicoEmail = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar o email do técnico com base no ID fornecido
        $readTecnicoEmail->fullRead("SELECT email FROM tecnico WHERE id=:id", "id={$dataForm['id_tecnico']}");

        // Obtém o resultado da consulta
        $tecnicoEmail = $readTecnicoEmail->getResult();

        // Imprime o email do técnico (apenas para fins de depuração)


        ///implementacao de envio do email ao funcionario ao ser atribuido uma tarefa


        // Instancie o objeto do PHPMailer
        $mail = new PHPMailer(true);

        try {
            //  Configurações do servidor SMTP do Outlook
            $mail->isSMTP();
            $mail->Host       = 'smtp.office365.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'antoniojoaozimila@outlook.com'; // Seu endereço de e-mail do Outlook
            $mail->Password   = 'xR:b-5u5j3ttDD_'; // Sua senha do Outlook
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587; // Porta do servidor SMTP do Outlook (pode variar)

            // Remetente
            $mail->setFrom('antoniojoaozimila@outlook.com', 'Antonio');

            // Destinatário
            $mail->addAddress($tecnicoEmail[0]['email'], 'AJZ');

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'SISTEMA DE GESTAO DE DENUNCIAS VAZAMENTO DE AGUA';
            $mail->Body    = 'FOI LHE ATRIBUIDO UMA NOVA TAREFA, POR FAVOR ACEDA AO SISTEMA PARA MAIS DETALHES 
    http://localhost/ProjectoFinal-Curso/';

            // Envia o e-mail
            $mail->send();
            echo 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
        }


        // Verifica se há um email de técnico retornado pela consulta
        if (!empty($tecnicoEmail[0]['email'])) {
            // Se houver um email, armazena-o na propriedade $tecnicoEmail da classe
            $this->tecnicoEmail = $tecnicoEmail[0]['email'];
        } else {
            // Se não houver email, define a propriedade $tecnicoEmail como null
            $this->tecnicoEmail = null;
        }
    }


    // Método para alocar uma denúncia a um técnico
    public function alocarDenuncia($dataForm)
    {
        // Instancia um objeto para conectar ao banco de dados
        $this->conn = $this->connectDb();

        // Prepara a query SQL para inserir a alocação da denúncia
        $query_alocar_denuncia = "INSERT INTO tecnico_denuncia (id_tecnico, id_denuncia, created_at) VALUES (:id_tecnico, :id_denuncia, NOW())";
        $add_alocar_denuncia = $this->conn->prepare($query_alocar_denuncia);
        $add_alocar_denuncia->bindParam(":id_tecnico", $dataForm['id_tecnico'], PDO::PARAM_STR);
        $add_alocar_denuncia->bindParam(":id_denuncia", $dataForm['id_denuncia'], PDO::PARAM_STR);

        //Alterando o Status da denuncia para 2 (Recebido depois de alocar a denuncia)
        $model = new \Sts\Models\AdmsReadFDenuncias();
        $model->updateStatus($dataForm['id_denuncia'], 7);

        // Executa a query
        $add_alocar_denuncia->execute();

        if ($add_alocar_denuncia->rowCount()) {

            $_SESSION['msg'] = "<p style='color:green;text-align: center'>TAREFA ATRIBUIDA COM SUCESSO.</p>";
        } else {
            $_SESSION['msg'] = "<p style='color:green;'>ERRO AO ATRIBUIR TAREFA</p>";
        }
    }

    // Método para buscar tipos de denúncias
    public function tipoDenuncia()
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $tipoDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar tipos de denúncias
        $tipoDenuncias->fullRead("SELECT id, nome FROM tipo_denuncia");

        // Armazena o resultado da consulta no array $data
        $this->data['tipoDenuncia'] = $tipoDenuncias->getResult();

        // Retorna os dados
        return $this->data;
    }

    // Método para buscar classificações de denúncias
    public function classificacaoDenuncia()
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $classificacaoDenuncia = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar classificações de denúncias
        $classificacaoDenuncia->fullRead("SELECT id, gravidade FROM classificacao_denuncia");

        // Armazena o resultado da consulta no array $data
        $this->data['classificacaoDenuncia'] = $classificacaoDenuncia->getResult();

        // Retorna os dados
        return $this->data;
    }

    // Método para recuperar o ID do munícipe
    public function recuperarId($userId)
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readIdFunc = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar o ID do munícipe
        $readIdFunc->fullRead("SELECT id FROM municipe WHERE id_usuario=:userId", "userId={$userId}");

        // Armazena o resultado da consulta em $idMunicipe
        $idMunicipe = $readIdFunc->getResult();

        // Verifica se há resultados e retorna o ID do munícipe, se encontrado
        if (!empty($idMunicipe[0]['id'])) {
            return $idMunicipe[0]['id'];
        } else {
            return null; // Retorna null se não houver resultados
        }
    }

    // Método para listar os detalhes de uma denúncia com base no ID
    public function getDenunciaDetails($id)
    {

        // Instancia um objeto para conectar ao banco de dados
        $this->conn = $this->connectDb();
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar os detalhes de uma denúncia com base no ID
        $readDenuncias->fullRead("SELECT 
                                td.id_denuncia AS ID, 
                                d.titulo AS DTITULO, 
                                d.descricao AS DDESCRIACO, 
                                d.localizacao AS DLOCALIZACAO, 
                                d.latitude AS DLATITUDE, 
                                d.longitude AS DLONGITUDE, 
                                t.nome AS DTIPO, 
                                c.gravidade AS DGRAVIDADE, 
                                m.nome AS DMUNICIPE, 
                                m.telefone AS DTMUNICIPE, 
                                s.status AS DSTATUS 
                              FROM tecnico_denuncia td 
                              INNER JOIN denuncia d ON td.id_denuncia = d.id 
                              INNER JOIN tipo_denuncia t ON d.id_tipo = t.id 
                              INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id 
                              INNER JOIN municipe m ON d.id_municipe = m.id 
                              INNER JOIN status_denuncia s ON d.id_status = s.id 
                              INNER JOIN tecnico te ON td.id_tecnico = te.id 
                              WHERE d.id=:id", "id={$id}");

        // Retorna apenas o resultado da consulta
        return $readDenuncias->getResult();
    }

    // Método para listar os detalhes de uma denúncia de administrador com base no ID
    public function getAdminDenunciaDetails($id)
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar os detalhes de uma denúncia de administrador com base no ID
        $readDenuncias->fullRead("SELECT 
                                t.nome AS DNOME, 
                                c.gravidade AS DGRAVIDADE, 
                                m.nome AS MNOME,
                                m.telefone AS TMUNICIPE, 
                                s.status AS DSTATUS, 
                                d.titulo AS DTITULO,
                                d.id AS ID,
                                d.localizacao AS DLOCALIZACAO, 
                                d.descricao AS DDESCRICAO, 
                                d.latitude AS DLATITUDE, 
                                d.longitude AS DLONGITUDE,
                                t.nome AS DTIPO 
                              FROM denuncia d 
                              INNER JOIN tipo_denuncia t ON d.id_tipo = t.id 
                              INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id 
                              INNER JOIN municipe m ON d.id_municipe = m.id 
                              INNER JOIN status_denuncia s ON d.id_status=s.id 
                              WHERE d.id=:id", "id={$id}");

        // Retorna apenas o resultado da consulta
        return $readDenuncias->getResult();
    }


    public function registarDenuncia($dataForm, $idMunicipe)
    {
        $this->conn = $this->connectDb();
        
        $query = "INSERT INTO denuncia (id_tipo, id_classificacao, id_municipe, titulo, descricao, localizacao, latitude, longitude, created_at) 
                  VALUES (:id_tipo, :id_classificacao, :id_municipe, :titulo, :descricao, :localizacao, :latitude, :longitude, NOW())";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id_tipo", $dataForm['id_tipo'], PDO::PARAM_INT);
        $stmt->bindParam(":id_classificacao", $dataForm['id_classificacao'], PDO::PARAM_INT);
        $stmt->bindParam(":id_municipe", $idMunicipe, PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $dataForm['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $dataForm['descricao'], PDO::PARAM_STR);
        $stmt->bindParam(":localizacao", $dataForm['localizacao'], PDO::PARAM_STR);
        $stmt->bindParam(":latitude", $dataForm['latitude'], PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $dataForm['longitude'], PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            $id_denuncia = $this->conn->lastInsertId();
            
            // Verificar se existem imagens
            if (!empty($_FILES['url_arquivo'])) {
                $this->salvarImagens($id_denuncia);
            }
    
            return true;
        }
        return false;
    }
    
    private function salvarImagens($id_denuncia)
    {
        $diretorio = 'app/sts/assets/adm/img/users/';
        
        foreach ($_FILES['url_arquivo']['tmp_name'] as $key => $tmp_name) {
            $extensao = pathinfo($_FILES['url_arquivo']['name'][$key], PATHINFO_EXTENSION);
            $nomeImagem = $id_denuncia . '_' . uniqid() . '.' . $extensao;
            move_uploaded_file($tmp_name, $diretorio . $nomeImagem);
    
            $query = "INSERT INTO media_denuncia (id_denuncia, url_arquivo, created_at) VALUES (:id_denuncia, :url_arquivo, NOW())";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_denuncia", $id_denuncia, PDO::PARAM_INT);
            $stmt->bindParam(":url_arquivo", $nomeImagem, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    

    // Método para calcular o número total de denúncias, denúncias pendentes e denúncias resolvidas
    public function numeroDenuncias()
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Consulta SQL para contar o número total de denúncias
        $readDenuncias->fullRead("SELECT COUNT(id) AS total FROM denuncia");
        self::$totalDenuncias = (int)$readDenuncias->getResult()[0]['total'];

        // Consulta SQL para contar o número total de denúncias pendentes (status = 1)
        $readDenuncias->fullRead("SELECT COUNT(id) AS totalP FROM denuncia WHERE id_status = 1");
        self::$totalDenunciasP = (int)$readDenuncias->getResult()[0]['totalP'];

        // Consulta SQL para contar o número total de denúncias resolvidas (status = resolvida)
        $readDenuncias->fullRead("SELECT COUNT(id) AS totalR FROM denuncia WHERE id_status = 4");
        self::$totalDenunciasR = (int)$readDenuncias->getResult()[0]['totalR'];

        // Retorna um array com os valores das variáveis
        return [
            'totalDenuncias' => self::$totalDenuncias,
            'totalDenunciasP' => self::$totalDenunciasP,
            'totalDenunciasR' => self::$totalDenunciasR
        ];
    }


    public function tecnicoAcaoTomadas($id, $descricao)
    {
        // Instancia um objeto para conectar ao banco de dados
        $this->conn = $this->connectDb();

        // Prepara a query SQL para atualizar a coluna AcoesTomadasTec na tabela denuncias
        $query_update_acoes_tomadas = "UPDATE denuncia SET AcoesTomadasTec = :descricao WHERE id = :id";
        $update_acoes_tomadas = $this->conn->prepare($query_update_acoes_tomadas);

        // Bind dos parâmetros
        $update_acoes_tomadas->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        $update_acoes_tomadas->bindParam(":id", $id, PDO::PARAM_INT);

        // Executa a query
        $update_acoes_tomadas->execute();

        // Verifica se a operação foi bem-sucedida e define uma mensagem de sessão
        if ($update_acoes_tomadas) {
            $_SESSION['msg'] = "<p style='color:green; text-align: center'>Ação tomada pelo técnico registrada com sucesso.</p>";

            //Alterando o Status da denuncia para 2 (Resolvido)
            $model = new \Sts\Models\AdmsReadFDenuncias();
            $model->updateStatus($id, 4);
            //Enviando o feedback ao muncipe
            $this->feedbackFinal($id);
        } else {
            $_SESSION['msg'] = "<p style='color:red; text-align: center'>Erro ao registrar ação tomada pelo técnico.</p>";
        }
    }


    public function feedbackFinal($id)
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncia = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar os detalhes da denúncia com base no ID
        $readDenuncia->fullRead("SELECT 
                                d.titulo AS titulo, 
                                d.localizacao AS localizacao, 
                                d.id_municipe AS id_municipe, 
                                s.status AS status 
                              FROM denuncia d 
                              INNER JOIN status_denuncia s ON d.id_status = s.id 
                              WHERE d.id=:id", "id={$id}");

        // Obtém os detalhes da denúncia
        $denuncia = $readDenuncia->getResult();

        // Verifica se a consulta retornou resultados
        if (!empty($denuncia)) {
            // Extrai os dados da denúncia
            $titulo = $denuncia[0]['titulo'];
            $localizacao = $denuncia[0]['localizacao'];
            $id_municipe = $denuncia[0]['id_municipe'];
            $status = $denuncia[0]['status'];
            // Instancia um objeto para realizar consultas ao banco de dados
            $readUsuario = new \Sts\Models\helper\AdmsRead();

            // Executa uma consulta SQL para buscar o e-mail do munícipe com base no ID do munícipe
            $readUsuario->fullRead("SELECT email FROM municipe WHERE id=:id", "id={$id_municipe}");

            // Obtém o e-mail do munícipe
            $municipeEmail = $readUsuario->getResult()[0]['email'];

            // Verifica se o e-mail do munícipe foi encontrado
            if (!empty($municipeEmail)) {
                // Instancia um objeto do PHPMailer
                $mail = new PHPMailer(true);

                try {
                    //  Configurações do servidor SMTP do Outlook
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.office365.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'antoniojoaozimila@outlook.com'; // Seu endereço de e-mail do Outlook
                    $mail->Password   = 'xR:b-5u5j3ttDD_'; // Sua senha do Outlook
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587; // Porta do servidor SMTP do Outlook (pode variar)

                    // Remetente
                    $mail->setFrom('antoniojoaozimila@outlook.com', 'Antonio');
                    // Destinatário
                    $mail->addAddress($municipeEmail);

                    // Conteúdo do e-mail
                    $mail->isHTML(true);
                    $mail->Subject = 'NOTIFICACAO - SISTEMA DE DENUNCIAS DE VAZAMENTOS DE AGUA';
                    $mail->Body    = "Prezado Munícipe,<br></br> informamos que a sua denuncia foi resolvida com sucesso: <br></br>   Nome da denuncia: '{$titulo}' <br></br> Status: {$status}.<br></br> Localização da denúncia: {$localizacao}. <br></br> Atenciosamente,<br>Seu Nome";

                    // Envia o e-mail
                    $mail->send();
                    echo 'E-mail enviado com sucesso!';
                } catch (Exception $e) {
                    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
                }
            } else {
                echo "E-mail do munícipe não encontrado.";
            }
        } else {
            echo "Denúncia não encontrada.";
        }
    }

    public function generateReport(): array
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readDenuncias = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar detalhes das denúncias, incluindo latitude e longitude
        $readDenuncias->fullRead("SELECT 
                                d.id AS id, 
                                t.nome AS DNOME, 
                                c.gravidade AS DGRAVIDADE, 
                                m.nome AS MNOME, 
                                s.status AS DSTATUS, 
                                d.titulo AS DTITULO, 
                                d.latitude AS DLATITUDE, 
                                d.longitude AS DLONGITUDE,
                                D.localizacao AS DLOCALIZACAO
                              FROM denuncia d 
                              INNER JOIN tipo_denuncia t ON d.id_tipo = t.id 
                              INNER JOIN classificacao_denuncia c ON d.id_classificacao = c.id 
                              INNER JOIN municipe m ON d.id_municipe = m.id 
                              INNER JOIN status_denuncia s ON d.id_status=s.id");

        // Armazena o resultado da consulta no array $data
        $this->data['denunciasDetails'] = $readDenuncias->getResult();

        // Retorna os dados
        return $this->data;
    }


    public function estatisticasTec()
    {
        // Conexão com o banco de dados
        // Instancia um objeto para conectar ao banco de dados
        $this->conn = $this->connectDb();

        // Consulta para obter todos os técnicos
        $queryTecnicos = "SELECT id FROM tecnico";
        $stmtTecnicos = $this->conn->prepare($queryTecnicos);
        $stmtTecnicos->execute();

        $tecnicos = $stmtTecnicos->fetchAll(PDO::FETCH_ASSOC);

        // Para cada técnico, calcular as estatísticas
        foreach ($tecnicos as $tecnico) {
            $tecnicoId = $tecnico['id'];

            // Total de denúncias
            $queryTotal = "SELECT COUNT(*) AS total FROM tecnico_denuncia WHERE id_tecnico = :tecnico_id";
            $stmtTotal = $this->conn->prepare($queryTotal);
            $stmtTotal->bindParam(':tecnico_id', $tecnicoId, PDO::PARAM_INT);
            $stmtTotal->execute();
            $totalDenuncias = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

            // Denúncias em andamento
            $queryEmAndamento = "SELECT COUNT(*) AS em_andamento FROM tecnico_denuncia td
                                 JOIN denuncia d ON td.id_denuncia = d.id
                                 WHERE td.id_tecnico = :tecnico_id AND d.id_status = 2";
            $stmtEmAndamento = $this->conn->prepare($queryEmAndamento);
            $stmtEmAndamento->bindParam(':tecnico_id', $tecnicoId, PDO::PARAM_INT);
            $stmtEmAndamento->execute();
            $emAndamento = $stmtEmAndamento->fetch(PDO::FETCH_ASSOC)['em_andamento'];

            // Denúncias resolvidas
            $queryResolvido = "SELECT COUNT(*) AS resolvido FROM tecnico_denuncia td
                               JOIN denuncia d ON td.id_denuncia = d.id
                               WHERE td.id_tecnico = :tecnico_id AND d.id_status = 4";
            $stmtResolvido = $this->conn->prepare($queryResolvido);
            $stmtResolvido->bindParam(':tecnico_id', $tecnicoId, PDO::PARAM_INT);
            $stmtResolvido->execute();
            $resolvido = $stmtResolvido->fetch(PDO::FETCH_ASSOC)['resolvido'];

            // Atualizar a tabela tecnico com as estatísticas
            $queryUpdate = "UPDATE tecnico SET DRecebidas = :total_denuncias, 
                             DAndamento = :em_andamento, DResolvidas = :resolvido 
                             WHERE id = :tecnico_id";
            $stmtUpdate = $this->conn->prepare($queryUpdate);
            $stmtUpdate->bindParam(':total_denuncias', $totalDenuncias, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':em_andamento', $emAndamento, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':resolvido', $resolvido, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':tecnico_id', $tecnicoId, PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
    }

    // Método para retornar todos os dados da tabela tecnico
    public function getAllTecnicos(): array
    {
        // Instancia um objeto para realizar consultas ao banco de dados
        $readTecnicos = new \Sts\Models\helper\AdmsRead();

        // Executa uma consulta SQL para buscar todos os dados da tabela tecnico
        $readTecnicos->fullRead("SELECT id, nome, telefone, DRecebidas, DAndamento, DResolvidas FROM tecnico");

        // Armazena o resultado da consulta no array $data
        $this->data['allTecnicos'] = $readTecnicos->getResult();

        // Retorna os dados
        return $this->data['allTecnicos'];
    }
}
