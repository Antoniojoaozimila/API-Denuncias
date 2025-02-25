<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo URL; ?>funcionario">
            <div class="sidebar-brand-icon rotate-n-15">
                <!--    <i class="fas fa-laugh-wink"></i>-->
            </div>
            <div class="sidebar-brand-text mx-3">FUNCIONÁRIOS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo URL; ?>funcionario">
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
                    <a class="collapse-item" href="<?php echo URL; ?>func-listar-denuncias">Listar</a>
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


        <!-- Divider -->
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
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile_2.svg" alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how
                                        would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile_3.svg" alt="...">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with
                                        the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                        told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo $_SESSION['user_name'] ?>
                            </span>
                            <img class="img-profile rounded-circle" src="<?php echo URL; ?>app/sts/assets/dashuser/img/undraw_profile.svg">
                        </a>

                        <!-- Nav Item - Logout -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL; ?>logout">
                            <i class="fas fa-sign-out-alt fa-fw"></i> Logout
                        </a>
                    </li>
                    </li>

                </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">ÁREA DE TRABALHO</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h2>Detalhes da Denúncia</h2>
                        <hr>

                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>

                        <?php
                        if (!empty($this->data['denunciaDetails'][0])) {
                            $denuncia = $this->data['denunciaDetails'][0]; // Armazena os detalhes do funcionário para facilitar o acesso
                        ?>
                            <?php if (!empty($denuncia['DSTATUS']) && $denuncia['DSTATUS'] === 'Recebido') : ?>
                                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" style="display: flex; justify-content: flex-end;">
                                    <!-- Campo oculto para armazenar o ID da denúncia -->
                                    <input type="hidden" name="id_denuncia" value="<?php echo $denuncia['ID']; ?>">
                                    <button type="submit" name="alterarStatus" value="alterarStatus" class="btn btn-primary" style="width:150px;">Iniciar</button>
                                </form>
                            <?php endif; ?>

                            <div class="form-group d-flex">
                                <label for="nomeDenuncia" class="mr-2">Nome da Denúncia:</label>
                                <p id="nomeDenuncia" class="mb-0">
                                    <?php echo $denuncia['DTITULO'] ?>
                                </p>
                            </div>

                            <div class="form-group d-flex">
                                <label for="descricao" class="mr-2">Descrição:</label>
                                <p id="descricao" class="mb-0">
                                    <?php echo $denuncia['DDESCRIACO'] ?>
                                </p>
                            </div>
                            <div class="form-group d-flex">
                                <label for="tipo" class="mr-2">Tipo:</label>
                                <p id="tipo" class="mb-0">
                                    <?php echo $denuncia['DTIPO'] ?>
                                </p>
                            </div>
                            <div class="form-group d-flex">
                                <label for="classificacao" class="mr-2">Classificação:</label>
                                <p id="classificacao" class="mb-0">
                                    <?php echo $denuncia['DGRAVIDADE'] ?>
                                </p>
                            </div>
                            <div class="form-group d-flex">
                                <label for="classificacao" class="mr-2">Nome do Munícipe:</label>
                                <p id="classificacao" class="mb-0">
                                    <?php echo $denuncia['DMUNICIPE'] ?>
                                </p>
                            </div>
                            <div class="form-group d-flex">
                                <label for="classificacao" class="mr-2">Nr. de Telefone do Munícipe:</label>
                                <p id="classificacao" class="mb-0">
                                    <?php echo $denuncia['DTMUNICIPE'] ?>
                                </p>
                            </div>
                            <div class="form-group d-flex">
                                <label for="classificacao" class="mr-2">Status:</label>
                                <p id="classificacao" class="mb-0">
                                    <?php echo $denuncia['DSTATUS'] ?>
                                </p>
                            </div>

                            <div class="gallery-container">
                                <div class="gallery">
                                    <?php
                                    // Verificar se o ID da denúncia foi passado
                                    $id_denuncia = $denuncia['ID'];

                                    if (isset($id_denuncia)) {
                                        // Diretório onde estão as imagens
                                        $directory = "app/sts/assets/adm/img/users/";
                                        // Buscar todas as imagens que contêm o ID da denúncia no nome
                                        $images = glob($directory . $id_denuncia . "_*.{jpg,jpeg,png,gif,jfif}", GLOB_BRACE);
                                        // Exibir as imagens encontradas
                                        foreach ($images as $image) {
                                            echo "<img src='" . URL . $image . "' alt='Imagem'>";
                                        }
                                    } else {
                                        echo "Nenhuma denúncia selecionada.";
                                    }
                                    ?>
                                </div>
                                <button class="prev">&#10094;</button>
                                <button class="next">&#10095;</button>
                            </div>

                            <div class="form-group d-flex">
                                <label for="localizacao" class="mr-2">Localização da Fuga:</label>
                                <p id="classificacao" class="mb-0">
                                    <?php echo $denuncia['DLOCALIZACAO'] ?>
                                </p>
                            </div>

                            <?php
                            if (!empty($this->data['denunciaDetails'][0])) {
                                $denuncia = $this->data['denunciaDetails'][0];
                                $latitude = $denuncia['DLATITUDE'];  // Valor vindo da base de dados
                                $longitude = $denuncia['DLONGITUDE']; // Valor vindo da base de dados
                            }
                            ?>
                            <div id="maplet" style="height: 400px; width: 130%; margin-bottom: 20px;">
                                <script>
                                    // Inicialização das coordenadas e zoom do mapa
                                    var mymap = L.map('maplet').setView([-25.9692, 32.5732], 13); // Maputo, Moçambique

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '© OpenStreetMap contributors'
                                    }).addTo(mymap);

                                    // Inicialização do marcador
                                    var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(mymap);
                                </script>
                                <!-- Mais campos conforme necessário -->
                            </div>

                        <?php
                        } else {
                            echo "Nenhum dado da Denúncia encontrado.";
                        }
                        ?>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h2>Relatório Final da Denúncia</h2>
                        <hr>
                        <?php if (!empty($denuncia['DSTATUS']) && $denuncia['DSTATUS'] === 'Em andamento') : ?>
                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                                <!-- Campo oculto para armazenar o ID da denúncia -->
                                <input type="hidden" name="id_denuncia" value="<?php echo $denuncia['ID']; ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <?php
                                        $descricao = "";
                                        if (isset($valorForm['descricao'])) {
                                            $descricao = $valorForm['descricao'];
                                        }
                                        ?>
                                        <label for="descricao">Ações Tomadas</label>
                                        <textarea name="descricao" id="descricao" class="input-adm" placeholder="Inserir detalhes sobre a reparação realizada como: componentes substituídos ou reparados e qualquer outra informação relevante" required><?php echo $descricao; ?></textarea>
                                    </div>
                                    <!-- Outros campos de texto -->
                                </div>
                                <button type="submit" name="Registarmedidas" value="Registarmedidas" class="btn btn-primary">Terminar</button>
                            </form>
                        <?php else : ?>
                            <p>O relatório final só pode ser registrado quando o problema for resolvido.</p>
                        <?php endif; ?>
                    </div>
                </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo URL; ?>logout">Logout</a>
                </div>
            </div>
        </div>

    </div>