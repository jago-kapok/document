<script>
var table = $("table#table_data").DataTable({
  processing 	: true,
  language	: {
    lengthMenu	: "_MENU_",
    zeroRecords	: "<center>Tidak Ada Data</center>",
    processing	: "<center>Silakan Tunggu</center>",
    paginate	: {
      previous: "<i class=\"fa fa-chevron-left\"></i>",
      next: "<i class=\"fa fa-chevron-right\"></i>"
    },
  },
  bInfo 		: true,
  bLengthChange : false,
  serverSide	: true,
  scrollX		: true,
  ajax	: {
    url	: "<?= base_url('admin/getData'); ?>",
    type: "GET"
  },
  iDisplayLength: 10,
  columns: [
    {data: null,			    className: "text-left"},
    {data: "created_at",	className: "text-left"},
    {data: "kecamatan",	  className: "text-left"},
    {data: "nama_desa",	  className: "text-left"},
    {data: "no_kk_krt",		className: "text-left"},
    {data: "nama_krt",	  className: "text-left"},
    {data: "jumlah_art",	className: "text-right"},
    {
      data: "main_id",
        render: function(data, type, row) {
          <?php if($this->session->userdata('user_level') == 1) { ?>
            return '<a href="<?php base_url() ?>admin/view/' + data + '" class="btn btn-success btn-sm"><i class="bi-search"></i></a>&nbsp;<a href="javascript:void(0)' + data + '" class="btn btn-danger btn-sm" onclick="hapusData()"><i class="bi-trash"></i></a>';
          <?php } else { ?>
            return '<a href="<?php base_url() ?>admin/view/' + data + '" class="btn btn-success btn-sm"><i class="bi-search"></i></a>';
          <?php } ?>
      }
    }	
  ],
  order: [0, 'desc'],
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

$('.filter-category').on('click', function(){
  table.search(this.id).draw();
});

function hapusData()
{
  Swal.fire({
    text: 'Untuk menghapus data, hubungi administrator',
    icon: 'warning',
    title: 'Perhatian !',
    showConfirmButton: true,
  });
}
</script>