	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<table class="table table-striped table-bordered">
			<tr>
				<th>Bulan/Tahun</th>
				<th>Gaji Pokok</th>
				<th>Uang Makan</th>
				<th>Potongan</th>
				<th>Total Gaji</th>
				<th>Cetak Slip Gaji</th>
			</tr>

		<?php foreach($potongan as $p) { ?>
			<?php $potongan = $p->jml_potongan; ?>
		<?php } ?>

		<?php foreach($gaji as $g) { ?>
		<?php $pot_gaji = $g->alpha * $potongan ?>
		<tr>
			<td><?= $g->bulan ?></td>
			<td>Rp. <?= number_format($g->gaji_pokok,0,',','.') ?></td>
			<td>Rp. <?= number_format($g->uang_makan,0,',','.') ?></td>
			<td>Rp. <?= number_format($pot_gaji,0,',','.') ?></td>
			<td>Rp. <?= number_format($g->gaji_pokok + $g->uang_makan - $pot_gaji,0,',','.') ?></td>
			<td>
				<center>
					<a class="btn btn-sm btn-primary" href="<?= base_url('karyawan/DataGaji/cetakSlip/'.$g->id_kehadiran) ?>"><i class="fas fa-print"></i></a>
				</center>
			</td>
		</tr>

		<?php } ?>

		</table>

	</div>
</div>