  <!-- Page Wrapper -->
  <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
              <div class="sidebar-brand-icon rotate-n-15">
                  <!-- <i class="fas fa-laugh-wink"></i> -->
              </div>
              <div class="sidebar-brand-text mx-3">ADMINISTRADORES</div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
              <a class="nav-link" href="<?php echo URL; ?>admin">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">Interface</div>

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
                  </div>
              </div>
          </li>

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
                          <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                              <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                              </button>
                          </div>
                      </div>
                  </form>

                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <!-- Navbar items... -->
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
                      <div class="container">
                          <!-- Lista de Denúncias -->
                          <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>
                          <h2>Denúncias Alocadas</h2>
                          <?php
                            if (!empty($this->data['tecnicoDenuncia'])) {
                            ?>
                              <table class="table" id="denunciasTable">
                                  <thead>
                                      <tr>
                                          <th>Nome</th>
                                          <th>Localização</th>
                                          <th>Status</th>
                                          <th>Funcionário</th>
                                          <th>Email</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($this->data['tecnicoDenuncia'] as $tecnicoDenuncia) {
                                            if (in_array($tecnicoDenuncia['STATUS'], ["Recebido", "Em andamento", "Resolvida"])) {
                                        ?>
                                              <tr>
                                                  <td><?php echo $tecnicoDenuncia['TITULO'] ?></td>
                                                  <td><?php echo $tecnicoDenuncia['LOCALIZACAO'] ?></td>
                                                  <td><?php echo $tecnicoDenuncia['STATUS'] ?></td>
                                                  <td><?php echo $tecnicoDenuncia['NOME'] ?></td>
                                                  <td><?php echo $tecnicoDenuncia['EMAIL'] ?></td>
                                              </tr>
                                      <?php
                                            }
                                        }
                                        ?>
                                  </tbody>
                              </table>
                          <?php
                            } else {
                                echo "Nenhuma denúncia encontrada.";
                            }
                            ?>
                      </div>
                  </div>

                  <!-- /.container-fluid -->
              </div>
              <!-- End of Main Content -->



          </div>
          <!-- End of Content Wrapper -->
          <!-- Footer -->
          <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                      <span>Copyright &copy; Sistema De Denúncia 2024</span>
                  </div>
              </div>
          </footer>
          <!-- End of Footer -->

          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
              <i class="fas fa-angle-up"></i>
          </a>
      </div>
      <!-- End of Page Wrapper -->

      <script>
          document.getElementById('searchInput').addEventListener('input', function() {
              let filter = this.value.toLowerCase();
              let rows = document.querySelectorAll('#denunciasTable tbody tr');

              rows.forEach(row => {
                  let text = row.textContent.toLowerCase();
                  row.style.display = text.includes(filter) ? '' : 'none';
              });
          });
      </script>
  </div>