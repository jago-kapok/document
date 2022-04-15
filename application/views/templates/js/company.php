<script>
var table = $("table#table_data").DataTable({
  processing 	: true,
  language	: {
	lengthMenu	: "_MENU_",
	zeroRecords	: "<center>Tidak Ada Data</center>",
	processing	: "<center>Silakan Tunggu</center>",
	paginate	: {
	  previous: "PREV",
	  next: "NEXT"
	},
  },
  bInfo 		: true,
  bLengthChange : false,
  serverSide	: true,
  scrollX		: true,
  ajax	: {
	url	: "<?= base_url('company/getData'); ?>",
	type: "GET"
  },
  iDisplayLength: 10,
  columns: [
	{data: null,			className: "text-left"},
	{data: "company_name",	className: "text-left"},
	{data: "company_business",		className: "text-left"},
	{data: "company_office_address",	className: "text-left"},
	{data: "company_pic",	className: "text-left"},
	{
	  data: "company_id",
	  render: function(data, type, row){
		  return '<a href="<?= base_url() ?>company/view/' + data + '" class="btn btn-warning btn-sm"><i class="bi-search"></i></a>&nbsp;<a href="<?= base_url() ?>company/update/' + data + '" class="btn btn-info btn-sm"><i class="bi-pencil-square"></i></a>&nbsp;<button class="btn btn-danger btn-sm" onclick="hapusData(' + data + ')"><i class="bi-trash"></i></button>';
	  }
	}
	
  ],
  rowCallback: function(row, data, iDisplayIndex){
	var info 	= this.fnPagingInfo();
	var page 	= info.iPage;
	var length 	= info.iLength;
	var index 	= page * length + (iDisplayIndex + 1);
	$("td:eq(0)", row).html(index);
  }
});

$('#searching').on('keyup', function(){
  table.search(this.value).draw();
});

$('select#pagelength').on('change', function(){
  table.page.len(this.value).draw();
});

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
        url: "<?= base_url() ?>company/delete/" + id,
        dataType: "json",
        processData: false,
        contentType: false,
        cache: false,
      })
      .done(function (data) {
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
