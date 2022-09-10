<?php 
if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
	    $bulan = $_POST['bulan'];
	    $tahun = $_POST['tahun'];
	    $bulanTahun = $bulan.$tahun;
	} else {
	    $bulan = date('m');
	    $tahun = date('Y');
	    $bulanTahun = $bulan.$tahun;
	}
?>
	<div class="row">
		<div class="col-md">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">PT.Pegawai Indonesia</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th>Nama Karyawan</th>
										<td><?= $slip['nama_karyawan']; ?></td>
									</tr>
									<tr>
										<th>Jabatan</th>
										<td><?= $slip['nama_jabatan']; ?></td>
									</tr>
									<tr>
										<th>Bulan</th>
										<td><?= $bulan; ?></td>
									</tr>
									<tr>
										<th>Tahun</th>
										<td><?= $tahun; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<tr>
										<th>No</th>
										<th>Keterangan</th>
										<th>Jumlah</th>
									</tr>
									<tr>
										<td>1</td>
										<td>Gaji Pokok</td>
										<td>Rp.<?= number_format($slip['gaji_pokok'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Tj.Transportasi</td>
										<td>Rp.<?= number_format($slip['tj_transport'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Tj.Uang Makan</td>
										<td>Rp.<?= number_format($slip['uang_makan'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<?php foreach($potongan as $p) : ?>
											<?php $alpha = $p['jml_potongan'] * $slip['alpha']; ?>
										<?php endforeach; ?>
										<td>4</td>
										<td>Potongan / Alpa</td>
										<td>Rp.<?= number_format($alpha, 0, ',', '.'); ?></td>
									</tr>
									<tr class="text-center font-weight-bold">
										<td></td>
										<td>Total Gaji</td>
										<td>Rp.<?= number_format($slip['uang_makan'] + $slip['tj_transport'] + $slip['gaji_pokok'] - $alpha, 0, ',', '.'); ?></td>
									</tr>
								</table>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset-md-9">
							<table>
								<tr>
									<td></td>
									<td>
										<p>Pekanbaru, <?= date('d M Y'); ?><br>Finance
                                        <br><br>
                                        <p>_______________________</p>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	window.print();
</script>