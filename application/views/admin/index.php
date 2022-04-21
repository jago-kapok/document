<div class="container-fluid mt-2">
<div class="row" data-aos="zoom-out">
	<div class="col-md-4">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Total Laporan Masuk</strong></h6>
					<h2 class=""><strong>20</strong> <span style="font-size: 1rem">dokumen</span></h2>
				</div>

				<div class="btn card-icon" style="background-color: #d0e1fd">
					<i class="bi-file-earmark-text text-primary" style="font-size: 30px"></i>
				</div>
			</div>
			<span class="text-muted"></span>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Total Laporan Diverifikasi</strong></h6>
					<h2 class=""><strong>18</strong> <span style="font-size: 1rem">dokumen</span></h2>
				</div>

				<div class="btn card-icon" style="background-color: #80f1af">
					<i class="bi-file-earmark-check text-success" style="font-size: 30px"></i>
				</div>
			</div>
			<span class="text-muted"></span>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card p-4">
			<div class="d-flex justify-content-between mb-1">
				<div>
					<h6 class="text-black-50 mb-2"><strong>Total Perusahaan</strong></h6>
					<h2 class=""><strong>25</strong> <span style="font-size: 1rem">perusahaan</span></h2>
				</div>

				<div class="btn card-icon" style="background-color: #feddc7">
					<i class="bi-map text-info" style="font-size: 30px"></i>
				</div>
			</div>
			<span class="text-muted"></span>
		</div>
	</div>
</div>

<div class="card" data-aos="fade-in">
  <table id="table_data" class="table table-bordered table-striped" width="100%">
		<thead class="bg-secondary text-light" style="background-color: #8b8b8b">
    	<tr>
        <th width="200" class="text-center">Nama Perusahaan</th>
        <th width="200" class="text-center">Deskripsi Kegiatan</th>
        <th width="200" class="text-center">Laporan RKL-RPL</th>
        <th width="200" class="text-center">Laporan PPA</th>
        <th width="200" class="text-center">Laporan PPU</th>
        <th width="200" class="text-center">Laporan PL</th>
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
</script>