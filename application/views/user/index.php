<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<?php if ($this->session->user_level == 1) { ?>
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<?php } else { ?>
			<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/user">Beranda</a></li>
			<?php } ?>
			<li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
		</ol>
	</nav>

	<div class="card" data-aos="fade-up">
		<div class="row mb-1">
			<div class="col-auto me-auto"></div>
			<div class="col-md-3">
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
						<th>No.</th>
						<th>Nama Profil</th>
						<th>Username</th>
						<th>Perusahaan</th>
						<th>Hak Akses</th>
						<th>Status</th>
						<th>Pilihan</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>