<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('company') ?>">Data Perusahaan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Lihat Detail</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
			<div class="card">
				<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
					<span class="text-light"><b>DATA PERUSAHAAN</b></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Nama Perusahaan</label>
					<span class="col-md-7 col-form-label"><?= $company->company_name ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Alamat Kantor</label>
					<span class="col-md-7 col-form-label"><?= $company->company_office_address ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">No. Telepon Kantor</label>
					<span class="col-md-7 col-form-label"><?= $company->company_phone ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Bidang Usaha (KBLI)</label>
					<span class="col-md-7 col-form-label"><?= $company->company_business ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Skala Usaha</label>
					<span class="col-md-7 col-form-label"><?= $company->company_business_scale ?></span>
				</div>
				<div class="container-fluid bg-app rounded-3 py-1 px-2 my-3">
					<span class="text-light"><b>LOKASI KEGIATAN</b></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Alamat / Lokasi Kegiatan</label>
					<span class="col-md-7 col-form-label"><?= $company->company_address ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Luas Lahan (m²)</label>
					<span class="col-md-7 col-form-label"><?= $company->company_land_area ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Luas Bangunan (m²)</label>
					<span class="col-md-7 col-form-label"><?= $company->company_building_area ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Penanggung Jawab</label>
					<span class="col-md-7 col-form-label"><?= $company->company_pic ?></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">No. Telepon / Handphone</label>
					<span class="col-md-7 col-form-label"><?= $company->company_pic_phone ?></span>
				</div>
			</div>
		</div>

		<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
			<div class="card">
				<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
					<span class="text-light"><b>DOKUMEN - DOKUMEN</b></span>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Struktur Organisasi (Bagan)</label>
					<label class="col-md-7 col-form-label">
						<?php if ($company->company_organitation_file) { ?>
							<a href="<?= base_url('documents/').$company->company_folder.'/'.$company->company_organitation_file ?>" class="btn btn-sm btn-success me-1" target="_blank">
								<i class="bi-file-earmark-text"></i>&nbsp; Lihat Dokumen
							</a>
						<?php } ?>
						<button type="button" class="btn btn-sm btn-info" onclick="showModalUpload(1)">
							<i class="bi-pencil-square"></i>&nbsp; Upload
						</button>
					</label>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">Perijinan yang Dimiliki</label>
					<label class="col-md-7 col-form-label">
						<?php if ($company->company_license_file) { ?>
							<a href="<?= base_url('documents/').$company->company_folder.'/'.$company->company_license_file ?>" class="btn btn-sm btn-success me-1" target="_blank">
								<i class="bi-file-earmark-text"></i>&nbsp; Lihat Dokumen
							</a>
						<?php } ?>
						<button type="button" class="btn btn-sm btn-info" onclick="showModalUpload(2)">
							<i class="bi-pencil-square"></i>&nbsp; Upload
						</button>
					</label>
				</div>
				<div class="row mb-2">
					<label class="col-md-5 col-form-label">No. Rekomendasi</label>
					<span class="col-md-7 col-form-label"><?= $company->company_license_env ?></span>
				</div>
			</div>

			<a href="<?= base_url('company/update/').$company->company_id ?>" class="btn btn-info w-100">
				<i class="bi-pencil-square"></i>&nbsp; Edit Perusahaan
			</a>
		</div>
	</div>
</div>