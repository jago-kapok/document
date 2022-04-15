<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Semua Pelaporan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan Detail</li>
    </ol>
  </nav>

  <div class="card">
    <div>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
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
                  <td><?php echo $value['file_type_desc'] ?></td>
                  <td>
                    <span class="badge bg-<?php echo $value['status_color'] ?>"><?php echo $value['status_desc'] ?></span>
                    <?php if($value['doc_status'] == 4) { ?>
                      <a href="javascript:void(0)" class="badge bg-info" onclick="alert('<?php echo $value['doc_rejected_note'] ?>')">Alasan</a>
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
    </div>
  </div>
</div>