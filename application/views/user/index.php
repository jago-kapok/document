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

	<div class="card">
	  <div class="row mb-2">
			<div class="col-md-8 mb-1">
			  <!-- <a href="<?= base_url() ?>user/create" class="btn btn-primary"><span class="btn-icon" data-feather="plus-square"></span>
			    &nbsp;&nbsp;Tambah Data
			  </a> -->
			</div>
			<div class="col-md-4 pull-right">
			  <div class="input-group">
				<input id="searching" class="form-control input-pagelength" placeholder="Cari Data ...">
				<select id="pagelength" class="form-select" readonly>
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
		        <th>Username</th>
		        <th>Hak Akses</th>
		        <th>Nama Perusahaan</th>
		        <th>Status</th>
		        <th>Pilihan</th>
		      </tr>
		    </thead>
		  </table>
		</div>
	</div>
</div>