<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
	    <?php if ($url == 'verify'): ?>
	    	<li class="breadcrumb-item active" aria-current="page">Verifikasi Laporan</li>
	    <?php else: ?>
	    	<li class="breadcrumb-item active" aria-current="page">Semua Laporan</li>
	    <?php endif; ?>
	  </ol>
	</nav>

	<div class="card">
	  <div class="row mb-2">
			<div class="col-md-2">
				<select id="yearFilter" class="form-select">
				  <option value="">Semua Tahun</option>
				  <?php foreach ($year as $row): ?>
				  	<option value="<?= $row['doc_year'] ?>"><?= $row['doc_year'] ?></option>
				  <?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-3 me-auto">
				<select id="periodeFilter" class="form-select">
				  <option value="">Semua Periode</option>
				  <option value="1">Semester 1</option>
				  <option value="2">Semester 2</option>
				</select>
			</div>
			<div class="col-md-5 pull-right">
			  <div class="input-group">
				<input id="searching" class="form-control input-pagelength w-75" placeholder="Cari Data ...">
				<select id="pagelength" class="form-select w-25" readonly>
				  <option value="10">10</option>
				  <option value="25">25</option>
				  <option value="50">50</option>
				  <option value="100">100</option>
				</select>
			  </div>
			</div>
	  </div>
	  <div class="table-responsive">
		  <table id="table_data" class="table table-striped" width="100%">
				<thead class="bg-secondary text-light">
				  <tr>
						<th>No.</th>
						<th>Tahun</th>
						<th>Periode</th>
		        <th>Informasi Perusahaan</th>
		        <th>PIC</th>
		        <th>Status</th>
		        <th>Pilihan</th>
		      </tr>
		    </thead>
		  </table>
	  </div>
</div>
