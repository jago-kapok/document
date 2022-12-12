<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
	    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
	  </ol>
	</nav>

	<?php if ($doc) { ?>
		<?php if($doc->doc_status == 2) { ?>
			<div class="alert alert-info">
		    Terima kasih. Dokumen anda sudah terkirim ke Dinas Lingkungan Hidup Kab. Bojonegoro.<br>Anda dapat melihat progress laporan anda melalui dashboard / beranda aplikasi.
		  </div>
		<?php } else { ?>
			<div class="alert alert-danger">
				Tekan tombol "Kirim Laporan" setelah semua dokumen selesai diupload, untuk selanjutnya diverifikasi oleh Dinas Lingkungan Hidup Kab. Bojonegoro
		  </div>
		<?php } ?>
	<?php } else { ?>
		<div class="alert alert-danger">
	    Tekan tombol "Kirim Laporan" setelah semua dokumen selesai diupload, untuk selanjutnya diverifikasi oleh Dinas Lingkungan Hidup Kab. Bojonegoro
	  </div>
	<?php } ?>

  <div class="card">
    <div id="form_data">
	    <div class="row">
	      <div class="col-md-12">
	      	<div class="row mb-1">
	      		<?php if($doc) { ?>
					<?php if($doc->doc_status != 2) { ?>
						<div class="col-md-12 mb-2">
							<div class="d-flex justify-content-end">
								<button type="button" class="btn btn-primary" onclick="kirimLaporan('<?php echo $doc->doc_id ?>')"><span class="btn-icon" data-feather="send"></span>&nbsp;&nbsp;Kirim Laporan</button>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
	        </div>

	      	<div class="container-fluid bg-info p-1 mb-3">
	      		<span class="text-light"><center><b>DOKUMEN YANG HARUS DILENGKAPI</b></center></span>
	      	</div>
			
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">1. Deskripsi Kegiatan <span class="text-danger">*</span>
			  	<br><span class="form-text">Catatan : Mencakup limbah yang dihasilkan hasil produksi, dan sampah domestik (perbulan)</span>
			  </label>
	          <?php if($doc1) { ?>
          		<?php if($doc1->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc1->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc1->doc_folder ?>/<?php echo $doc1->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc1->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deskripsiKegiatan"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc1->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc1->doc_folder ?>/<?php echo $doc1->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deskripsiKegiatan"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">2. Laporan Pelaksanaan RKL-RPL dan UKL-UPL <span class="text-danger">*</span></label>
	          <?php if($doc2) { ?>
          		<?php if($doc2->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc2->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc2->doc_folder ?>/<?php echo $doc2->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc2->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanKLPL"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc2->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc2->doc_folder ?>/<?php echo $doc2->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanKLPL"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">3. Laporan Pengendalian Pencemaran Air <span class="text-danger">*</span></label>
	          <?php if($doc3) { ?>
          		<?php if($doc3->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc3->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc3->doc_folder ?>/<?php echo $doc3->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc3->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanPencemaranAir"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc3->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc3->doc_folder ?>/<?php echo $doc3->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanPencemaranAir"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">4. Laporan Pengendalian Pencemaran Udara <span class="text-danger">*</span></label>
	          <?php if($doc4) { ?>
          		<?php if($doc4->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc4->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc4->doc_folder ?>/<?php echo $doc4->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc4->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanPencemaranUdara"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc4->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc4->doc_folder ?>/<?php echo $doc4->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanPencemaranUdara"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">5. Laporan Pengendalian Limbah <span class="text-danger">*</span></label>
	          <?php if($doc5) { ?>
          		<?php if($doc5->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc5->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc5->doc_folder ?>/<?php echo $doc5->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc5->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanLimbah"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc5->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc5->doc_folder ?>/<?php echo $doc5->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanLimbah"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">6. Laporan Pengelolaan Dampak Sosial Ekonomi <span class="text-danger">*</span></label>
	          <?php if($doc6) { ?>
          		<?php if($doc6->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc6->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc6->doc_folder ?>/<?php echo $doc6->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc6->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanDampak"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc6->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc6->doc_folder ?>/<?php echo $doc6->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanDampak"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">7. Dokumen Ijin Persetujuan Lingkungan <span class="text-danger">*</span></label>
	          <?php if($doc7) { ?>
          		<?php if($doc7->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc7->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc7->doc_folder ?>/<?php echo $doc7->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc7->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanIjin"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc7->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc7->doc_folder ?>/<?php echo $doc7->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanIjin"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	        <div class="row mb-3">
	          <label class="col-md-5 col-form-label">8. Dokumentasi Kegiatan <span class="text-danger">*</span></label>
	          <?php if($doc8) { ?>
          		<?php if($doc8->doc_status == 1) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-danger" onclick="hapusDokumen('<?php echo $doc8->doc_detail_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;&nbsp;Hapus Dokumen</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc8->doc_folder ?>/<?php echo $doc8->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } else if($doc8->doc_status == 4) { ?>
			          <div class="col-md-3">
			            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanDokumentasi"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
			          </div>
			          <div class="col-md-3">
									<div class="d-flex align-items-center text-danger">
									  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="javascript:void(0)" onclick="lihatCatatan('<?php echo $doc8->doc_rejected_note ?>')">Dokumen Ditolak</a></div>
									</div>
								</div>
							<?php } else { ?>
								<div class="col-md-3">
			            <button type="button" class="btn btn-primary" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Dokumen Terkirim</button>
			          </div>
			          <div class="col-md-3">
			          	<div class="d-flex align-items-center text-success">
									  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
									  <div class="ms-3"><a href="<?= base_url() ?>reports/<?php echo $doc8->doc_folder ?>/<?php echo $doc8->doc_file ?>" target="_blank">Lihat Dokumen</a></div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-3">
		            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanDokumentasi"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
		          </div>
		          <div class="col-md-3">
								<div class="d-flex align-items-center text-danger">
								  <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
								  <div class="ms-3"><span>Belum Diupload</span></div>
								</div>
							</div>
	          <?php } ?>
	        </div>
	      </div>

	      <div class="modal fade" id="deskripsiKegiatan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title"s>Upload Deskripsi Kegiatan</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formDeskripsiKegiatan">
				      	<input type="hidden" name="file_type_id" value="1">
					      <div class="modal-body">
					        <input id="file_deskripsi_kegiatan" type="file" name="file_deskripsi_kegiatan" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanKLPL" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Laporan Pelaksanaan RKL-RPL dan UKL-UPL</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanKLPL">
				      	<input type="hidden" name="file_type_id" value="2">
					      <div class="modal-body">
					        <input id="file_laporan_klpl" type="file" name="file_laporan_klpl" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanPencemaranAir" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Laporan Pengendalian Pencemaran Air</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanPencemaranAir">
				      	<input type="hidden" name="file_type_id" value="3">
					      <div class="modal-body">
					        <input id="file_laporan_pencemaran_air" type="file" name="file_laporan_pencemaran_air" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanPencemaranUdara" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Laporan Pengendalian Pencemaran Udara</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanPencemaranUdara">
				      	<input type="hidden" name="file_type_id" value="4">
					      <div class="modal-body">
					        <input id="file_laporan_pencemaran_udara" type="file" name="file_laporan_pencemaran_udara" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanLimbah" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Laporan Pengendalian Limbah</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanLimbah">
				      	<input type="hidden" name="file_type_id" value="5">
					      <div class="modal-body">
					        <input id="file_laporan_limbah" type="file" name="file_laporan_limbah" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanDampak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Laporan Pengelolaan Dampak Sosial Ekonomi</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanDampak">
				      	<input type="hidden" name="file_type_id" value="6">
					      <div class="modal-body">
					        <input id="file_laporan_dampak" type="file" name="file_laporan_dampak" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanIjin" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Dokumen Perijinan Persetujuan Lingkungan</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formLaporanIjin">
				      	<input type="hidden" name="file_type_id" value="7">
					      <div class="modal-body">
					        <input id="file_laporan_ijin" type="file" name="file_laporan_ijin" class="form-control" accept="application/pdf">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="laporanDokumentasi" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Upload Dokumentasi / Foto Kegiatan</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>

				      <form id="formDokumentasi">
				      	<input type="hidden" name="file_type_id" value="8">
					      <div class="modal-body">
					        <input id="file_dokumentasi" type="file" name="file_dokumentasi" class="form-control" accept="application/pdf">
					        <div class="form-text">Foto dijadikan satu dalam file PDF</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					      </div>
					    </form>
				    </div>
				  </div>
				</div>

	    </div>
  	</div>
  </div>
</div>

<script>
	$("#file_deskripsi_kegiatan, #file_laporan_klpl, #file_laporan_pencemaran_air, #file_laporan_pencemaran_udara, #file_laporan_limbah, #file_laporan_dampak, #file_laporan_ijin, #file_dokumentasi").change(function () {
    var fileExtension = ['pdf'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
     	Swal.fire({
        icon: 'warning',
        title: 'WARNING !',
        text: 'Hanya dokumen dengan format PDF yang diijinkan',
        showConfirmButton: true,
      });

      $(this).val('');
    }
  });

	/* FILE 1 */
	$("#formDeskripsiKegiatan").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formDeskripsiKegiatan")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc1",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 2 */
  $("#formLaporanKLPL").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanKLPL")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc2",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 3 */
	$("#formLaporanPencemaranAir").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanPencemaranAir")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc3",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 4 */
	$("#formLaporanPencemaranUdara").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanPencemaranUdara")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc4",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 5 */
	$("#formLaporanLimbah").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanLimbah")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc5",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 6 */
	$("#formLaporanDampak").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanDampak")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc6",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 7 */
	$("#formLaporanIjin").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formLaporanIjin")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc7",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

  /* FILE 8 */
	$("#formDokumentasi").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#formDokumentasi")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/doc8",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if(data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: false,
          timer: 1200
        });

        setInterval(() => {
          window.location = "<?= base_url() ?>sendreport";
        }, 1000);
      } else {
        $.each(data.errors, function(index, value) {
          Swal.fire({
	          icon: 'warning',
	          title: 'ERROR !',
	          text: value,
	          showConfirmButton: true
	        })
        })
      }
    })
    .fail(function () {
      Swal.fire({
	      icon: 'warning',
	      title: 'Maaf, Terjadi masalah saat koneksi ke server !',
	      showConfirmButton: true
	    })
    });
  });

	/* HAPUS DOKUMEN */
  function hapusDokumen(id) {
    Swal.fire({
      title: 'WARNING !',
      text: 'Apakah anda yakin ingin menghapus dokumen ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("<?= base_url() ?>sendreport/delete_doc", { doc_detail_id: id }, function(data) {
          Swal.fire({
            icon: 'success',
            title: 'SUCCESS',
            text: 'Dokumen berhasil dihapus ! Anda bisa mengupload dokumen baru',
            showConfirmButton: true
          }).then(function() {
          	window.location = "<?= base_url() ?>sendreport";
          });
        });
      }
    })
  }

  /* KIRIM LAPORAN */
  function kirimLaporan(id) {
    Swal.fire({
      title: 'WARNING !',
      text: 'Laporan yang sudah dikirim adalah laporan final dan tidak bisa diedit kembali ! Apakah anda yakin ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("<?= base_url() ?>sendreport/confirm", { doc_id: id }, function(data) {
          Swal.fire({
            icon: 'success',
            title: 'TERIMA KASIH',
            text: 'Dokumen berhasil dikirim, anda dapat melihat progress laporan anda melalui dashboard / beranda aplikasi',
            showConfirmButton: true
          }).then(function() {
          	window.location = "<?= base_url() ?>sendreport";
          });
        });
      }
    })
  }
</script>