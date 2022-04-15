<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>company">Data Perusahaan</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
	  </ol>
	</nav>

  <div class="card">
    <form id="form_data" enctype="multipart/form-data">
	    <div class="row">
	      <div class="col-md-12">
	      	<div class="container-fluid bg-secondary p-1 mb-3">
	      		<span class="text-light"><center><b>DATA PERUSAHAAN</b></center></span>
	      	</div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Nama Perusahaan <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_name" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Alamat Kantor <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <textarea name="company_office_address" class="form-control" rows="2"></textarea>
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">No. Telepon Kantor <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_phone" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Bidang Usaha (KBLI) <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_business" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Skala Usaha <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_business_scale" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Lokasi Kegiatan <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <textarea name="company_address" class="form-control" rows="2"></textarea>
	          </div>
	        </div>
	      </div>
	      <div class="col-md-12">
	      	<div class="container-fluid bg-secondary p-1 mb-3">
	      	 	<span class="text-light"><center><b>CONTACT PERSON</b></center></span>
	      	</div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Penanggung Jawab <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_pic" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">No. Telepon / Handphone <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_pic_phone" class="form-control">
	          </div>
	        </div>
	      </div>
	      <div class="col-md-12">
	      	<div class="container-fluid bg-secondary p-1 mb-3">
	      	 	<span class="text-light"><center><b>DOKUMEN - DOKUMEN</b></center></span>
	      	</div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Struktur Organisasi (Bagan) <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="file" name="struktur_organisasi" class="form-control">
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Perijinan yang Dimiliki <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="file" name="perijinan" class="form-control">
	            <div class="form-text">Jika ada lebih dari satu perijinan, harap dijadikan dalam satu file PDF</div>
	          </div>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">No. Rekomendasi <span class="text-danger">*</span></label>
	          <div class="col-md-6">
	            <input type="text" name="company_license_env" class="form-control">
	            <div class="form-text">No. Rekomendasi / Persetujuan Dokumen Lingkungan</div>
	          </div>
	        </div>
	      </div>

	      <div class="modal-footer justify-content-start">
	        	<button type="submit" class="btn btn-primary"><span class="btn-icon" data-feather="save"></span>&nbsp;&nbsp;Simpan</button>
	        	<a href="<?= base_url() ?>company" class="btn btn-danger ms-1"><span class="btn-icon" data-feather="slash"></span>&nbsp;&nbsp;Kembali</a>
	        </div>
	    </div>
  	</form>
  </div>
</div>

<script>
	$("form").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#form_data")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>company/store",
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
          title: 'Data berhasil disimpan !',
          showConfirmButton: false,
          timer: 1500
        })

        setInterval(() => {
          window.location = "<?= base_url() ?>company";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          $.notify(value, "error");
        })
      }
    })
    .fail(function () {
      $.notify("Terjadi masalah saat koneksi ke server !");
    });
  });
</script>