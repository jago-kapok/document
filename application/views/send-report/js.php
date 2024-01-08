<!-- Modal Upload Dokumen -->
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
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Revisi Dokumen -->
<div class="modal fade" id="modalRevisi" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b><span id="modalTitleRevisi"></span></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_data_revisi">
                <div class="modal-body">
                    <input id="doc_detail_id" type="hidden" name="doc_detail_id">
                    <input id="revisi_file_upload" type="file" name="file_upload" class="form-control" accept="application/pdf">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showModalUpload(file_type_id, file_type_desc, doc_id) {
    var myModal = new bootstrap.Modal(document.getElementById('modalUpload'), {
        keyboard: false
    });

    myModal.show();
    $('#modalTitle').text('Upload ' + file_type_desc);
    $('#doc_id').val(doc_id);
    $('#file_type_id').val(file_type_id);
}

/* ============================================================ */
/*
/* ============================================================ */

function showModalRevisi(file_type_desc, doc_detail_id) {
    var myModal = new bootstrap.Modal(document.getElementById('modalRevisi'), {
        keyboard: false
    });

    myModal.show();
    $('#modalTitleRevisi').text('Revisi ' + file_type_desc);
    $('#doc_detail_id').val(doc_detail_id);
}

/* ============================================================ */
/*
/* ============================================================ */

$("#file_uploaded").change(function() {
    var fileExtension = ['pdf'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        Swal.fire('WARNING !', 'Hanya dokumen dengan format PDF yang diijinkan', 'warning');
        $(this).val('');
    }
});

/* ============================================================ */
/*
/* ============================================================ */

$("#form_data_upload").submit(function(event) {
    event.preventDefault();
    var data = new FormData($("#form_data_upload")[0]);

    $.ajax({
        type: "POST",
        url: "<?= base_url('sendreport/store') ?>",
        data: data,
        dataType: "json",
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(data) {
        if (data.success == true) {
            Swal.fire('SUCCESS', data.message, 'success')
            .then(function() {
                window.location = "<?= base_url('sendreport') ?>?year=" + data.year + "&periode=" + data.periode;
            });
        } else {
            $.each(data.errors, function(index, value) {
                Swal.fire('ERROR', value, 'error');
            });
        }
    })
    .fail(function() {
        Swal.fire('ERROR', 'Mohon periksa file atau koneksi jaringan anda !', 'error');
    });
});

/* ============================================================ */
/*
/* ============================================================ */

function hapusDokumen(doc_detail_id)
{
    let url = "<?= base_url('sendreport/delete') ?>";

    Swal.fire({
        title: 'WARNING !',
        text: 'Apakah anda yakin ingin menghapus dokumen ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, { doc_detail_id: doc_detail_id }, function(data) {
                Swal.fire('SUCCESS', data.message, 'success')
                .then(function() {
                    window.location = "<?= base_url('sendreport') ?>?year=" + data.year + "&periode=" + data.periode;
                });
            }, "json");
        }
    })
}

/* ============================================================ */
/*
/* ============================================================ */

function kirimLaporan(doc_id)
{
    let url = "<?= base_url('sendreport/send') ?>";
    Swal.fire({
        title: 'CONFIRM !',
        text: 'Laporan yang sudah dikirim adalah laporan final dan tidak bisa diedit kembali ! Apakah anda yakin ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, { doc_id: doc_id }, function(data) {
                if (data.success == true) {
                    Swal.fire('TERIMA KASIH', data.message, 'success')
                        .then(function() {
                            window.location = "<?= base_url('sendreport') ?>?year=" + data.year + '&periode=' + data.periode;
                        });
                } else {
                    Swal.fire('ERROR', data.message, 'error');
                }
            }, "json");
        }
    })
}

/* ============================================================ */
/*
/* ============================================================ */

$("#form_data_revisi").submit(function(event) {
    event.preventDefault();
    var data = new FormData($("#form_data_revisi")[0]);

    $.ajax({
        type: "POST",
        url: "<?= base_url('sendreport/revisi') ?>",
        data: data,
        dataType: "json",
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(data) {
        if (data.success == true) {
            Swal.fire('SUCCESS', data.message, 'success')
            .then(function() {
                window.location = "<?= base_url('sendreport') ?>?year=" + data.year + "&periode=" + data.periode;
            });
        } else {
            $.each(data.errors, function(index, value) {
                Swal.fire('ERROR', value, 'error');
            });
        }
    })
    .fail(function() {
        Swal.fire('ERROR', 'Mohon periksa file atau koneksi jaringan anda !', 'error');
    });
});
</script>
