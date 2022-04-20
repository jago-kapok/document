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
  order: [5, 'desc'],
  ajax	: {
	url	: "<?= base_url('verify/getData'); ?>",
	type: "GET"
  },
  iDisplayLength: 10,
  columns: [
	{data: null,			className: "text-left"},
	{data: "company_name",	className: "text-left"},
	{data: "company_address",		className: "text-left"},
	{data: "company_pic",	className: "text-left"},
	{
    data: "status_desc",
    render: function(data, type, row){
      return '<span class="badge bg-warning">' + data + '</span>';
    }
  },
	{
	  data: "doc_id",
	  render: function(data, type, row){
		  return '<a href="<?= base_url() ?>verify/view/' + data + '" class="btn btn-success btn-sm"><i class="bi-check-square"></i></a>';
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
</script>
