<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4 bg-green pt-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none">
      <img src="recursos/images/logo.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Grupo Fénix</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar bg-green">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="recursos/images/logolibro.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-decoration-none text-white">Tienda Bookstore</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach ($menu as $key => $valor) { ?>
          <li class="nav-item">
            <a href="<?='?ctrl='.$key?>" class="nav-link">
              <i class="nav-icon bi bi-clipboard2-fill"></i>
              <p>
                <?=$valor?>
                <!--<i class="fas fa-angle-left right"></i>--><!--USA ESTE PARA HACER UN MENU DESPLEGABLE-->
                <!--<span class="badge badge-info right">6</span>--><!--USA ESTE PARA PONER LA NOIIFICACIONES-->
              </p>
            </a>
          </li>
        <?php } ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>