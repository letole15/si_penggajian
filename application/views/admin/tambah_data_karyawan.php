	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<div class="card" style="width: 60%">
			<div class="card-body">
				
				<form method="POST" action="<?= base_url('admin/karyawan/tambahAksi') ?>" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama Karyawan</label>
						<input type="text" name="nama_karyawan" class="form-control">
						<?= form_error ('nama_karyawan', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control">
						<?= form_error ('username', '<div class="text-small text-danger"> </div>') ?>
					</div>
					
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" class="form-control">
						<?= form_error ('password', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jenis_kelamin" class="form-control">
							<option value="">- Pilih Jenis Kelamin -</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
						<?= form_error ('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Jabatan</label>
						<select name="jabatan" class="form-control">
							<option value="">- Pilih Jabatan -</option>
							<?php foreach ($jabatan as $j) : ?>
								<option value="<?= $j->nama_jabatan ?>"><?= $j->nama_jabatan ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error ('jabatan', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Foto</label>
						<input type="file" name="foto" class="form-control">
						<?= form_error ('foto', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Hak Akses</label>
						<select name="hak_akses" class="form-control">
							<option value="">- Pilih Hak Akses -</option>
								<option value="1">Admin</option>
								<option value="2">Karyawan</option>
						</select>
						<?= form_error ('hak_akses', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<button type="submit" class="btn btn-success">Simpan</button>

				</form>

			</div>
		</div>


	</div>
</div>