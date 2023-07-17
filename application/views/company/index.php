<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Perusahaan</li>
		</ol>
	</nav>

	<div class="card" data-aos="fade-up">
		<div class="row mb-1">
			<div class="col-auto me-auto">
				<a href="<?= base_url('company/create') ?>" class="btn btn-primary">
					<span class="btn-icon" data-feather="plus-square"></span>
					&nbsp;Tambah Data
				</a>
			</div>
			<div class="col-md-4">
				<input id="searching" class="form-control" placeholder="Pencarian Data ...">
			</div>
			<div class="col-auto">
				<select id="pagelength" class="form-select" readonly>
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
			</div>
		</div>
		<div class="table-responsive">
			<table id="table_data" class="table table-striped" width="100%">
				<thead class="bg-app text-light">
					<tr>
						<th width="5">No.</th>
						<th width="100">Nama Perusahaan</th>
						<th width="100">Bidang Usaha</th>
						<th width="100">Alamat</th>
						<th width="100">Penanggung Jawab</th>
						<th width="50">Pilihan</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>