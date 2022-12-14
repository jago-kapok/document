<style>
  .btn-upload {
    width: 14em !important;
  }
</style>

<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
      <?php if ($this->session->user_level == 1) { ?>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <?php } else { ?>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/user">Beranda</a></li>
      <?php } ?>
	    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
	  </ol>
	</nav>

	<?php if ($doc) { ?>
		<?php if($doc->doc_status == 2) { ?>
			<div class="alert alert-info">
		    Pelaporan dokumen <b>Tahun <?= $this->input->get('year') ?> - Semester <?= $this->input->get('periode') ?></b> sudah terkirim ke Dinas Lingkungan Hidup Kab. Bojonegoro. Terima kasih. 
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
								<div class="d-flex justify-content-start">
									<button type="button" class="btn btn-primary" onclick="kirimLaporan('<?php echo $doc->doc_id ?>')"><span class="btn-icon" data-feather="send"></span>&nbsp;&nbsp;Kirim Laporan</button>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>

				<div class="container-fluid bg-info p-1 mb-3">
					<span class="text-light"><center><b>DOKUMEN YANG HARUS DILENGKAPI</b></center></span>
				</div>

				<?php foreach ($doc_detail as $data): ?>
          <?php
            $file_type_id      = $data['file_type_id'];
            $file_type_desc    = $data['file_type_desc'];
            $doc_detail_id     = $data['doc_detail_id'];
            $doc_rejected_note = $data['doc_rejected_note'];
          ?>
          <div class="row mb-3 m-2">
            <label class="col-md-6 col-form-label"><?= $data['file_type_id'] ?>. <?= $data['file_type_desc'] ?><span class="text-danger"> *</span>
              <?php if ($data['file_type_id'] == 1): ?>
                <br><span class="form-text">Mencakup limbah yang dihasilkan, hasil produksi, dan sampah domestik (perbulan)</span>
              <?php endif; ?>
              <?php if ($data['doc_status'] == 3): ?>
                <br><span class="form-text text-danger"><b>Alasan ditolak : </b><?= $data['doc_rejected_note'] ?></span>
              <?php endif; ?>
            </label>
              <?php
                if ($data['doc_status'] == 1) {
              ?>
                <div class="col-md-3">
                  <button type="button" class="btn btn-danger btn-upload" onclick="hapusDokumen('<?= $doc_detail_id ?>', '<?= $doc->doc_id ?>')"><i class="bi-trash"></i>&nbsp;&nbsp;Hapus Dokumen</button>
                </div>
                <div class="col-md-3">
                  <div class="d-flex align-items-center text-success">
                    <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
                    <div class="ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Lihat Dokumen</a></div>
                  </div>
                </div>
              <?php } else if ($data['doc_status'] == 4) { ?>
                <div class="col-md-3">
                  <button type="button" class="btn btn-success btn-upload" onclick="showModalUpload('<?= $file_type_id ?>', '<?= $file_type_desc ?>', '<?= $doc->doc_id ?>')"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Revisi</button>
                </div>
                <div class="col-md-3">
                  <div class="d-flex align-items-center text-danger">
                    <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
                    <div class="text-danger ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Dokumen Ditolak</a></div>
                  </div>
                </div>
              <?php } else if ($data['doc_status'] == 2) { ?>
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary btn-upload" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;Dok. Terkirim</button>
                </div>
                <div class="col-md-3">
                  <div class="d-flex align-items-center text-success">
                    <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
                    <div class="ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Lihat Dokumen</a></div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="col-md-3">
                  <button type="button" class="btn btn-success btn-upload" onclick="showModalUpload('<?= $file_type_id ?>', '<?= $file_type_desc ?>', '<?= $doc->doc_id ?>')"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen</button>
                </div>
                <div class="col-md-3">
                  <div class="d-flex align-items-center text-danger">
                    <div><i class="bi-x-circle" style="font-size: 1.5rem"></i></div>
                    <div class="ms-2"><span>Belum Diupload</span></div>
                  </div>
                </div>
              <?php } ?>
          </div>
				<?php endforeach; ?>
			</div>

      <div class="modal fade" id="modalUpload" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b><span id="modalTitle"></span></b></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_data_upload">
              <div class="modal-body">
                <input id="doc_id" type="hidden" name="doc_id">
                <input id="file_type_id" type="hidden" name="file_type_id">
                <input id="file_upload" type="file" name="file_upload" class="form-control" accept="application/pdf">
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

<script>
  function showModalUpload(file_type_id, file_type_desc, doc_id) {
    var myModal = new bootstrap.Modal(document.getElementById('modalUpload'), { keyboard: false });
    myModal.show();

    $('#modalTitle').text('Upload ' + file_type_desc);
    $('#doc_id').val(doc_id);
    $('#file_type_id').val(file_type_id);
  }

	$("#file_uploaded").change(function () {
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
	$("#form_data_upload").submit(function (event) {
    event.preventDefault();
    var data = new FormData($("#form_data_upload")[0]);

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>sendreport/store",
      data: data,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
			contentType: false,
			processData: false,
    })
    .done(function (data) {
      if (data.success == true) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Dokumen berhasil diupload !',
          showConfirmButton: true,
        }).then(function() {
          window.location = "<?= base_url() ?>sendreport?year=" + data.year + "&periode=" + data.periode;
        });
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
  function hapusDokumen(doc_detail_id, doc_id) {
    var year = '<?= $this->input->get('year') ?>';
    var periode = '<?= $this->input->get('periode') ?>';

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
        $.post("<?= base_url() ?>sendreport/delete_doc", { doc_detail_id: doc_detail_id }, function(data) {
          Swal.fire({
            icon: 'success',
            title: 'SUCCESS',
            text: 'Dokumen berhasil dihapus ! Anda bisa mengupload dokumen baru',
            showConfirmButton: true
          }).then(function() {
          	window.location = "<?= base_url() ?>sendreport?year=" + year + "&periode=" + periode;
          });
        });
      }
    })
  }

  /* KIRIM LAPORAN */
  function kirimLaporan(id) {
    var year = '<?= $this->input->get('year') ?>';
    var periode = '<?= $this->input->get('periode') ?>';

    Swal.fire({
      title: 'CONFIRMATION !',
      text: 'Laporan yang sudah dikirim adalah laporan final dan tidak bisa diedit kembali ! Apakah anda yakin ?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("<?= base_url() ?>sendreport/confirm", { doc_id: id }, function(data) {
          console.log(data);
          if (data.success == true) {
            Swal.fire({
              icon: 'success',
              title: 'TERIMA KASIH',
              text: 'Dokumen berhasil dikirim, anda dapat melihat progress laporan melalui dashboard aplikasi',
              showConfirmButton: true
            })
            .then(function() {
              window.location = "<?= base_url() ?>sendreport?year=" + year + '&periode=' + periode;
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'ERROR !',
              text: 'Mohon lengkapi seluruh dokumen terlebih dahulu !',
              showConfirmButton: true
            });
          }
        }, "json");
      }
    })
  }
</script>