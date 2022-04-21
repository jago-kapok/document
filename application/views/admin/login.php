<!-- Section: Design Block -->
  <div class="container px-4 py-2 px-md-5 text-lg-start mb-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-7 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          SIPP DOKLING <br />
          <span style="color: hsl(218, 81%, 75%); font-size: 80%">Dinas Lingkungan Hidup</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
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
            <form action="auth/login" method="POST">
              <center><h4><b>FORM</b> LOGIN</h4></center><hr>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <?= $this->session->flashdata('message'); ?>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="form-outline">
                    <label class="form-label" for="form3Example1">Username / Email</label>
                    <input type="text" name="user_name" class="form-control" required/>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-3">
                <label class="form-label" for="form3Example3">Password</label>
                <input type="password" name="user_auth" class="form-control" required/>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-3">
                Masuk
              </button>

              <!-- Register buttons -->
              <hr>
              <div class="text-center">
                <p>Anda belum memiliki akun ? Silakan registrasi terlebih dahulu</p>
                
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