<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('report/all') ?>">Semua Laporan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan Detail</li>
    </ol>
  </nav>

  <div class="card">
    <div class="row mb-3">
      <div class="row">
        <label class="col-md-2 form-label">Nama Perusahaan</label>
        <label class="col-md-6 fw-normal">:&nbsp;&nbsp;<?= $company->company_name ?></label>

        <label class="col-md-2 form-label">Tahun Pelaporan</label>
        <label class="col-md-2 fw-normal">:&nbsp;&nbsp;<?= $company->doc_year ?></label>
      </div>
      <div class="row">
        <label class="col-md-2 form-label">Lokasi Kegiatan</label>
        <label class="col-md-6 fw-normal">:&nbsp;&nbsp;<?= $company->company_office_address ?></label>

        <label class="col-md-2 form-label">Periode Pelaporan</label>
        <label class="col-md-2 fw-normal">:&nbsp;&nbsp;Semester <?= $company->doc_periode ?></label>
      </div>
      <div class="row">
        <label class="col-md-2 form-label">Penanggung Jawab</label>
        <label class="col-md-4 fw-normal">:&nbsp;&nbsp;<?= $company->company_pic ?></label>
      </div>
    </div>

    <div>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="bg-app text-light">
              <tr>
                <th>No.</th>
                <th>Nama Dokumen</th>
                <th>Status</th>
                <th>Tanggal Submit</th>
                <th>Tanggal Verifikasi</th>
                <th>Oleh</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($doc as $key => $value) { ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td>
                    <a href="<?= base_url('reports/').$value['doc_folder'].'/'.$value['doc_file'] ?>" class="text-decoration-none" target="_blank">
                      <i class="bi-file-earmark-text fs-4"></i>
                    </a>
                    <?= $value['file_type_desc'] ?>

                    <!-- Alasan ditolak jika status doc_detail = 4 -->
                    <?php if ($value['doc_status'] == 4) { ?>
                      <p class="form-text m-0"><b>Alasan ditolak : </b><span class="text-danger"><?= $value['doc_rejected_note'] ?></span></p>
                    <?php } ?>
                  </td>
                  <td>
                    <span class="badge bg-<?= $value['status_color'] ?>"><?= $value['status_desc'] ?></span>
                  </td>
                  <td><?= date('Y-m-d', strtotime($value['doc_modified_at'])) ?></td>
                  <td><?= $value['doc_verified_at'] ?></td>
                  <td><?= ucwords($value['user_name']) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row mt-3">
        <h5><b>Riwayat Dokumen (Revisi)</b></h5>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="bg-danger text-light">
              <tr>
                <th>No.</th>
                <th>Nama Dokumen</th>
                <th>Tanggal Submit</th>
                <th>Tanggal Revisi</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($doc_history as $key => $value) { ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td>
                    <?php echo $value['file_type_desc'] ?>
                    &nbsp;<a href="<?= base_url() ?>reports/<?php echo $value['doc_folder']; ?>/<?php echo $value['doc_file']; ?>" target="_blank"><i class="bi-folder-symlink"></i></a>
                  </td>
                  <td><?php echo $value['doc_modified_at'] ?></td>
                  <td><?php echo $value['doc_rejected_at'] ?></td>
                  <td><?php echo $value['doc_rejected_note'] ?></td>
                  <!-- <td><?php echo strtoupper($value['user_name']) ?></td> -->
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>