<div class="container-fluid mt-2">
	<div class="alert alert-info" data-aos="zoom-out">
		<b><i class="bi-info-circle"></i>&nbsp;&nbsp;Monitoring Status Pelaporan Dokumen Lingkungan</b>
	</div>

	<div class="row" data-aos="zoom-in">
		<?php foreach ($doc as $key => $value) { ?>
			<div class="col-md-4">
				<div class="card border-<?php echo $color = $value['doc_status'] == 2 ? 'primary' : $value['status_color'] ?> p-3" style="border: 2px solid">
					<div class="d-flex justify-content-between mb-1">
						<div>
							<h6 class="text-black-50 mb-1"><strong><?php echo $value['file_type_desc'] ?></strong></h6>
							<span class="text-muted" style="font-size: 0.8rem">Tanggal Submit : <i><?php echo date('d-m-Y H:i', strtotime($value['doc_modified_at'])) ?></i></span><br>
							<span class="text-muted" style="font-size: 0.8rem">Tanggal Verifikasi : 
								<i><?php echo $verified_at = $value['doc_verified_at'] == '' ? '-' : date('d-m-Y H:i', strtotime($value['doc_verified_at'])) ?></i></span>
						</div>
					</div>

					<div class="d-flex justify-content-between mt-3">
						<div><a href="<?= base_url() ?>reports/<?php echo $value['doc_folder'] ?>/<?php echo $value['doc_file'] ?>" class="btn btn-sm btn-primary" target="_blank">Lihat Dokumen</a></div>
						<div class="text-end"><span class="badge bg-<?php echo $value['status_color'] ?> p-2"><?php echo $value['status_desc'] ?></span></div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>