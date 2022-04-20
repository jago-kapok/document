<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url() ?>verify">Verifikasi Laporan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
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
                <th>Pilihan</th>
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
                      <a href="javascript:void(0)" class="badge bg-info" onclick="lihatCatatan('<?php echo $value['doc_rejected_note'] ?>')">Catatan</a>
                    <?php } ?>
                  </td>
                  <td><?php echo $value['doc_modified_at'] ?></td>
                  <td><?php echo $value['doc_verified_at'] ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-primary" onclick="verifikasiDokumen(<?php echo $value['doc_detail_id'] ?>)"
                      <?php echo $disabled = $value['doc_status'] == 2 ? '' : 'disabled' ?>
                    >
                      Verifikasi
                    </button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="verifikasiDokumen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Verifikasi Dokumen <span id="modalTitle"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="form_data">
          <div class="modal-body">
            <input type="hidden" name="doc_id" value="<?php echo $doc_id ?>">
            <input id="docDetail" type="hidden" name="doc_detail_id">
            <div id="tampilkanDokumen">

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
            <button id="rejectDokumen" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tolak</button>
            <button type="submit" class="btn btn-success">Verifikasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function verifikasiDokumen(id) {
    var verifikasiDokumen = new bootstrap.Modal(document.getElementById('verifikasiDokumen'), {
      backdrop: 'static'
    });
    verifikasiDokumen.show();

    $.getJSON("<?= base_url() ?>document/getData?id=" + id, function(result){
      $.each(result, function(index, value) {
        $('#docDetail').val(value.doc_detail_id);
        $('#modalTitle').html(value.file_type_desc);
        $("#tampilkanDokumen").html('<iframe src="<?= base_url() ?>reports/' + value.doc_folder + '/' + value.doc_file + '" width="100%" height="500px"></iframe>');
      });
    });
  }

  $('#rejectDokumen').click(function() {
    const {value: text} = Swal.fire({
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
      var data = new FormData($("#form_data")[0]);

      data.append('doc_rejected_note', result.value);

      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>verify/reject",
        data: data,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function (data) {
        if(data.success == true) {
          Swal.fire({
            icon: 'success',
            title: 'SUCCESS !',
            text: 'Dokumen berhasil ditolak',
            showConfirmButton: true
          }).then(function() {
            location.reload(true);
          });
        }
      });
    });
  });

  $("form").submit(function (event) {
    event.preventDefault();

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
      if (result.isConfirmed) {
        var data = new FormData($("#form_data")[0]);

        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>verify/edit",
          data: data,
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
        })
        .done(function (data) {
          if(data.success == true) {
            Swal.fire({
              icon: 'success',
              title: 'SUCCESS !',
              text: 'Dokumen berhasil diverifikasi',
              showConfirmButton: true
            }).then(function() {
              location.reload(true);
            });
          } else {
            $.each(data.errors, function(index, value) {
              Swal.fire({
                icon: 'warning',
                title: 'PERHATIAN !',
                text: value,
                showConfirmButton: true
              })
            })
          }
        })
        .fail(function () {
          $.notify("Terjadi masalah saat koneksi ke server !");
        });
      }
    })
  });
</script>