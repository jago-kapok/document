<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>SIPP DOKLING - Kab. Bojonegoro</title>
  <!-- Mobile Specific Metas -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
  <meta name="author" content="AdminKit">
  <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>dist/img/logo.png">
  
  <!-- Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <link rel="canonical" href="https://demo-basic.adminkit.io/" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  
  <script src="<?= base_url('assets/'); ?>dist/js/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/jquery-chained.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/notify.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/sweetalert2@11.js"></script>

  <!-- AOS -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/aos.css" />

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <!-- Charts -->
  <script src="<?= base_url('assets/'); ?>dist/js/apexcharts.js"></script>

  <link href="<?= base_url('assets/') ?>dist/css/app.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>dist/css/custom.css" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-center" href="<?= base_url() ?>">
          <span class="align-middle" style="font-size: 1.7rem">SIPP DOKLING</span>
        </a>

        <ul class="sidebar-nav">
          <li class="sidebar-header pt-0">
            Menu Utama
          </li>

          <?php if (in_array(user()->level, [1, 2])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url() ?>">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [1])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'company' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('company') ?>">
                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Perusahaan</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [1])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'verify' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('verify') ?>">
                <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Verifikasi Laporan</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [1])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'report' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('report') ?>">
                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Semua Pelaporan</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [1])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'prints' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('prints') ?>">
                <i class="align-middle" data-feather="printer"></i> <span class="align-middle">Cetak Tanda Terima</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [2])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'company' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('company/view/').user()->company_id ?>">
                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Profil Perusahaan</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [2])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'sendReport' ? 'active' : '' ?>">
              <a class="sidebar-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalSendReport">
                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Pelaporan Dokumen</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [2])): ?>
            <li class="sidebar-item <?= $this->uri->segment(1) == 'history' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('history') ?>">
                <i class="align-middle" data-feather="file"></i> <span class="align-middle">History Pelaporan</span>
              </a>
            </li>
          <?php endif; ?>

          <li class="sidebar-header">
            Pengaturan
          </li>

          <?php if (in_array(user()->level, [1])): ?>          
            <li class="sidebar-item <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) != 'setting' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('user') ?>">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manajemen User</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array(user()->level, [1,2])): ?>
            <li class="sidebar-item <?= $this->uri->segment(2) == 'setting' ? 'active' : '' ?>">
              <a class="sidebar-link" href="<?= base_url('user/setting') ?>">
                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Manajemen Akun</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>

        <div class="sidebar-cta">
          <div class="sidebar-cta-content">
            <strong class="d-inline-block mb-2">Dasar Hukum</strong>
            <div class="mb-3 text-sm">
              - PP No. 27 Tahun 2012<br>
              - PP No. 22 Tahun 2021
            </div>
            <div class="d-grid">
              <a href="https://jdihn.go.id/dokumen-hukum" class="btn btn-primary" target="_blank">Lihat Peraturan</a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="main">
      <nav class="navbar navbar-expand navbar-light navbar-bg px-3">
        <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
          <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
              <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

              <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <span class="btn-icon" data-feather="user-check"></span>&nbsp;
                <span class="text-dark"><?= user()->username ?></span>&nbsp;
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="<?= base_url() ?>user/setting"><i class="align-middle me-1 btn-icon" data-feather="user"></i> Profil Pengguna</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)" onclick="aboutApp()"><i class="align-middle me-1 btn-icon" data-feather="info"></i> Tentang Aplikasi</a>
                <a class="dropdown-item" href="#"><i class="align-middle me-1 btn-icon" data-feather="help-circle"></i> Bantuan</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url() ?>auth/logout"><i class="align-middle me-1 btn-icon" data-feather="log-out"></i> Keluar</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Modal Pelaporan Dokumen -->
      <div class="modal fade" id="modalSendReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel"><b>Periode Pelaporan Dokumen</b></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <label class="col-md-5 col-form-label">Tahun Pelaporan <span class="text-danger">*</span></label>
              <div class="col-md-7">
              <select id="doc_year" class="form-select">
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                <option value="<?= date('Y') - 1 ?>"><?= date('Y') - 1 ?></option>
              </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-md-5 col-form-label">Periode Pelaporan<span class="text-danger">*</span></label>
              <div class="col-md-7">
              <select id="doc_periode" class="form-select">
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
              </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
            <button id="submitPeriode" type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Pelaporan Dokumen -->

      <main class="content p-0">
        <div class="row px-3 py-2">