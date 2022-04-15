<!-- Section: Design Block -->
  <div class="container px-4 py-1 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-8 offset-md-2 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 px-md-4">
            <form id="form_data">
              <center><h4><b>FORM</b> REGISTRASI</h4></center><hr>

              <div class="col-md-12">
                <div class="container-fluid p-1 mb-3" style="background-color: #354f7e">
                  <span class="text-light"><center><b>DATA PERUSAHAAN</b></center></span>
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
                <div class="row mb-3">
                  <label class="col-md-4 col-form-label">Lokasi Kegiatan <span class="text-danger">*</span></label>
                  <div class="col-md-8">
                    <textarea name="company_address" class="form-control" rows="2"></textarea>
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
      $.notify("Terjadi masalah saat koneksi ke server !");
    });
  });
</script>