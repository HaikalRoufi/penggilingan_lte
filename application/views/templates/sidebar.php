<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="<?= base_url('assets') ?>/images/logo.png" alt="Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">SIPP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets') ?>/images/user_haikal.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == "dashboard" ? "active" : ""; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_jenis_padi') ?>" class="nav-link <?= $this->uri->segment(1) == "c_jenis_padi" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-tasks "></i>
              <p>
                Jenis Padi
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_pelanggan') ?>" class="nav-link <?= $this->uri->segment(1) == "c_pelanggan" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Data Pelanggan
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_barang') ?>" class="nav-link <?= $this->uri->segment(1) == "c_barang" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'petugas') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_proses') ?>" class="nav-link <?= $this->uri->segment(1) == "c_proses" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Proses Penggilingan
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_pembayaran') ?>" class="nav-link <?= $this->uri->segment(1) == "c_pembayaran" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Pembayaran
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'pemilik') { ?>
          <li class="nav-item <?= $this->uri->segment(1) == "c_laporan" ? "menu-open" : ""; ?>">
            <a href="#" class="nav-link <?= $this->uri->segment(1) == "c_laporan" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('c_laporan/laporan_pelanggan') ?>" class="nav-link <?= $this->uri->segment(2) == "laporan_pelanggan" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('c_laporan/laporan_barang') ?>" class="nav-link <?= $this->uri->segment(2) == "laporan_barang" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('c_laporan/laporan_proses') ?>" class="nav-link <?= $this->uri->segment(2) == "laporan_proses" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Proses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('c_laporan/laporan_pembayaran') ?>" class="nav-link <?= $this->uri->segment(2) == "laporan_pembayaran" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('akses') == 'superadmin') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('c_user') ?>" class="nav-link <?= $this->uri->segment(1) == "c_user" ? "active" : ""; ?>">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                User
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="<?= base_url('auth/logout'); ?>" class="nav-link"
            onclick="return confirm('Apakah Anda Ingin Keluar ?');">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>