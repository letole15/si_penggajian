	<div class="container-fluid">

		<div class="card mx-auto" style="width: 35%">
			<div class="card-header bg-primary text-white">
				<center><?= $title; ?></center>
			</div>

			<form method="POST" action="<?= base_url('admin/SlipGaji/cetakSlipGaji') ?>" target="_blank">

				<div class="card-body">
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-3 col-form-label">Bulan</label>
						<div class="col-sm-9">
							<select class="form-control" name="bulan" id="bulan">
								<option value="">-- Pilih Bulan --</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
							<small class="muted text-danger"><?= form_error('bulan'); ?></small>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPassword" class="col-sm-3 col-form-label">Tahun</label>
						<div class="col-sm-9">
							<select class="form-control" name="tahun" id="tahun">
								<option value="">-- Pilih Tahun --</option>
								<?php $tahun = date('Y');
								for($i=2020; $i<$tahun + 5; $i++) { ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php  } ?>
							</select>
							<small class="muted text-danger"><?= form_error('tahun'); ?></small>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPassword" class="col-sm-3 col-form-label">Karyawan</label>
						<div class="col-sm-9">
							<select class="form-control" name="karyawan" id="karyawan">
								<option value="">-- Pilih Karyawan --</option>
								<?php foreach ($karyawan as $k) :  ?>
									<option value="<?= $k['username'] ?>"><?= $k['nama_karyawan'] ?></option>
								<?php endforeach; ?>
							</select>
							<small class="muted text-danger"><?= form_error('karyawan'); ?></small>
						</div>
					</div>

					<button style="width: 100%" type="submit" class="btn btn-primary">
						<i class="fas fa-print"></i>
						Cetak Slip Gaji
					</button>

				</div>
			</div>

		</form>

	</div>
</div>