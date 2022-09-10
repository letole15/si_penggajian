	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<div class="card" style="width: 50%">
			<div class="card-body">
				<form method="POST" action="<?= base_url('gantiPassword/gantiPassAksi') ?>">
					
					<div class="form-group">
						<label>Password Baru</label>
						<input class="form-control" type="password" name="passBaru"></input>
						<?= form_error ('passBaru', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Ulangi Password Baru</label>
						<input class="form-control" type="password" name="ulangPassBaru"></input>
						<?= form_error ('ulangPassBaru', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<button type="submit" class="btn btn-success">Simpan</button>

				</form>
			</div>
		</div>


	</div>
</div>