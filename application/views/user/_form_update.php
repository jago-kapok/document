<div class="container-fluid mt-2">
  <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Manajemen Akun</li>
	  </ol>
	</nav>

  <div class="card">
    <form id="form_data">
    	<input type="hidden" name="user_id" value="<?php echo $user->user_id ?>">
	    <div class="row">
	      <div class="col-md-12">
	      	<div class="container-fluid bg-info p-1 mb-3">
	      		<span class="text-light"><center><b>AKUN SAYA</b></center></span>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-6">
			        <div class="row mb-3">
			          <label class="col-md-4 col-form-label">Username / Email <span class="text-danger">*</span></label>
			          <div class="col-md-7">
			            <input id="user_name" type="email" name="user_name" class="form-control" value="<?php echo $user->user_name ?>">
			            <div class="form-text">Mohon gunakan email aktif untuk username</div>
			          </div>
			        </div>
			        <div class="row mb-3">
			          <label class="col-md-4 col-form-label">Password</label>
			          <div class="col-md-7">
			            <input type="password" class="form-control" value="<?php echo $user->user_password ?>" readonly>
			          </div>
			        </div>
			      </div>

			      <div class="col-md-6">
			        <div class="row mb-3">
			          <label class="col-md-4 col-form-label">Password baru</label>
			          <div class="col-md-8">
			            <input type="password" name="new_auth" class="form-control">
			            <div class="form-text">Biarkan kosong jika tidak ingin merubah password</div>
			          </div>
			        </div>
			        <div class="row mb-3">
			          <label class="col-md-4 col-form-label">Konfirmasi password baru</label>
			          <div class="col-md-8">
			            <input type="password" name="confirm_auth" class="form-control">
			            <div class="form-text">Biarkan kosong jika tidak ingin merubah password</div>
			          </div>
			        </div>
			      </div>
			    </div>
	      </div>

	      <div class="modal-footer justify-content-start">
	        	<button type="submit" class="btn btn-primary"><span class="btn-icon" data-feather="save"></span>&nbsp;&nbsp;Simpan</button>
	        	<a href="<?= base_url() ?>admin/user" class="btn btn-danger ms-1"><span class="btn-icon" data-feather="slash"></span>&nbsp;&nbsp;Kembali</a>
	        </div>
	    </div>
  	</form>
  </div>
</div>

<script>
	$("#user_name").on({
		keydown: function(event) {
		if (event.which === 32)
			return false;
		},
		// if a space copied and pasted in the input field, replace it (remove it):
		change: function() {
			this.value = this.value.replace(/\s/g, "");
		}
	});

	$("form").submit(function (event) {
    event.preventDefault();

    Swal.fire({
	    title: 'PERHATIAN !',
	    text: "Anda yakin ingin merubah data akun anda ?",
	    icon: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    confirmButtonText: 'Ya',
	    cancelButtonText: 'Batal'
	  }).then((result) => {
	    if (result.isConfirmed) {
	    	var data = new FormData($("#form_data")[0]);

	      $.ajax({
	        type: "POST",
	        url: "<?= base_url() ?>user/updateProfile/",
	        dataType: "json",
	        data: data,
	        processData: false,
	        contentType: false,
	        cache: false,
	      })
	      .done(function (data) {
	        if(data.success == true) {
		        Swal.fire({
		          icon: 'success',
		          title: 'SUCCESS !',
		          text: 'Data akun anda berhasil diperbarui',
		          showConfirmButton: true
		        }).then(function() {
		        	window.location = '<?= base_url() ?>user/setting';
		        });
		      } else {
		      	$.each(data.errors, function(index, value) {
			      	Swal.fire({
			          icon: 'warning',
			          title: 'ERROR !',
			          text: value,
			          showConfirmButton: true
			        });
			      });
		      }
	      });
	    }
	  });
  });
</script>