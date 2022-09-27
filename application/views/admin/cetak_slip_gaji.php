<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
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
    <h2>Daftar Slip Gaji</h2>
    <hr style="width: 25%; border-width: 5px; color: black">
  </center>

<?php 
  if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!=''))
  {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulanTahun = $bulan.$tahun;
  } else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulanTahun = $bulan.$tahun;
  }
  ?>

  <?php foreach($potongan as $p) { 
    $potongan = $p->jml_potongan; 
  } ?>  

  <?php $no=1; foreach($print_slip as $ps) : ?>

  <?php $potongan_gaji = $ps->alpha * $potongan; ?>

  <table style="width: 100%">
    <tr>
     <td width="10%">Nama Karyawan</td>
     <td width="1%">:</td>
     <td><?= $ps->nama_karyawan; ?></td>
   </tr>
   <tr>
    <td>Username</td>
    <td>:</td>
    <td><?= $ps->username; ?></td>
  </tr>
  <tr>
    <td>Jabatan</td>
    <td>:</td>
    <td><?= $ps->nama_jabatan; ?></td>
  </tr>
  <tr>
    <td>Bulan</td>
    <td>:</td>
    <td><?= $bulan; ?></td>
  </tr>
  <tr>
   <td>Tahun</td>
   <td>:</td>
   <td><?= $tahun; ?></td>
 </tr>
</table>

<table class="table table-striped table-bordered mt-2">
  <thead>
    <tr class="text-center">
      <th>No</th>
      <th>Keterangan</th>
      <th>Jumlah</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Gaji Pokok</td>
      <td>Rp. <?= number_format($ps->gaji_pokok,0,',','.'); ?></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Intensif</td>
      <td>Rp. <?= number_format($ps->intensif,0,',','.'); ?></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Bonus</td>
      <td>Rp. <?= number_format($ps->bonus,0,',','.'); ?></td>
    </tr>
    <tr>
      <td>4</td>
      <td>Tunjangan Hari Raya(THR)</td>
      <td>Rp. <?= number_format($ps->thr,0,',','.'); ?></td>
    </tr>
    <tr>
      <td>5</td>
      <td>Uang Transportasi</td>
      <td>Rp. <?= number_format($ps->uang_transport * $ps->hadir,0,',','.'); ?></td>
    </tr>
    <tr>
      <td>6</td>
      <td>Potongan</td>
      <td>Rp. <?= number_format($potongan_gaji,0,',','.'); ?></td>
    </tr>
    <tr>
      <th colspan="2" style="text-align: right;">Total Gaji</th>
      <th>Rp. <?= number_format($ps->gaji_pokok + $ps->intensif + $ps->bonus + $ps->thr + $ps->uang_transport * $ps->hadir - $potongan_gaji,0,',','.'); ?></th>
    </tr>
  </thead>
</table>

<table style="width: 20%">
  <tr>
    <td>Hadir</td>
    <td>:</td>
    <td><?= $ps->hadir; ?></td>
    <td>|</td>
    <td>Libur</td>
    <td>:</td>
    <td><?= $ps->libur; ?></td>
    <td>|</td>
    <td>Alpha</td>
    <td>:</td>
    <td><?= $ps->alpha; ?></td>
  </tr>
</table>

<table width="100%">
  <br>
  <tr>
    <td>
      <p>Karyawan<br> Pelangi Frame </p>
      <br>
      <br>
      <br>
      <p>__________________________</p>
      <p><?= $ps->nama_karyawan; ?></p>  
    </td>
    <td width="200px">
     <p>Jakarta, <?= date("d M Y") ?> <br> Owner Pelangi Frame </p>
     <br>
     <br>
     <br>
     <p>__________________________</p>
   </td>
 </tr>
</table>

<?php endforeach; ?>

</body>
</html>

<script>
	window.print();
</script>