	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<div class="card" style="width: 60%">
			<div class="card-body">
				
				<form method="POST" action="<?= base_url('admin/PotonganGaji/tambahAksi') ?>">
					
					<div class="form-group">
						<label>Jenis Potongan</label>
						<input type="text" name="potongan" class="form-control">
						<?= form_error ('potongan', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<div class="form-group">
						<label>Jumlah Potongan</label>
						<input type="number" name="jml_potongan" class="form-control">
						<?= form_error ('jml_potongan', '<div class="text-small text-danger"> </div>') ?>
					</div>

					<button type="submit" class="btn btn-primary">Simpan</button>

				</form>

			</div>
		</div>


	</div>
</div>