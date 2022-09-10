	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<div class="alert alert-success font-weight-bold mb-4" style="width: 65%">Selamat datang, Anda login sebagai karyawan.</div>

		<div class="card" style="margin-bottom: 120px; width: 65%">
			<div class="card-header font-weight-bold bg-primary text-white">
				Data Saya
			</div>

			<?php foreach($karyawan as $k) { ?>

			<div class="card-body">
				<div class="row">
				<div class="col-md-5">
					<img style="width: 250px" src="<?= base_url('assets/foto/'.$k->foto) ?>">
				</div>
					<div class="col-md-7">
						<table class="table">
							<tr>
								<td>Nama Karyawan</td>
								<td>:</td>
								<td><?= $k->nama_karyawan ?></td>
							</tr>
							<tr>
								<td>Username</td>
								<td>:</td>
								<td><?= $k->username ?></td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td>:</td>
								<td><?= $k->jabatan ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?= $k->jenis_kelamin ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<?php } ?>

		</div>

	</div>
</div>