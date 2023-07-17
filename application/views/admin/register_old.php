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
  <script src="<?= base_url('assets/'); ?>dist/js/jquery-chained.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/notify.min.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/sweetalert2@11.js"></script>

  <!-- AOS -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/aos.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/custom.css" />

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Charts -->
  <script src="<?= base_url('assets/'); ?>dist/js/apexcharts.js"></script>

  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#006b1c, #1fffac);
      overflow: hidden;
      z-index: -1;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -20px;
      right: -50px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#006b21, #1fffd6);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>
</head>

<body class="background-radial-gradient">
  <section>
  
    <nav class="navbar">
      <div class="row px-5">
        <a class="navbar-brand text-light d-flex align-items-center mx-4" href="<?= base_url() ?>">
          <img src="<?= base_url('assets/') ?>dist/img/logo_full.png" width="40" class="d-inline-block align-text-top">
          <h4 class="ms-4">PEMKAB BOJONEGORO</h4>
        </a>
      </div>
    </nav>

    <!-- Section: Design Block -->
    <div class="row px-5 m-0 text-lg-start">
      <div class="align-items-center mb-5">
        <div class="mb-5 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

          <div class="card bg-glass" data-aos="fade-up">
            <div class="card-body">
              <form id="form_data">
                <center><h4><b>FORM</b> REGISTRASI</h4></center><hr>

                <div class="col-md-6">
                  <div class="container-fluid bg-app p-1 mb-3">
                    <span class="text-light"><center><b>DATA PERUSAHAAN</b></center></span>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_name" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Alamat Kantor <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <textarea name="company_office_address" class="form-control" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">No. Telepon Kantor <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_phone" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Bidang Usaha (KBLI) <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_business" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Skala Usaha <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_business_scale" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="container-fluid p-1 mb-3" style="background-color: #354f7e">
                    <span class="text-light"><center><b>LOKASI KEGIATAN</b></center></span>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Alamat Lokasi Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <textarea name="company_address" class="form-control" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Luas Lahan (m²) <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input name="company_land_area" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input name="company_building_area" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="container-fluid p-1 mb-3" style="background-color: #354f7e">
                    <span class="text-light"><center><b>CONTACT PERSON</b></center></span>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_pic" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">No. Telepon / Handphone <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_pic_phone" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="container-fluid p-1 mb-3" style="background-color: #354f7e">
                    <span class="text-light"><center><b>DOKUMEN - DOKUMEN</b></center></span>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Struktur Organisasi <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="file" name="struktur_organisasi" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Perijinan yang Dimiliki <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="file" name="perijinan" class="form-control">
                      <div class="form-text">Jika ada lebih dari satu perijinan, harap dijadikan dalam satu file PDF</div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">No. Rekomendasi <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="text" name="company_license_env" class="form-control">
                      <div class="form-text">No. Rekomendasi / Persetujuan Dokumen Lingkungan</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="container-fluid p-1 mb-3" style="background-color: #354f7e">
                    <span class="text-light"><center><b>AKUN PENGGUNA</b></center></span>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Username / Email <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="email" name="auth_email" class="form-control">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Password <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <input type="password" name="auth_pass" class="form-control">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-success btn-block my-3">
                  Registrasi
                </button>

                <!-- Register buttons -->
                <hr>
                <div class="text-center">
                  <p>Sudah memiliki akun ? Silakan masuk ke aplikasi</p>
                  
                  <a href="<?= base_url() ?>auth" class="btn btn-primary btn-block">
                    <i class="bi-box-arrow-in-right"></i>&nbsp;&nbsp;Login
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

  <!-- AOS -->
  <script src="<?= base_url('assets/'); ?>dist/js/aos.js"></script>
  <script>
    AOS.init({
      delay: 100,
      duration: 1000,
    });
  </script>

  <script>
    $("form").submit(function (event) {
      event.preventDefault();
      var data = new FormData($("#form_data")[0]);

      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>register/store",
        data: data,
        dataType: "json",
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function (data) {
        if(data.success == true) {
          Swal.fire({
            icon: 'success',
            title: 'SELAMAT !',
            text: 'Akun anda berhasil dibuat !',
            showConfirmButton: true
          }).then(function() {
            window.location = "<?= base_url() ?>auth/login";
          });
        } else {
          $.each(data.errors, function(index, value) {
            Swal.fire({
              icon: 'warning',
              title: 'PERHATIAN !',
              text: value,
              showConfirmButton: true
            })
          })
        }
      })
      .fail(function () {
        $.notify("Mohon periksa inputan dan koneksi jaringan anda");
      });
    });
  </script>
</body>
</html>