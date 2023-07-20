<div class="container-fluid mt-2">
	<div class="alert alert-info" data-aos="zoom-out">
		<b><i class="bi-info-circle"></i>&nbsp;&nbsp;Monitoring Status Pelaporan Dokumen Lingkungan</b>
	</div>

	<div class="row">
		<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
			<div class="card">
				<strong>Status Pelaporan</strong>
				<ul class="timeline mt-3 mb-0">
					<?php foreach ($status_pelaporan as $row): ?>
						<li class="timeline-item">
							<a href="<?= base_url('sendReport').'?year='.$row['doc_year'].'&periode='.$row['doc_periode'] ?>" class="text-<?= $row['status_color'] ?>">
								<strong><?= $row['status_desc'] ?></strong>
							</a>
							<span class="float-end text-muted text-sm">
								<?= date('d-m-Y H:i', strtotime($row['doc_modified_at'])) ?>
								<!-- <div>
									<a href="#" class="badge bg-primary text-decoration-none float-end p-1">
										<i class="bi-file-earmark-text fs-6"></i>
									</a>
								</div> -->
							</span>
							<p><?= $row['file_type_desc'] ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
			<div class="card">
				<strong>Proses Bisnis Aplikasi SIPPDOKLING</strong>
				<img src="<?= base_url('assets/dist/img/').'flowchart.png' ?>" style="width: 100%">
			</div>
		</div>
</div>