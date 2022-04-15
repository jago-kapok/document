<!-- <div class="container-fluid mt-2">
<div class="row" data-aos="zoom-out">
	<div class="col-md-3">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Survey Hari Ini</strong></h6>
					<h3 class=""><strong><?php echo $survey_hari_ini ?></strong> <span style="font-size: 1rem">KK</span></h3>
				</div>

				<div class="btn card-icon" style="background-color: #d0e1fd">
					<i class="bi-file-earmark-check text-primary"></i>
				</div>
			</div>
			<span class="text-muted">Selisih <span style="color: <?php echo $perbandingan_color ?>"><strong><?php echo $perbandingan_sekarang_kemarin ?></strong></span> dari hari sebelumnya</span>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Total Survey Masuk</strong></h6>
					<h3 class=""><strong><?php echo $total_survey ?></strong> <span style="font-size: 1rem">KK</span></h3>
				</div>

				<div class="btn card-icon" style="background-color: #80f1af">
					<i class="bi-file-earmark-text text-success"></i>
				</div>
			</div>
			<span class="text-muted"><span style="color: #22c55e"><strong><i class="bi-arrow-up"></i><?php echo round($total_survey_persen, 2) ?>%</strong></span> dari total sebelumnya</span>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Kecamatan</strong></h6>
					<h3 class=""><strong>28</strong></h3>
				</div>

				<div class="btn card-icon" style="background-color: #ead6fd">
					<i class="bi-map text-secondary"></i>
				</div>
			</div>
			<span class="text-muted"><span style="color: #22c55e"><strong></strong></span>Jumlah kecamatan</span>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Desa / Kelurahan</strong></h6>
					<h3 class=""><strong>430</strong></h3>
				</div>

				<div class="btn card-icon" style="background-color: #feddc7">
					<i class="bi-geo-alt text-danger"></i>
				</div>
			</div>
			<span class="text-muted">Jumlah desa dan kelurahan</span>
		</div>
	</div>
</div>

<div class="card mt-3" data-aos="fade-up">
	<div id="chart"></div>
</div>

<div class="card mt-3" data-aos="fade-in">
  <div class="row mb-1">
	<div class="col-md-8">
	  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_create"><i class="bi-filter-square"></i>
	    &nbsp;&nbsp;Filter Data
	  </button>
	</div>
	<div class="col-md-4 pull-right">
	  <div class="input-group">
		<input id="searching" class="form-control form-control-sm" placeholder="Cari Data ...">
		<div class="input-group-prepend">
		  <div class="">
			<select id="pagelength" class="form-control form-control-sm" readonly>
			  <option value="10">10</option>
			  <option value="25">25</option>
			  <option value="50">50</option>
			  <option value="100">100</option>
			</select>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <table id="table_data" class="table table-bordered table-striped" width="100%">
		<thead class="bg-secondary text-light" style="background-color: #8b8b8b">
    	<tr>
				<th width="20">#</th>
        <th width="100">Tanggal Input</th>
        <th width="200">Kecamatan</th>
        <th width="200">Desa</th>
        <th width="200">Nomor KK</th>
        <th width="200">Nama Kepala Keluarga</th>
        <th width="200">Jumlah Anggota Keluarga</th>
        <th width="100">Pilihan</th>
      </tr>
    </thead>
  </table>
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
</script> -->