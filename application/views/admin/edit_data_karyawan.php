		<div class="container-fluid">

			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
			</div>

			<div class="card" style="width: 60%">
				<div class="card-body">
					
					<?php foreach ($karyawan as $k) : ?>

						<form method="POST" action="<?= base_url('admin/karyawan/editAksi') ?>" enctype="multipart/form-data">

						<input type="hidden" name="id_karyawan" class="form-control" value="<?= $k->id_karyawan ?>">

						<div class="form-group">
							<label>Nama Karyawan</label>
							<input type="text" name="nama_karyawan" class="form-control" value="<?= $k->nama_karyawan ?>">
							<?= form_error ('nama_karyawan', '<div class="text-small text-danger"> </div>') ?>
						</div>
						
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" value="<?= $k->username ?>">
							<?= form_error ('username', '<div class="text-small text-danger"> </div>') ?>
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select name="jenis_kelamin" class="form-control">
								<option value="<?= $k->jenis_kelamin ?>"><?= $k->jenis_kelamin ?></option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
							<?= form_error ('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
						</div>

						<div class="form-group">
							<label>Jabatan</label>
							<select name="jabatan" class="form-control">
								<option value="<?= $k->jabatan ?>"><?= $k->jabatan ?></option>
								<?php foreach ($jabatan as $j) : ?>
									<option value="<?= $j->nama_jabatan ?>"><?= $j->nama_jabatan ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error ('jabatan', '<div class="text-small text-danger"> </div>') ?>
						</div>

						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" class="form-control" value="<?= $k->foto ?>">
							<?= form_error ('foto', '<div class="text-small text-danger"> </div>') ?>
						</div>

						<div class="form-group">
						<label>Hak Akses</label>
						<select name="hak_akses" class="form-control">
							<option value="<?= $k->hak_akses ?>">
								<?php 
									if ($k->hak_akses == '1') {
										echo "Admin";
									} else {
										echo "Karyawan";
									}
									
								?>
							</option>
								<option value="1">Admin</option>
								<option value="2">Karyawan</option>
						</select>
						<?= form_error ('hak_akses', '<div class="text-small text-danger"> </div>') ?>
					</div>

						<button type="submit" class="btn btn-success">Submit</button>

					</form>

				<?php endforeach ?>

			</div>
		</div>

	</div>
</div>