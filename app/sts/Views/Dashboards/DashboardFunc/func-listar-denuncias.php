<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="funcionario.php">
            <div class="sidebar-brand-text mx-3">FUNCIONÁRIOS</div>
        </a>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="funcionario">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - Denúncia -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDenuncia" aria-expanded="true" aria-controls="collapseDenuncia">
                <i class="fas fa-fw fa-cog"></i>
                <span>Denúncia</span>
            </a>
            <div id="collapseDenuncia" class="collapse" aria-labelledby="headingDenuncia" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo URL; ?>func-listar-denuncias">Listar</a>
                </div>
            </div>
        </li>

        <!-- Sidebar Toggler -->
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
                        <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo $_SESSION['user_name'] ?>
                            </span>
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
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="top-list">
                        <span class="title-content">Listar</span>
                    </div>
                    <?php if (!empty($this->data['denunciasFuncDetails'])) { ?>
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
                            <tbody id="denunciaTable" class="list-body">
                                <?php foreach ($this->data['denunciasFuncDetails'] as $denunciasFunc) {

                                    // Define a cor de fundo e borda com base no status
                                    $statusClass = '';
                                    if ($denunciasFunc['DSTATUS'] == 'Aberta') {
                                        $statusClass = 'status-aberta';
                                    } elseif ($denunciasFunc['DSTATUS'] == 'Recebido') {
                                        $statusClass = 'status-recebido';
                                    } elseif ($denunciasFunc['DSTATUS'] == 'Resolvida') {
                                        $statusClass = 'status-resolvido';
                                    } elseif ($denunciasFunc['DSTATUS'] == 'Em andamento') {
                                        $statusClass = 'status-andamento';
                                    }

                                ?>
                                    <tr>
                                        <td class="list-body-content"><?php echo $denunciasFunc['DTITULO'] ?></td>
                                        <td class="list-body-content"><?php echo $denunciasFunc['DTIPO'] ?></td>
                                        <td class="list-body-content"><?php echo $denunciasFunc['DGRAVIDADE'] ?></td>
                                        <td class="list-body-content"><?php echo $denunciasFunc['DMUNICIPE'] ?></td>
                                        <td class="list-body-content"><span class="status-label <?php echo $statusClass; ?>">
                                                <?php echo $denunciasFunc['DSTATUS'] ?>
                                            </span></td>
                                        <td class="list-body-content">
                                            <a class="btn btn-primary" href="<?php echo URL; ?>func-detalhes-denuncia/<?php echo $denunciasFunc['ID'] ?>">Ver Detalhes</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "Nenhuma denúncia encontrada.";
                    } ?>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Sistema De Denúncia 2024</span>
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

<!-- JavaScript for dynamic search -->
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#denunciaTable tr');

        rows.forEach(row => {
            const title = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            const status = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

            if (title.includes(filter) || status.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>