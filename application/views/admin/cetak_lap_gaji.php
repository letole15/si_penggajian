<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
	</style>
</head>
<body>

	<center>
    <h1><img class="img-profile" src="<?= base_url('assets/foto/logo-2.jpg') ?>"></h1>
    <hr style="width: 25%; border-width: 5px; color: black">
    <h2>Daftar Laporan Gaji</h2>
    <hr style="width: 25%; border-width: 5px; color: black">
	</center>

  <?php 
  if((isset($_GET['bulan']) && $_GET['bulan'] != null) && (isset($_GET['tahun']) && $_GET['tahun'] != null)) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulanTahun = $bulan.$tahun;
  } else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulanTahun = $bulan.$tahun;
  }
  ?>

  <table>
    <tr>
     <td>Bulan</td>
     <td>:</td>
     <td><?= $bulan ?></td>
   </tr>
   <tr>
     <td>Tahun</td>
     <td>:</td>
     <td><?= $tahun ?></td>
   </tr>
 </table>

 <table class="table table-bordered table-striped" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Karyawan</th>
      <th>Jenis Kelamin</th>
      <th>Jabatan</th>
      <th>Gaji Pokok</th>
      <th>Tunjangan Intensif</th>
      <th>Bonus</th>
      <th>Tunjangan Hari Raya(THR)</th>
      <th>Total Transportasi</th>
      <th>Total Potongan</th>
      <th>Total Gaji</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($potongan as $p) { ?>
      <?php $alpa = $p['jml_potongan']; ?>
    <?php } ?>
    <?php $no = 1; foreach($cetakGaji as $g) : ?>
    <?php $potongan = $g['alpha'] * $alpa; ?>

    <tr>
      <td><?= $no++ ?></td>
      <td><?= $g['nama_karyawan'] ?></td>
      <td><?= $g['jenis_kelamin'] ?></td>
      <td><?= $g['nama_jabatan'] ?></td>
      <td>Rp. <?= number_format($g['gaji_pokok'],0,',','.') ?></td>
      <td>Rp. <?= number_format($g['intensif'],0,',','.') ?></td>
      <td>Rp. <?= number_format($g['bonus'],0,',','.') ?></td>
      <td>Rp. <?= number_format($g['thr'],0,',','.') ?></td>
      <td>Rp. <?= number_format($g['uang_transport'] * $g['hadir'] ,0,',','.')?></td>
      <td>Rp. <?= number_format($potongan,0,',','.') ?></td>
      <td>Rp. <?= number_format($g['gaji_pokok'] + $g['intensif'] + $g['bonus'] + $g['thr'] + $g['uang_transport'] * $g['hadir'] - $potongan,0,',','.') ?></td>
    </tr>
  <?php endforeach; ?>
</tbody>
</table>
<?php if(empty($cetakGaji)) : ?>
  <div class="alert alert-danger text-center" role="alert">Bulan : <?= $bulan; ?> Tahun : <?= $tahun; ?> Data Belum Di Inputkan.</div>
<?php endif; ?> 

<table width="100%">
 <tr>
  <td></td>
  <td width="200px">
   <p>Jakarta, <?= date("d M Y") ?> <br> Pelangi Frame </p>
   <br>
   <br>
   <br>
   <p>__________________________</p>
 </td>
</tr>
</table>

</body>
</html>

<script>
	window.print();
</script>