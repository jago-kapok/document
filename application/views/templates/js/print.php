<script>
var table = $("table#table_data").DataTable({
    processing: true,
    language: {
        lengthMenu: "_MENU_",
        infoFiltered : "",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
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
    order: [6, 'desc'],
    ajax: {
        url: "<?= base_url('report/getData?for=prints'); ?>",
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
            data: "company_name",
            render: function(data, type, row) {
                return '<b><u>' + data + '</u></b><br>' + row['company_address'];
            }
        }, {
            data: "company_pic",
            className: "text-left"
        }, {
            data: "status_desc",
            render: function(data, type, row) {
                return '<span class="badge bg-' + row.status_color + '">' + data + '</span>' +
                        '<br><span class="badge bg-secondary">' + row.doc_verified_at + '</span>';
            }
        }, {
            data: "doc_id",
            render: function(data, type, row) {
                return '<a href="<?= base_url("prints/pdf/") ?>' + data + '" class="btn btn-info btn-sm" target="_blank">' +
                        '<i class="bi-printer"></i>&nbsp;Cetak</a>';
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
</script>