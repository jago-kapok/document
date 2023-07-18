<div class="container-fluid mt-2">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manajemen Akun</li>
		</ol>
	</nav>

	<div class="row">
		<form id="form_data" class="col-md-8">
			<div class="card" data-aos="fade-up" data-aos-delay="200">
				<div class="container-fluid bg-app rounded-2 py-1 px-2 mb-3">
					<span class="text-light"><b>AKUN SAYA</b></span>
				</div>
				
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Nama Profil <span class="text-danger">*</span></label>
					<div class="col-md-7">
						<input type="text" name="username" class="form-control" value="<?= user()->username ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Username / Email <span class="text-danger">*</span></label>
					<div class="col-md-7">
						<input type="email" name="email" class="form-control" value="<?= user()->email ?>" readonly>
						<div class="form-text text-danger">Mohon gunakan email aktif untuk username</div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Password baru</label>
					<div class="col-md-7">
						<input type="password" name="new_auth" class="form-control">
						<div class="form-text text-danger">Biarkan kosong jika tidak ingin merubah password</div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-md-5 col-form-label">Konfirmasi password baru</label>
					<div class="col-md-7">
						<input type="password" name="confirm_auth" class="form-control">
						<div class="form-text text-danger">Biarkan kosong jika tidak ingin merubah password</div>
					</div>
				</div>

				<div class="border-top pt-3">
					<button id="submit_form" type="button" class="btn btn-primary"><span class="btn-icon" data-feather="save"></span>
						&nbsp;&nbsp;Perbarui Data
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$("input[name=email]").on({
		keydown: function(event) {
			if (event.which === 32)
				return false;
		},
		// if a space copied and pasted in the input field, replace it (remove it):
		change: function() {
			this.value = this.value.replace(/\s/g, "");
		}
	});

	$("#submit_form").click(function()
	{
		Swal.fire({
			title: 'PERHATIAN !',
			text: "Anda yakin ingin merubah akun anda ?",
			icon: 'question',
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
					url: "<?= base_url('user/updateProfile') ?>",
					dataType: "json",
					data: data,
					processData: false,
					contentType: false,
					cache: false,
				})
				.done(function (data) {
					if(data.success == true) {
						Swal.fire('SUCCESS !', data.message, 'success')
						.then((result) => {
							location.reload();
						});
					} else {
						$.each(data.errors, function(index, value) {
							Swal.fire('ERROR !', value, 'error');
						});
					}
				});
			}
		});
	});
</script>