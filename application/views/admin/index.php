<div class="container-fluid mt-2">
<div class="row" data-aos="zoom-out">
	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<!-- <h5 class="card-title m-0">Semua Pelaporan</h5> -->
						<h1><?= $all ?></h1>
					</div>
					<div class="col-auto">
						<div class="stat bg-primary">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<div class="mt-2 mb-0">
					<span class="text-primary fw-bold">Semua Pelaporan</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<!-- <h5 class="card-title m-0">Menunggu Verifikasi</h5> -->
						<h1><?= $waiting ?></h1>
					</div>
					<div class="col-auto">
						<div class="stat bg-warning">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<div class="mt-2 mb-0">
					<span class="text-warning fw-bold">Menunggu Verifikasi</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<!-- <h5 class="card-title m-0">Sudah Verifikasi</h5> -->
						<h1><?= $verified ?></h1>
					</div>
					<div class="col-auto">
						<div class="stat bg-success">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<div class="mt-2 mb-0">
					<span class="text-success fw-bold">Sudah Verifikasi</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<!-- <h5 class="card-title m-0">Perusahaan</h5> -->
						<h1><?= $company ?></h1>
					</div>
					<div class="col-auto">
						<div class="stat bg-info">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<div class="mt-2 mb-0">
					<span class="text-info fw-bold">Perusahaan Terdaftar</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card p-0" data-aos="fade-in">
			<div class="card-header bg-app">
				<h5 class="card-title text-light m-0">Laporan Menunggu Verifikasi</h5>
			</div>

			<div class="card-body">
				<table id="table_data" class="table table-striped" width="100%">
					<thead class="bg-info text-light">
						<tr>
							<th>No.</th>
							<th>Tahun</th>
							<th>Periode</th>
							<th>Informasi Perusahaan</th>
							<th>Progress</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($doc as $key => $val): ?>
							<tr>
								<td><?= $key + 1 ?></td>
								<td><?= $val['doc_year'] ?></td>
								<td>SMT. <?= $val['doc_periode'] ?></td>
								<td><?= $val['company_name'] ?><br><b>Lokasi Kegiatan : </b><?= $val['company_address'] ?></td>
								<td>
									<div class="progress">
									  	<div class="progress-bar bg-success" style="width: <?= $val['verified'] ?>0%"
									  		aria-valuenow="<?= $val['verified'] ?>0" aria-valuemin="0" aria-valuemax="80">
									  		<?= $val['verified'] ?>
									  	</div>
									  	<div class="progress-bar bg-danger" style="width: <?= $val['revision'] ?>0%"
									  		aria-valuenow="<?= $val['revision'] ?>0" aria-valuemin="0" aria-valuemax="80">
									  		<?= $val['revision'] ?>
								  		</div>
									</div>
								</td>
								<td>
									<a href="verify/view/<?= $val['doc_id'] ?>" class="btn btn-sm btn-success">
										<i class="bi-check-square"></i>&nbsp; Verifikasi
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	var options = {
	  chart: {
	    type: 'bar',
	    height: 400
	  },
	  title: {
	    text: "Hasil Survey per Kecamatan di Kab. Bojonegoro",
	    align: 'left',
	    style: {
	    	fontSize: '15px',
	    	fontWeight: 'bold',
	    	fontFamily: 'Arial'
	    }
	  },
	  series: [{
	    name: 'survey',
	    data: [30,40,45,50,49,60,70,91,125,150,165]
	  }],
	  xaxis: {
	    categories: ['Ngraho', 'Tambakrejo', 'Ngambon', 'Ngasem', 'Bubulan', 'Dander', 'Sugihwaras', 'Kedungadem', 'Kepohbaru', 'Baureno', 'Kanor']
	  }
	}

	var chart = new ApexCharts(document.querySelector("#chart"), options);

	chart.render();
</script>