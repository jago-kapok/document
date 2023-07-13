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
	          <label class="col-md-4 col-form-label">Nama Perusahaan</label>
	          <span class="col-md-8">: <?= $company->company_name ?></span>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">Alamat Kantor</label>
	          <span class="col-md-8">: <?= $company->company_office_address ?></span>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">No. Telepon Kantor</label>
	          <span class="col-md-8">: <?= $company->company_phone ?></span>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">Bidang Usaha (KBLI)</label>
	          <span class="col-md-8">: <?= $company->company_business ?></span>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">Skala Usaha</label>
	          <span class="col-md-8">: <?= $company->company_business_scale ?></span>
	        </div>

			<div class="container-fluid bg-app rounded-3 py-1 px-2 my-3">
				<span class="text-light"><b>LOKASI KEGIATAN</b></span>
			</div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">Alamat / Lokasi Kegiatan</label>
	          <span class="col-md-8">: <?= $company->company_address ?></span>
	        </div>
			<div class="row mb-2">
			  <label class="col-md-4 col-form-label">Luas Lahan (m²)</label>
		  	  <span class="col-md-8">: <?= $company->company_land_area ?></span>
			</div>
		 	<div class="row mb-2">
			  <label class="col-md-4 col-form-label">Luas Bangunan (m²)</label>
			  <span class="col-md-8">: <?= $company->company_building_area ?></span>
			</div>
			<div class="row mb-2">
	          <label class="col-md-4 col-form-label">Penanggung Jawab</label>
	          <span class="col-md-8">: <?= $company->company_pic ?></span>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">No. Telepon / Handphone</label>
	          <span class="col-md-8">: <?= $company->company_pic_phone ?></span>
	        </div>
	      </div>
		</div>

		<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
	      <div class="card">
	      	<div class="container-fluid bg-app rounded-3 py-1 px-2 mb-3">
	      		<span class="text-light"><b>DOKUMEN - DOKUMEN</b></span>
	      	</div>   
	        <div class="row mb-3">
	          <label class="col-md-4 col-form-label">Struktur Organisasi (Bagan)</label>
	          <label class="col-md-8">
	          	<a href="<?= base_url('documents/').$company->company_folder.'/'.$company->company_organitation_file ?>" class="btn btn-success" target="_blank">
	          	  Lihat Dokumen
	          	</a>
	          </label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">Perijinan yang Dimiliki</label>
	          <label class="col-md-8">
	          	<a href="<?= base_url('documents/').$company->company_folder.'/'.$company->company_license_file ?>" class="btn btn-success" target="_blank">
	          	  Lihat Dokumen
	          	</a>
	          </label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-4 col-form-label">No. Rekomendasi</label>
	          <span class="col-md-8">: <?= $company->company_license_env ?></span>
	        </div>
	      </div>
	    </div>
  	</div>
</div>