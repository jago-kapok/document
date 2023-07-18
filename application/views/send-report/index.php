<style>
.btn-upload {
  width: 14em !important;
}
</style>

<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pelaporan Dokumen <?= 'Tahun '.$year.' - Semester '.$periode ?></li>
    </ol>
  </nav>
  
  <?php if ($doc->doc_status != 1): ?>
    <div class="alert alert-info" data-aos="fade-up" data-aos-delay="300">
      Laporan sudah terkirim ke Dinas Lingkungan Hidup Kab. Bojonegoro. Terima kasih.
    </div>
  <?php else: ?>
    <div class="alert alert-danger" data-aos="fade-up">
      Tekan tombol <b>"Kirim Laporan"</b> setelah semua dokumen selesai diupload, untuk selanjutnya diverifikasi oleh Dinas Lingkungan Hidup Kab. Bojonegoro
    </div>
  <?php endif; ?>

  <div class="card" data-aos="fade-up" data-aos-delay="400">
    <div id="form_data">
      <div class="row">
        <div class="col-md-12">
          <div class="row mb-1">
            <?php if ($total_doc == $total_upload): ?>
              <div class="col-md-12 mb-2">
                <div class="d-flex justify-content-start">
                  <button type="button" class="btn btn-primary" onclick="kirimLaporan('<?= $doc->doc_id ?>')">
                    <span class="btn-icon" data-feather="send"></span>&nbsp;&nbsp;Kirim Laporan
                  </button>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <div class="container-fluid bg-app rounded-2 py-1 mb-3">
            <span class="text-light"><center><b>DOKUMEN YANG HARUS DILENGKAPI</b></center></span>
          </div>
          
        <?php foreach ($doc_detail as $data): ?>
          <?php
            $file_type_id      = $data['file_type_id'];
            $file_type_desc    = $data['file_type_desc'];
            $doc_detail_id     = $data['doc_detail_id'];
            $doc_rejected_note = $data['doc_rejected_note'];
          ?>

          <div class="row mb-3">
            <label class="col-md-6 form-label"><?= $data['file_type_id'] ?>. <?= $data['file_type_desc'] ?><span class="text-danger"> *</span>
              <?php if ($data['file_type_id'] == 1): ?>
                <br><span class="form-text">Mencakup limbah yang dihasilkan, hasil produksi, dan sampah domestik (perbulan)</span>
              <?php endif; ?>
              <?php if ($data['doc_status'] == 4): ?>
                <br><span class="form-text text-danger"><b>Alasan ditolak : </b><?= $data['doc_rejected_note'] ?></span>
              <?php endif; ?>
            </label>

            <!-- Dokumen Baru -->
            <?php if ($data['doc_status'] == 1): ?>
              <div class="col-md-3">
                <button type="button" class="btn btn-danger btn-upload" onclick="hapusDokumen('<?= $doc_detail_id ?>')">
                  <i class="bi-trash"></i>&nbsp;&nbsp;Hapus Dokumen
                </button>
              </div>
              <div class="col-md-3">
                <div class="d-flex align-items-center text-success">
                  <div><i class="bi-check-circle fs-3"></i></div>
                  <div class="ms-2">
                    <a href="<?= base_url('reports/').$data['doc_folder'].'/'.$data['doc_file'] ?>" target="_blank">
                      Lihat Dokumen
                    </a>
                  </div>
                </div>
              </div>

            <!-- Dokumen Menunggu Verifikasi -->
            <?php elseif ($data['doc_status'] == 2): ?>
              <div class="col-md-3">
                <button type="button" class="btn btn-warning btn-upload" disabled>
                  <i class="bi-info-circle"></i>&nbsp;&nbsp;Menunggu Verifikasi
                </button>
              </div>
              <div class="col-md-3">
                <div class="d-flex align-items-center text-success">
                  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
                  <div class="ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Lihat Dokumen</a></div>
                </div>
              </div>

            <!-- Dokumen Sudah Diverifikasi -->
            <?php elseif ($data['doc_status'] == 3): ?>
              <div class="col-md-3">
                <button type="button" class="btn btn-info btn-upload" disabled><i class="bi-info-circle"></i>&nbsp;&nbsp;Dok. Terverifikasi</button>
              </div>
              <div class="col-md-3">
                <div class="d-flex align-items-center text-success">
                  <div><i class="bi-check-circle" style="font-size: 1.5rem"></i></div>
                  <div class="ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Lihat Dokumen</a></div>
                </div>
              </div>

            <!-- Dokumen Perlu Direvisi -->
            <?php elseif ($data['doc_status'] == 4): ?>
              <div class="col-md-3">
                <button type="button" class="btn btn-success btn-upload" onclick="showModalUpload('<?= $file_type_id ?>', '<?= $file_type_desc ?>', '<?= $doc->doc_id ?>')"><i class="bi-upload"></i>&nbsp;&nbsp;Upload Revisi</button>
              </div>
              <div class="col-md-3">
                <div class="d-flex align-items-center text-danger">
                  <div><i class="bi-info-circle" style="font-size: 1.5rem"></i></div>
                  <div class="text-danger ms-2"><a href="<?= base_url() ?>reports/<?= $data['doc_folder'] ?>/<?= $data['doc_file'] ?>" target="_blank">Dokumen Ditolak</a></div>
                </div>
              </div>
            
            <!-- Belum Mengupload Dokumen -->
            <?php else: ?>
              <div class="col-md-3">
                <button type="button" class="btn btn-success btn-upload"
                  onclick="showModalUpload('<?= $file_type_id ?>', '<?= $file_type_desc ?>', '<?= $doc->doc_id ?>')">
                  <i class="bi-upload"></i>&nbsp;&nbsp;Upload Dokumen
                </button>
              </div>
              <div class="col-md-3">
                <div class="d-flex align-items-center text-danger">
                  <div><i class="bi-x-circle fs-3"></i></div>
                  <div class="ms-2"><span>Belum diupload</span></div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>