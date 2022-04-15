<div class="col-lg-10 mb-2">
    <div class="row" data-aos="zoom-in">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-kuesioner-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="card mb-2" style="padding: 8px 15px">
          <h6 class="mb-0"><strong>VI. KOORDINAT LOKASI DAN FOTO RUMAH</strong></h6>
        </div>
                
        <div class="card">
          <form id="form_data" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="main_id" value="<?php echo $main_id ?>">
          <label class="mb-2"><strong>1. Titik Koordinat Rumah</strong></label>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Latidue</label>
            <div class="col-sm-3">
              <input id="latitude" type="text" name="latitude" class="form-control form-control-sm">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Longitude</label>
            <div class="col-sm-3">
              <input id="longitude" type="text" name="longitude" class="form-control form-control-sm">
            </div>
          </div>

          <label class="mb-2"><strong>2. Foto Rumah</strong></label>

          <div class="row">
            <div class="col-lg-6 mb-3">
              <div class="card">
                <img id="previewImg1" class="card-img-top" style="width: 200px; display: block; margin-left: auto; margin-right: auto">
                <div class="card-body">
                  <h6 class="card-title">Foto Rumah : Tampak Depan</h6>
                  <div class="input-group input-group-sm">
                    <input id="1" type="file" name="files1" class="form-control form-control-sm file1" onchange="previewFile(this, 1)">
                    <button type="button" class="btn btn-danger" onclick="resetFile(1)"><i class="bi-x-circle"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-3">
              <div class="card">
                <img id="previewImg2" class="card-img-top" style="width: 200px; display: block; margin-left: auto; margin-right: auto">
                <div class="card-body">
                  <h6 class="card-title">Foto Rumah : Tampak Dalam</h6>
                  <div class="input-group input-group-sm">
                    <input id="2" type="file" name="files2" class="form-control form-control-sm file2" onchange="previewFile(this, 2)">
                    <button type="button" class="btn btn-danger" onclick="resetFile(2)"><i class="bi-x-circle"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 mb-3">
              <div class="card">
                <img id="previewImg3" class="card-img-top" style="width: 200px; display: block; margin-left: auto; margin-right: auto">
                <div class="card-body">
                  <h6 class="card-title">Foto Rumah : Tampak Samping (Opsional)</h6>
                  <div class="input-group input-group-sm">
                    <input id="3" type="file" name="files3" class="form-control form-control-sm file3" onchange="previewFile(this, 3)">
                    <button type="button" class="btn btn-danger" onclick="resetFile(3)"><i class="bi-x-circle"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-3">
              <div class="card">
                <img id="previewImg4" class="card-img-top" style="width: 200px; display: block; margin-left: auto; margin-right: auto">
                <div class="card-body">
                  <h6 class="card-title">Foto Rumah : Tampak Samping / Belakang (Opsional)</h6>
                  <div class="input-group input-group-sm">
                    <input id="4" type="file" name="files4" class="form-control form-control-sm file4" onchange="previewFile(this, 4)">
                    <button type="button" class="btn btn-danger" onclick="resetFile(4)"><i class="bi-x-circle"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <div class="modal-footer">
              <button type="submit" class="btn btn-success float-end"><i class="bi-clipboard-check">&nbsp;&nbsp;</i>Simpan Hasil Survey</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-2" data-aos="fade-up">
  <div class="list-group">
    <li class="list-group-item list-group-item-secondary">TAHAP PENGISIAN</li>
    <a href="<?= base_url() ?>input/quest/1" class="list-group-item list-group-item-action disabled">KUISIONER 1</a>
    <a href="<?= base_url() ?>input/quest/2" class="list-group-item list-group-item-action disabled">KUISIONER 2</a>
    <a href="<?= base_url() ?>input/quest/3" class="list-group-item list-group-item-action disabled">KUISIONER 3</a>
    <a href="<?= base_url() ?>input/quest/4" class="list-group-item list-group-item-action disabled">KUISIONER 4</a>
    <a href="<?= base_url() ?>input/quest/5" class="list-group-item list-group-item-action disabled">KUISIONER 5</a>
    <a href="<?= base_url() ?>input/quest/6" class="list-group-item list-group-item-action active">KUISIONER 6</a>
  </div>

  <div class="card mt-2">
    <a href="<?= base_url() ?>" class="btn btn-outline-danger">Kembali ke Beranda</a>
  </div>
</div>

<script>
  function previewFile(input, id){
    var file = $("#" + id).get(0).files[0];
    $("#previewImg" + id).show();

    if(file){
      var reader = new FileReader();

      reader.onload = function(){
          $("#previewImg" + id).attr("src", reader.result);
      }

      reader.readAsDataURL(file);
    }
  }

  function resetFile(id) {
    const file = document.querySelector('.file' + id);
    file.value = '';

    $("#previewImg" + id).attr("src", "").hide();
  }

  $("form").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#form_data")[0]);

    Swal.fire({
      title: 'Akhiri survey',
      text: "Simpan semua data survey ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>input/input6_create",
          data: data,
          dataType: "json",
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          // encode: true,
        })
        .done(function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Data survey berhasil disimpan !',
            showConfirmButton: false,
            timer: 2000
          })
          setInterval(() => {
            window.location = "<?= base_url() ?>";
          }, 1000);
        });
      }
    })
  });
</script>
