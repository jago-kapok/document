<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>SIPP DOKLING - Dinas Lingkungan Hidup Kab. Bojonegoro</title>
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>dist/img/logo.png">

  <!-- Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <script src="<?= base_url('assets/'); ?>dist/js/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/sweetalert2@11.js"></script>

  <!-- AOS -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/aos.css" />

  <style>
    body { font-family: 'Inter', sans-serif; background-color: #eff3f8; font-size: 85% }
    .card { padding: 1rem; border-radius: 12px; box-shadow: 0 3px 5px rgba(0,0,0,.02),0 0 2px rgba(0,0,0,.05),0 1px 4px rgba(0,0,0,.08)!important; }
    .nav-fill .nav-item, .nav-fill>.nav-link { border-radius: 12px; width:10.3rem; }
    .card-icon { width:2.5rem; height:2.5rem; border-radius: 6px; font-size: 1.2rem; font-weight: bold; padding: 0.2rem; }
  </style>

  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      /*background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
      height: 100%;*/

      /* Center and scale the image nicely */
/*      background-position: center;*/
/*      background-repeat: no-repeat;*/
/*      background-size: cover;*/
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      #background: radial-gradient(#44006b, #ad1fff);
      background: radial-gradient(#006b1c, #1fffac);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -20px;
      right: -50px;
      width: 300px;
      height: 300px;
/*      #background: radial-gradient(#44006b, #ad1fff);*/
      background: radial-gradient(#006b21, #1fffd6);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }

    p {
      margin-bottom: 0;
    }
  </style>
</head>

<body class="background-radial-gradient">
  <section>
  
    <nav class="navbar">
      <div class="container p-3">
        <a class="navbar-brand text-light d-flex align-items-center" href="<?= base_url() ?>">
          <img src="<?= base_url('assets/') ?>dist/img/logo_full.png" width="40" class="d-inline-block align-text-top">
          <h4 class="ms-4">PEMKAB BOJONEGORO</h4>
        </a>
      </div>
    </nav>
    
    <!-- Section: Design Block -->
    <div class="container">
      <div class="row g-0 justify-content-center align-items-center">
        <div class="col-lg-7 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-4 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            SIPP DOKLING <br />
            <span style="color: hsl(218, 81%, 75%); font-size: 80%">Dinas Lingkungan Hidup</span>
          </h1>
          <p class="mb-4 opacity-70 fs-6" style="color: hsl(218, 81%, 85%)">
            Sistem Informasi Pelaporan Pelaksanaan Dokumen Lingkungan, untuk :
            <br>
            - Pelaporan Pelaksanaan RKL-RPL dan UKL-UPL<br>
            - Pelaporan Pengendalian Pencemaran Air<br>
            - Pelaporan Pengendalian Pencemaran Udara<br>
            - Pelaporan Pengendalian Limbah<br>
            - Pelaporan Pengelolaan Dampak Sosial Ekonomi<br>
          </p>
        </div>

        <div class="col-lg-5 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

          <div class="card bg-glass">
            <div class="card-body px-4 px-md-4">
              <form action="login" method="POST">
                <center><h4><b>FORM</b> LOGIN</h4></center><hr>
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <?php if ($this->session->flashdata('message')) { ?>
                  <div class="alert alert-danger row mx-0 gx-2">
                    <i class="bi-info-circle col-auto"></i>&nbsp;
                    <div class="col-auto"><?= $this->session->flashdata('message'); ?></div>
                  </div>
                <?php } ?>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <div class="form-outline">
                      <label class="form-label fw-bold" for="form3Example1">Username / Email</label>
                      <input type="text" name="username" class="form-control" required/>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-3">
                  <label class="form-label fw-bold" for="form3Example3">Password</label>
                  <input type="password" name="password" class="form-control" required/>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">
                  <i class="bi-box-arrow-in-right"></i>&nbsp; Masuk
                </button>

                <!-- Register buttons -->
                <hr>
                <div class="text-center">
                  <p class="py-3">Anda belum memiliki akun ? Silakan registrasi terlebih dahulu</p>
                  
                  <a href="<?= base_url() ?>register" class="btn btn-success btn-block">
                    Registrasi Akun
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
</body>
</html>