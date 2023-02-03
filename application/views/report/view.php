<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Semua Pelaporan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan Detail</li>
    </ol>
  </nav>

  <div class="card">
    <div class="row mb-3">
      <div class="row ms-0">
        <label class="col-md-2 col-form-label fw-bold">Nama Perusahaan</label>
        <label class="col-md-6 col-form-label">:&nbsp;&nbsp;<?php echo $company->company_name ?></label>

        <label class="col-md-2 col-form-label fw-bold">Tahun Pelaporan</label>
        <label class="col-md-2 col-form-label">:&nbsp;&nbsp;<?php echo $company->doc_year ?></label>
      </div>
      <div class="row ms-0">
        <label class="col-md-2 col-form-label fw-bold">Lokasi Kegiatan</label>
        <label class="col-md-6 col-form-label">:&nbsp;&nbsp;<?php echo $company->company_office_address ?></label>

        <label class="col-md-2 col-form-label fw-bold">Periode Pelaporan</label>
        <label class="col-md-2 col-form-label">:&nbsp;&nbsp;Semester <?php echo $company->doc_periode ?></label>
      </div>
      <div class="row ms-0">
        <label class="col-md-2 col-form-label fw-bold">Penanggung Jawab</label>
        <label class="col-md-4 col-form-label">:&nbsp;&nbsp;<?php echo $company->company_pic ?></label>
      </div>
    </div>

    <div>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="bg-secondary text-light">
              <tr>
                <th>No.</th>
                <th>Nama Dokumen</th>
                <th>Status</th>
                <th>Tanggal Submit</th>
                <th>Tanggal Verifikasi</th>
                <th>Diverifikasi oleh</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($doc as $key => $value) { ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td>
                    <?php echo $value['file_type_desc'] ?>
                    &nbsp;<a href="<?= base_url() ?>reports/<?php echo $value['doc_folder']; ?>/<?php echo $value['doc_file']; ?>" target="_blank"><i class="bi-folder-symlink"></i></a>
                  </td>
                  <td>
                    <span class="badge bg-<?php echo $value['status_color'] ?>"><?php echo $value['status_desc'] ?></span>
                    <?php if($value['doc_status'] == 4) { ?>
                      <a href="javascript:void(0)" class="badge bg-info" onclick="lihatCatatan('<?php echo $value['doc_rejected_note'] ?>')">Catatan</a>
                    <?php } ?>
                  </td>
                  <td><?php echo $value['doc_modified_at'] ?></td>
                  <td><?php echo $value['doc_verified_at'] ?></td>
                  <td><?php echo strtoupper($value['user_name']) ?></td>
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
            <thead class="bg-secondary text-light">
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