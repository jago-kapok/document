<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('report/verify') ?>">Verifikasi Laporan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
    </ol>
  </nav>

  <div class="card">
    <div class="row mb-3">
      <div class="row">
        <label class="col-md-2 form-label">Nama Perusahaan</label>
        <label class="col-md-6 fw-normal">:&nbsp;&nbsp;<?= $company->company_name ?></label>

        <label class="col-md-2 form-label">Tahun Laporan</label>
        <label class="col-md-2 fw-normal">:&nbsp;&nbsp;<?= $company->doc_year ?></label>
      </div>
      <div class="row">
        <label class="col-md-2 form-label">Lokasi Kegiatan</label>
        <label class="col-md-6 fw-normal">:&nbsp;&nbsp;<?= $company->company_office_address ?></label>

        <label class="col-md-2 form-label">Periode Laporan</label>
        <label class="col-md-2 fw-normal">:&nbsp;&nbsp;Semester <?= $company->doc_periode ?></label>
      </div>
      <div class="row">
        <label class="col-md-2 form-label">Penanggung Jawab</label>
        <label class="col-md-4 fw-normal">:&nbsp;&nbsp;<?= $company->company_pic ?></label>
      </div>
    </div>

    <div class="">
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="bg-app text-light">
              <tr>
                <th>No.</th>
                <th>Nama Dokumen</th>
                <th>Status</th>
                <th>Tanggal Submit</th>
                <th>Pilihan</th>
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
                      <p class="form-text m-0"><b>Alasan ditolak :</b> <span class="text-danger"><?= $value['doc_rejected_note'] ?></span></p>
                    <?php } ?>
                  <td>
                    <span class="badge bg-<?= $value['status_color'] ?>"><?= $value['status_desc'] ?></span>
                  </td>
                  <td><?= $value['doc_modified_at'] ?></td>
                  <td>
                    <?php if ($value['doc_status'] == 2) { ?> 
                      <button type="button" class="btn btn-sm btn-success" onclick="approve(<?= $value['doc_detail_id'] ?>)">
                        Terima
                      </button>
                      <button type="button" class="btn btn-sm btn-danger" onclick="reject(<?= $value['doc_detail_id'] ?>)">
                        Tolak
                      </button>
                    <?php } else { ?>
                      <?= $value['doc_verified_at'] ?>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  /* ============================================================ */
  /*
  /* ============================================================ */

  function reject(doc_detail_id)
  {
    const { value: text } = Swal.fire({
      title: 'Tolak Dokumen ?',
      input: 'textarea',
      inputPlaceholder: 'Berikan alasan penolakan dokumen ...',
      inputAttributes: {
        'aria-label': 'Type your message here'
      },
      showCancelButton: true,
      inputValidator: (value) => {
        if (!value) {
          return 'Mohon isikan alasan penolakan !'
        }
      }
    }).then(function(result) {
      if (result.isConfirmed == true)
      {
        var url = "<?= base_url('verify/reject') ?>";

        $.post(url, { doc_detail_id: doc_detail_id, doc_rejected_note: result.value }, function(data)
        {
          Swal.fire('SUCCESS', data.message, 'success')
          .then((result) => {
            location.reload(true);
          });
        }, "json");
      }
    });
  }

  /* ============================================================ */
  /*
  /* ============================================================ */

  function approve(doc_detail_id)
  {
    Swal.fire({
      title: 'CONFIRM !',
      text: "Apakah anda yakin ingin memverifikasi laporan ini ?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed)
      {
        var url = "<?= base_url('verify/approve') ?>";

        $.post(url, { doc_detail_id: doc_detail_id }, function(data)
        {
          Swal.fire('SUCCESS', data.message, 'success')
          .then((result) => {
            location.reload(true);
          });
        }, "json");
      }
    })
  }
</script>