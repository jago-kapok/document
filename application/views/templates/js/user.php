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
        url: "<?= base_url('user/getData'); ?>",
        type: "GET"
    },
    iDisplayLength: 10,
    columns: [{
            data: null,
            className: "text-left"
        }, {
            data: "username",
            className: "text-left"
        }, {
            data: "email",
            className: "text-left"
        }, {
            data: "company_name",
            className: "text-left"
        }, {
            data: "level",
            className: "text-left"
        }, {
            data: "active",
            render: function(data, type, row) {
                if (data == 1) {
                    return '<span class="badge bg-primary">Aktif</span>';
                } else {
                    return '<span class="badge bg-secondary">Non-Aktif</span>';
                }
            }
        }, {
            data: "id",
            render: function(data, type, row) {
                if (row.active == 0) {
                    return '<button class="btn btn-info btn-sm"><i class="bi-arrow-clockwise" title="Reset Password" onclick="resetPassword(' + data + ')"></i></button>&nbsp;<button class="btn btn-primary btn-sm" title="Aktifkan Akun" onclick="editStatus(' + data + ')"><i class="bi-unlock"></i></button>';
                } else {
                    return '<button class="btn btn-info btn-sm"><i class="bi-arrow-clockwise" title="Reset Password" onclick="resetPassword(' + data + ')"></i></button>&nbsp;<button class="btn btn-danger btn-sm" title="Non-aktifkan Akun" onclick="editStatus(' + data + ')"><i class="bi-lock"></i></button>';
                }
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

function editStatus(id) {
    Swal.fire({
        title: 'CONFIRM !',
        text: "Anda yakin ingin menon-aktifkan pengguna ini ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "<?= base_url('user/status') ?>?id=" + id,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
            })
            .done(function(data) {
                Swal.fire('SUCCESS', data.message, 'success')
                .then(function() {
                    table.draw();
                });
            });
        }
    });
}

/* ============================================================ */
/*
/* ============================================================ */

function resetPassword(id) {
    Swal.fire({
        title: 'CONFIRM !',
        text: "Anda yakin ingin mereset password pengguna ini ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "<?= base_url('user/reset') ?>?id=" + id,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
            })
            .done(function(data) {
                Swal.fire('SUCCESS', data.message, 'success')
                .then(function() {
                    table.draw();
                });
            });
        }
    });
}
</script>