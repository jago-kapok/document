<script>
var table = $("table#table_data").DataTable({
  processing  : true,
  language  : {
  lengthMenu  : "_MENU_",
  zeroRecords : "<center>Tidak Ada Data</center>",
  processing  : "<center>Silakan Tunggu</center>",
  paginate  : {
    previous: "PREV",
    next: "NEXT"
  },
  },
  bInfo     : true,
  bLengthChange : false,
  serverSide  : true,
  scrollX   : true,
  ajax  : {
  url : "<?= base_url('prints/getData'); ?>",
  type: "GET"
  },
  iDisplayLength: 10,
  columns: [
  {data: null,      className: "text-left"},
  {data: "company_name",  className: "text-left"},
  {data: "company_address",   className: "text-left"},
  {data: "company_pic", className: "text-left"},
  {
    data: "status_desc",
    render: function(data, type, row){
      return '<span class="badge bg-' + row.status_color + '">' + data + '</span>';
    }
  },
  {data: "doc_verified_at", className: "text-left"},
  {
    data: "doc_id",
    render: function(data, type, row){
      return '<a href="<?= base_url() ?>prints/pdf/' + data + '" class="btn btn-info btn-sm" target="_blank">Cetak</a>';
    }
  }
  
  ],
  rowCallback: function(row, data, iDisplayIndex){
  var info  = this.fnPagingInfo();
  var page  = info.iPage;
  var length  = info.iLength;
  var index   = page * length + (iDisplayIndex + 1);
  $("td:eq(0)", row).html(index);
  }
});

$('#searching').on('keyup', function(){
  table.search(this.value).draw();
});

$('select#pagelength').on('change', function(){
  table.page.len(this.value).draw();
});
</script>
