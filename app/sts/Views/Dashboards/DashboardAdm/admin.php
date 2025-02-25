<?php

require './vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_pdf'])) {
    // Configuração do Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Conteúdo do PDF
    $html = '<h1>Relatório de Denúncias</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>STATUS</th>
                        <th>LOCALIZACAO</th>
                        <th>DESCRICAO</th>
                        <th>NOME TECNICO</th>
                        <th>ACOES TOMADAS PELO TECNICO</th>
                        <th>RECEP</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($this->data['denunciasDetails'] as $denuncia) {
        if ($denuncia['DSTATUS'] === 'Resolvida') {
            $html .= '<tr>
    <td>' . $denuncia['id'] . '</td>
    <td>' . $denuncia['DSTATUS'] . '</td>
    <td>' . $denuncia['DLOCALIZACAO'] . '</td>
    <td>' . $denuncia['DDESCRICAO'] . '</td>
    <td>' . $denuncia['MNOME'] . '</td>
    <td>' . $denuncia['DACOESTEC'] . '</td>
    <td>' . $denuncia['DCREATED'] . '</td>
  </tr>';
        }
    }

    $html .= '</tbody></table>';

    // Carregar o HTML no Dompdf
    $dompdf->loadHtml($html);

    // (Opcional) Configurar o papel e a orientação
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar o PDF
    $dompdf->render();

    // Diretório onde o PDF será salvo
    $pdfDir = __DIR__ . '/Downloads/pdfs';
    if (!is_dir($pdfDir)) {
        mkdir($pdfDir, 0777, true);
    }

    // Nome do arquivo PDF
    $pdfFilePath = $pdfDir . '/relatorio_denuncias.pdf';

    // Salvar o PDF no diretório
    file_put_contents($pdfFilePath, $dompdf->output());

    // Limpar qualquer saída anterior
    ob_clean();

    // Enviar o PDF para o navegador e salvar no servidor
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdfFilePath) . '"');
    header('Content-Length: ' . filesize($pdfFilePath));
    readfile($pdfFilePath);

    // Alternativa: Enviar o PDF diretamente para o navegador (sem salvar no servidor)
    // $dompdf->stream('relatorio_denuncias.pdf', ['Attachment' => false]);

    exit;
}
?>



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo URL; ?>admin">
            <div class="sidebar-brand-icon rotate-n-15">
                <!--    <i class="fas fa-laugh-wink"></i>-->
            </div>
            <div class="sidebar-brand-text mx-3">ADMINISTRADORES</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo URL; ?>admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Denúncia</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub-Menu:</h6>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-listar-denuncias">Listar</a>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-atribuir-denuncias">Alocadas</a>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-estatisticas-denuncias">Estatisticas</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Tecnicos</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub-Menu:</h6>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-registar-funcionario">Registar</a>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-listar-funcionario">Listar</a>
                    <a class="collapse-item" href="<?php echo URL; ?>admin-atribuir-denuncias">Atribuir Denúncia</a>
                </div>
            </div>
        </li>

        <!-- Divider 
            <hr class="sidebar-divider">
            -->
        <!-- Heading -->
        <div class="sidebar-heading">
            <!--  Addons-->
        </div>

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile_2.svg" alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile_3.svg" alt="...">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                            </a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user_name'] ?></span>
                            <img class="img-profile rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile.svg">
                        </a>
                    </li>

                    <!-- Nav Item - Logout -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL; ?>logout">
                            <i class="fas fa-sign-out-alt fa-fw"></i> Logout
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">ÁREA DE TRABALHO</h1>
                    <!-- Botão para gerar relatório em PDF -->
                    <form action="<?php echo URL; ?>admin" method="post" class="d-none d-sm-inline-block">
                        <input type="hidden" name="generate_pdf" value="1">
                        <button type="submit" class="btn btn-primary fas fa-download">Gerar Relatórios</button>
                    </form>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <?php
                    // Instancie a classe AdmsDenuncias
                    $denuncias = new \Sts\Models\AdmsDenuncias();
                    // Chame o método numeroDenuncias() para atualizar os valores das variáveis
                    $denunciasData = $denuncias->numeroDenuncias();
                    // Supondo que você tenha os dados de denúncias recebidas e resolvidas em $denunciasData
                    $totalDenuncias = $denunciasData['totalDenuncias'];
                    $totalDenunciasResolvidas = $denunciasData['totalDenunciasR'];

                    // Calcular o grau de satisfação
                    $grauDeSatisfacao = ($totalDenuncias > 0) ? ($totalDenunciasResolvidas / $totalDenuncias) * 100 : 0;
                    ?>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Denúncias Recebidas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $denunciasData['totalDenuncias'] ?> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Deúncias Resolvidas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $denunciasData['totalDenunciasR'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Grau de Satisfação</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo round($grauDeSatisfacao, 2); ?>%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $grauDeSatisfacao; ?>%" aria-valuenow="<?php echo $grauDeSatisfacao; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Denúncias Pendentes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $denunciasData['totalDenunciasP'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div style="text-align: center;" class="top-list">
                        <span class="title-content" style="display: block; font-weight: bold; color: orange;">DENUNCIAS PENDENTES</span>

                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>

                    </div>
                    <?php
                    if (!empty($this->data['denunciasDetails'])) {
                    ?>
                        <table class="table-list">
                            <thead class="list-head">
                                <tr>
                                    <th class="list-head-content">Titulo da Denúncia</th>
                                    <th class="list-head-content">Tipo da Denúncia</th>
                                    <th class="list-head-content table-sm-none">Classificação</th>
                                    <th class="list-head-content table-sm-none">Nome do Munícipe</th>
                                    <th class="list-head-content table-sm-none">Status</th>
                                    <th class="list-head-content">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="list-body">
                                <?php foreach ($this->data['denunciasDetails'] as $denuncias) {
                                    // Verifica se o status da denúncia é "Aberta"
                                    if ($denuncias['DSTATUS'] === 'Aberta') {
                                        $statusClass = 'status-aberta';
                                ?>
                                        <tr>
                                            <td class="list-body-content"><?php echo $denuncias['DTITULO'] ?></td>
                                            <td class="list-body-content"><?php echo $denuncias['DNOME'] ?></td>
                                            <td class="list-body-content"><?php echo $denuncias['DGRAVIDADE'] ?></td>
                                            <td class="list-body-content"><?php echo $denuncias['MNOME'] ?></td>
                                            <td class="list-body-content"><span class="status-label <?php echo $statusClass; ?>">
                                                    <?php echo $denuncias['DSTATUS'] ?>
                                                </span></td>
                                            <td class="list-body-content">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color: #ffffff;">
                                                        <a class="dropdown-item" href="admin-detalhes-denuncia/<?php echo $denuncias['id'] ?>">Ver detalhes</a>
                                                        <a class="dropdown-item" href="admin-detalhes2-denuncia/<?php echo $denuncias['id'] ?>">Alocar Denuncia</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "Nenhuma denuncia encontrada.";
                    }
                    ?>
                </div>
                <!-- Content Row -->

                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-6 mb-4">

                    </div>

                    <div class="col-lg-6 mb-4">

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>