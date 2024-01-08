<script>
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
    order: [3, 'desc'],
    ajax: {
        url: "<?= base_url('report/getData?for=user'); ?>",
        type: "GET"
    },
    iDisplayLength: 10,
    columns: [{
            data: null,
            className: "text-left"
        }, {
            data: "doc_year",
            className: "text-left"
        }, {
            data: "doc_periode",
            render: function(data, type, row) {
                return 'SMT. ' + data;
            }
        }, {
            data: "doc_created_at",
            className: "text-left"
        }, {
            data: "status_desc",
            render: function(data, type, row) {
                return '<span class="badge bg-' + row.status_color + '">' + data + '</span>';
            }
        }, {
            data: "doc_id",
            render: function(data, type, row) {
                if (row.doc_status == 3) {
                    var prints_button = '<a href="<?= base_url() ?>prints/pdf/' + row.doc_id + '" class="btn btn-success btn-sm" target="_blank"><i class="bi-printer"></i>';
                } else {
                    var prints_button = '';
                }

                return '<a href="<?= base_url("sendreport") ?>?year=' + row.doc_year + '&periode=' + row.doc_periode + '" class="btn btn-warning btn-sm me-1"><i class="bi-pencil-square"></i></a>' +
                        '<a href="<?= base_url("history/view/") ?>' + data + '" class="btn btn-primary btn-sm me-1"><i class="bi-file-earmark-text"></i></a>' +
                        prints_button;
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

$('#yearFilter').on('change', function() {
    table.columns(1).search(this.value).draw();
});

$('#periodeFilter').on('change', function() {
    table.columns(2).search(this.value).draw();
});

$('select#pagelength').on('change', function() {
    table.page.len(this.value).draw();
});

/* ============================================================ */
/*
/* ============================================================ */

function hapusData(id) {
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
                    url: "<?= base_url() ?>company/delete/" + id,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    cache: false,
                })
                .done(function(data) {
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus !',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    table.draw();
                });
        }
    })
}
</script>
