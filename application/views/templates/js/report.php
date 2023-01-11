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
  order: [6, 'desc'],
  ajax  : {
  url : "<?= base_url('report/getData'); ?>",
    type: "GET"
  },
  iDisplayLength: 10,
  columns: [
    {data: null,      className: "text-left"},
    {data: "doc_year",  className: "text-left"},
    {data: "doc_periode", className: "text-left"},
    {
      data: "company_name",
      render: function(data, type, row){
        return data + '<br><b>Lokasi Kegiatan : </b>' + row['company_address'] + '<br><b>Penanggung Jawab : </b>' + row['company_pic'];
      }
    },
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
        return '<a href="<?= base_url() ?>report/view/' + data + '" class="btn btn-primary btn-sm"><i class="bi-search"></i></a>&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(' + data + ')"><i class="bi-trash"></i></a>';
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

/* Hapus Data Laporan */
function deleteData(id)
{
  Swal.fire({
    title: 'PERHATIAN !',
    text: "Anda yakin ingin menghapus data ini ?",
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
        url: "<?= base_url() ?>report/delete?id=" + id,
        dataType: "json",
        processData: false,
        contentType: false,
        cache: false,
      })
      .done(function (data) {
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Data laporan berhasil dihapus !',
          showConfirmButton: true
        }).then((result) => {
          table.draw();
        });
      });
    }
  })
}
</script>
