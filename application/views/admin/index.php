<div class="container-fluid mt-2">
<div class="row" data-aos="zoom-out">
	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title m-0">Semua Pelaporan</h5>
					</div>
					<div class="col-auto">
						<div class="stat bg-primary">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<h1>47.482</h1>
				<div class="mb-0">
					<span class="badge bg-success"> <i class="mdi mdi-arrow-bottom-right"></i> 2 laporan</span>
					<span class="text-muted">hari ini</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title m-0">Menunggu Verifikasi</h5>
					</div>
					<div class="col-auto">
						<div class="stat bg-warning">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<h1>47.482</h1>
				<div class="mb-0">
					<span class="text-muted">Sampai hari ini</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title m-0">Sudah Verifikasi</h5>
					</div>
					<div class="col-auto">
						<div class="stat bg-success">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<h1>47.482</h1>
				<div class="mb-0">
					<span class="text-muted">Sampai hari ini</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-1">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title m-0">Perusahaan</h5>
					</div>
					<div class="col-auto">
						<div class="stat bg-info">
							<i class="bi-file-earmark-text text-light fs-3"></i>
						</div>
					</div>
				</div>
				<h1>47.482</h1>
				<div class="mb-0">
					<span class="text-muted">Jumlah perusahaan terdaftar</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card" data-aos="fade-in">
			<h5 class="card-title mb-3">Data Laporan Masuk</h5>
			<table id="table_data" class="table table-striped" width="100%">
				<thead class="bg-info text-light">
					<tr>
						<th>No.</th>
						<th>Tahun</th>
						<th>Periode</th>
						<th>Informasi Perusahaan</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($doc as $key => $val): ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $val['doc_year'] ?></td>
							<td>Semester <?= $val['doc_periode'] ?></td>
							<td><?= $val['company_name'] ?><br><b>Lokasi Kegiatan : </b><?= $val['company_address'] ?></td>
							<td>
								<a href="verify/view/<?= $val['doc_id'] ?>" class="btn btn-sm btn-success"><i class="bi-check"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
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