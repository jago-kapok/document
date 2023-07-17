<div class="modal fade" id="modalUpload" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form id="form_upload">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b><span id="modal_title"></span></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input id="company_id" type="hidden" name="company_id" value="<?= $this->uri->segment(3) ?>">
                    <input id="file_title" type="hidden" name="file_title">

                    <input type="file" name="file_upload" class="form-control" accept="application/pdf">
                    <div class="form-text">Jika ada lebih dari satu file, harap dijadikan satu dalam format PDF</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button id="submit_form_upload" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
/* ============================================================ */
/*
/* ============================================================ */

var table = $("table#table_data").DataTable({
    processing: true,
    language: {
        lengthMenu: "_MENU_",
        zeroRecords: "<center>Tidak Ada Data</center>",
        processing: "<center>Silakan Tunggu</center>",
        paginate: {
            previous: "PREV",
            next: "NEXT"
        },
    },
    bInfo: true,
    bLengthChange: false,
    serverSide: true,
    scrollX: true,
    ajax: {
        url: "<?= base_url('company/getData'); ?>",
        type: "GET"
    },
    iDisplayLength: 10,
    columns: [
        {
            data: null,
            className: "text-left"
        }, {
            data: "company_name",
            className: "text-left"
        }, {
            data: "company_business",
            className: "text-left"
        }, {
            data: "company_office_address",
            className: "text-left"
        }, {
            data: "company_pic",
            className: "text-left"
        }, {
            data: "company_id",
            render: function(data, type, row) {
                return '<a href="<?= base_url() ?>company/view/' + data + '" class="btn btn-warning btn-sm"><i class="bi-search"></i></a>&nbsp;<a href="<?= base_url() ?>company/update/' + data + '" class="btn btn-info btn-sm"><i class="bi-pencil-square"></i></a>&nbsp;<button class="btn btn-danger btn-sm" onclick="hapusData(' + data + ')"><i class="bi-trash"></i></button>';
            }
        }

    ],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $("td:eq(0)", row).html(index);
    }
});

$('#searching').on('keyup', function() {
    table.search(this.value).draw();
});

$('select#pagelength').on('change', function() {
    table.page.len(this.value).draw();
});

/* ============================================================ */
/*
/* ============================================================ */

function showModalUpload(id)
{
    $('#modalUpload').modal('show');
    var modal_title = id == 1 ? 'File Struktur Organisasi' : 'File Perijinan yang Dimiliki';
    var file_title  = id == 1 ? 'company_organitation_file' : 'company_license_file';

    $('#modal_title').text(modal_title);
    $('#file_title').val(file_title);
}

/* ============================================================ */
/*
/* ============================================================ */

$("#submit_form_upload").click(function()
{
    event.preventDefault();
    var data = new FormData($("#form_upload")[0]);

    $.ajax({
        type: "POST",
        url: "<?= base_url('company/upload') ?>",
        data: data,
        dataType: "json",
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(data) {
        if (data.success == true) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: data.message
            }).then((result) => {
                window.location = "<?= base_url('company/view/') ?>" + data.company_id;
            });
        } else {
            $.each(data.errors, function(index, value) {
                $.notify(value, "error");
            })
        }
    })
    .fail(function() {
        $.notify("Terjadi masalah saat koneksi ke server !");
    });
});

/* ============================================================ */
/*
/* ============================================================ */

$("#submit_form").click(function()
{
    var data = new FormData($("#form_data")[0]);

    $.ajax({
        type: "POST",
        url: "<?= base_url('company/store') ?>",
        data: data,
        dataType: "json",
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(data) {
        if (data.success == true) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: data.message
            }).then((result) => {
                window.location = "<?= base_url('company/view/') ?>" + data.company_id;
            });
        } else {
            $.each(data.errors, function(index, value) {
                $.notify(value, "error");
            })
        }
    })
    .fail(function() {
        $.notify("Terjadi masalah saat koneksi ke server !");
    });
});

/* ============================================================ */
/*
/* ============================================================ */

function hapusData(id)
{
    Swal.fire({
        title: 'PERHATIAN !',
        text: "Anda yakin ingin menghapus data ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "<?= base_url('company/delete/') ?>" + id,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
            })
            .done(function(data) {
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: 'SUCCESS',
                    text: 'Data berhasil dihapus !',
                    showConfirmButton: true
                });

                table.draw();
            });
        }
    });
}
</script>