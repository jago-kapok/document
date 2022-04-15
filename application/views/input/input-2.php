<div class="col-lg-10 mb-2">
  <div data-aos="zoom-in">
    <div class="row">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-kuesioner-2" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <div class="card mb-2" style="padding: 8px 15px">
            <h6 class="mb-0"><strong>II. KETERANGAN PETUGAS DAN RESPONDEN</strong></h6>
          </div>
          
          <div class="card">
          <form id="form_data">
            <input type="hidden" name="main_id" value="<?php echo $main_id ?>">
            <div class="row">
              <div class="col-lg-6">
                <div class="row mb-3">
                  <label class="col-lg-5 col-form-label">Tanggal Pencacahan <span class="text-danger">*</span></label>
                  <div class="col-lg-4">
                    <input id="tanggal_pencacahan" type="date" name="tanggal_pencacahan" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-lg-5 col-form-label">Nama Pencacah <span class="text-danger">*</span></label>
                  <div class="col-lg-6">
                    <div class="input-group input-group-sm">
                      <input id="nama_pencacah" type="text" name="nama_pencacah" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-lg-5 col-form-label">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                  <div class="col-lg-4">
                    <input id="tanggal_pemeriksaan" type="date" name="tanggal_pemeriksaan" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-lg-5 col-form-label">Nama Pemeriksa <span class="text-danger">*</span></label>
                  <div class="col-lg-6">
                    <div class="input-group input-group-sm">
                      <input id="nama_pemeriksa" type="text" name="nama_pemeriksa" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="col-form-label">Hasil Pencacahan Rumah Tangga :</label>
                  <div class="col-lg-11">
                    <select id="hasil_pencacahan" name="hasil_pencacahan" class="form-select form-select-sm">
                      <option disabled selected>--- Pilih status hasil pencacahan rumah tangga ---</option>
                      <?php foreach($hasil_pencacahan as $data) { ?>
                        <option value="<?php echo $data['id'] ?>"><?php echo $data['id'].". ".$data['desc'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <!-- <div id="bagian_no_ruta" class="row mb-3">
                  <label class="col-lg-4 col-form-label">No. KK</label>
                  <div class="col-lg-3">
                    <input id="bagian_no_ruta_value" type="number" name="bagian_no_ruta" class="form-control form-control-sm">
                  </div>
                </div> -->
              </div>
            </div>

            <div class="row mt-2">
              <div class="modal-footer">
                <button id="simpanData" type="submit" class="btn btn-primary float-end"><i class="bi-clipboard-check">&nbsp;&nbsp;</i>Simpan & Lanjutkan</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-2" data-aos="fade-up">
  <div class="list-group">
    <li class="list-group-item list-group-item-secondary">TAHAP PENGISIAN</li>
    <a href="<?= base_url() ?>input/quest/1" class="list-group-item list-group-item-action disabled">KUISIONER 1</a>
    <a href="<?= base_url() ?>input/quest/2" class="list-group-item list-group-item-action active">KUISIONER 2</a>
    <a href="<?= base_url() ?>input/quest/3" class="list-group-item list-group-item-action disabled">KUISIONER 3</a>
    <a href="<?= base_url() ?>input/quest/4" class="list-group-item list-group-item-action disabled">KUISIONER 4</a>
    <a href="<?= base_url() ?>input/quest/5" class="list-group-item list-group-item-action disabled">KUISIONER 5</a>
    <a href="<?= base_url() ?>input/quest/6" class="list-group-item list-group-item-action disabled">KUISIONER 6</a>
  </div>

  <div class="card mt-2">
    <a href="<?= base_url() ?>" class="btn btn-outline-danger">Kembali ke Beranda</a>
  </div>
</div>

<script>
  $("form").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#form_data")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>input/input2_create",
      data: data,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
       // encode: true,
    })
    .done(function (data) {
      $("#simpanData").attr("disabled", true);

      if(data.success == true) {
        $.notify("Data berhasil disimpan !", "success");

        setInterval(function () {
          window.location = "<?= base_url() ?>input/quest/3/" + data.main_id;
        }, 1200);
      } else {
        $.each(data.errors, function(index, item) {
          $.notify(item, "error");
        });
      }
    })
    .fail(function() {
      $.notify("Terjadi kesalahan saat koneksi ke server !", "error");
    });
  });
</script>