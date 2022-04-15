<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Profil Perusahaan</li>
	  </ol>
	</nav>


	<div class="alert alert-info">
		Klik <a href="<?= base_url() ?>profile"><b>di sini</b></a> untuk merubah profile perusahaan.
	</div>

  <div class="card">
    <form id="form_data">
	    <div class="row">
	      <div class="col-md-12">
	      	<div class="container-fluid bg-info p-1 mb-2">
	      		<span class="text-light"><center><b>DATA PERUSAHAAN</b></center></span>
	      	</div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Nama Perusahaan</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_name ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Alamat Kantor</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_office_address ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">No. Telepon Kantor</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_phone ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Bidang Usaha (KBLI)</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_business ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Skala Usaha</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_business_scale ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Lokasi Kegiatan</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_address ?></label>
	        </div>
	      </div>
	      <div class="col-md-12">
	      	<div class="container-fluid bg-info p-1 mb-2">
	      		<span class="text-light"><center><b>CONTACT PERSON</b></center></span>
	      	</div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Penanggung Jawab</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_pic ?></label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">No. Telepon / Handphone</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_pic_phone ?></label>
	        </div>
	      </div>
	      <div class="col-md-12">
	      	<div class="container-fluid bg-info p-1 mb-3">
	      		<span class="text-light"><center><b>DOKUMEN - DOKUMEN</b></center></span>
	      	</div>	        
	        <div class="row mb-3">
	          <label class="col-md-3 col-form-label">Struktur Organisasi (Bagan)</label>
	          <label class="col-md-6">
	          	<a href="<?= base_url() ?>documents/<?php echo $company->company_folder ?>/<?php echo $company->company_organitation_file ?>" class="btn btn-success" target="_blank">
	          	  Lihat Dokumen
	          	</a>
	          </label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">Perijinan yang Dimiliki</label>
	          <label class="col-md-6">
	          	<a href="<?= base_url() ?>documents/<?php echo $company->company_folder ?>/<?php echo $company->company_license_file ?>" class="btn btn-success" target="_blank">
	          	  Lihat Dokumen
	          	</a>
	          </label>
	        </div>
	        <div class="row mb-2">
	          <label class="col-md-3 col-form-label">No. Rekomendasi</label>
	          <label class="col-md-6 col-form-label">: <?php echo $company->company_license_env ?></label>
	        </div>
	      </div>
	    </div>
  	</form>
  </div>
</div>