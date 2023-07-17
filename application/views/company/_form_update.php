<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('company') ?>">Perusahaan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
		</ol>
	</nav>
	
	<div class="card" data-aos="fade-up">
		<form id="form_data" class="row gx-4" enctype="multipart/form-data">
			<input type="hidden" name="mode_form" value="Edit">
			<input type="hidden" name="company_id" class="form-control" value="<?= $company->company_id ?>">
	    	<div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
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
			</div>

			<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
				<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
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
				<div class="row">
					<div class="col-md-12 mb-3">
						<label class="form-label">No. Rekomendasi <span class="text-danger">*</span></label>
					  	<input type="text" name="company_license_env" class="form-control" value="<?= $company->company_license_env ?>">
					  	<div class="form-text">No. Rekomendasi / Persetujuan Dokumen Lingkungan</div>
					</div>
				</div>
			</div>
		</form>

		<div class="col-md-12 border-top pt-3">
			<button id="submit_form" type="submit" class="btn btn-primary"><span class="btn-icon" data-feather="save"></span>&nbsp;Simpan</button>
			<a href="<?= base_url('company/view/').$company->company_id ?>" class="btn btn-danger ms-1">
				<span class="btn-icon" data-feather="slash"></span>&nbsp;Kembali
			</a>
		</div>
  	</div>
</div>