<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('company') ?>">Data Perusahaan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
		</ol>
	</nav>
	
	<form id="form_data" class="row" enctype="multipart/form-data">
		<input type="hidden" name="company_id" class="form-control" value="<?= $company->company_id ?>">
	    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
	      	<div class="card">
				<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
					<span class="text-light"><b>DATA PERUSAHAAN</b></span>
				</div>
				<div class="row">
					<div class="col-md-12 mb-3">
						<label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
						<input type="text" name="company_name" class="form-control" value="<?= $company->company_name ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Alamat Kantor <span class="text-danger">*</span></label>
						<textarea name="company_office_address" class="form-control" rows="3"><?= $company->company_office_address ?></textarea>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">No. Telepon Kantor<span class="text-danger">*</span></label>
						<input type="text" name="company_phone" class="form-control" value="<?= $company->company_phone ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Bidang Usaha (KBLI) <span class="text-danger">*</span></label>
						<input type="text" name="company_business" class="form-control" value="<?= $company->company_business ?>">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Skala Usaha <span class="text-danger">*</span></label>
						<input type="text" name="company_business_scale" class="form-control" value="<?= $company->company_business_scale ?>">
					</div>
				</div>

				<div class="container-fluid bg-app rounded-3 py-1 px-2 my-3">
					<span class="text-light"><b>LOKASI KEGIATAN</b></span>
				</div>
				<div class="row">
					<div class="col-md-12 mb-3">
						<label class="form-label">Alamat / Lokasi Kegiatan <span class="text-danger">*</span></label>
						<textarea name="company_address" class="form-control" rows="3"><?= $company->company_address ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Luas Lahan (m²) <span class="text-danger">*</span></label>
						<input type="text" name="company_land_area" class="form-control" value="<?= $company->company_land_area?>">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Luas Bangunan (m²) <span class="text-danger">*</span></label>
						<input type="text" name="company_building_area" class="form-control" value="<?= $company->company_building_area ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
						<input type="text" name="company_pic" class="form-control" value="<?= $company->company_pic ?>">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">No. Telepon <span class="text-danger">*</span></label>
						<input type="text" name="company_pic_phone" class="form-control" value="<?= $company->company_pic_phone ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
			<div class="card">
				<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
					<span class="text-light"><b>DOKUMEN - DOKUMEN</b></span>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Struktur Organisasi (Bagan) <span class="text-danger">*</span></label>
					<div class="col-md-7">
					  <input type="file" name="struktur_organisasi" class="form-control">
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Perijinan yang Dimiliki <span class="text-danger">*</span></label>
					<div class="col-md-7">
					  <input type="file" name="perijinan" class="form-control">
					  <div class="form-text">Jika ada lebih dari satu perijinan, harap dijadikan dalam satu file PDF</div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">No. Rekomendasi <span class="text-danger">*</span></label>
					<div class="col-md-7">
					  <input type="text" name="company_license_env" class="form-control" value="<?= $company->company_license_env ?>">
					  <div class="form-text">No. Rekomendasi / Persetujuan Dokumen Lingkungan</div>
					</div>
				</div>
				<hr>
				<div class="justify-content-start p-0">
					<button type="submit" class="btn btn-primary"><span class="btn-icon" data-feather="save"></span>&nbsp;&nbsp;Simpan</button>
					<a href="<?= base_url('company') ?>" class="btn btn-danger ms-1"><span class="btn-icon" data-feather="slash"></span>&nbsp;&nbsp;Kembali</a>
				</div>
			</div>
		</div>
  	</form>
</div>
<script>
	$("form").submit(function (event) {
		event.preventDefault();
		var data = new FormData($("#form_data")[0]);
		
		$.ajax({
			type: "POST",
			url: "<?= base_url('company/edit') ?>",
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
					window.location = "<?= base_url('company') ?>";
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