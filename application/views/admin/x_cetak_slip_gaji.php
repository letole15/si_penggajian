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
		<h1>PELANGI FRAME</h1>
		<h2>Daftar Slip Gaji</h2>
    <hr style="width: 50%; border-width: 5px; color: black">
  </center>

<?php 
  if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!=''))
  {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulantahun = $bulan.$tahun;
  } else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulantahun = $bulan.$tahun;
  }
?>

<!--   <?php foreach ($potongan as $slip) { ?>
    <?php $potongan = $slip['jml_potongan']; ?>
  <?php } ?>  

  <?php $no=1; foreach ($print_slip as $slip) { ?>

    <?php $potongan_gaji = $slip['alpha'] * $potongan; ?> -->

    <table style="width: 100%">
      <tr>
       <td width="10%">Nama Karyawan</td>
       <td width="1%">:</td>
       <td><?= $slip['nama_karyawan'] ?></td>
     </tr>
     <tr>
      <td>Username</td>
      <td>:</td>
      <td><?= $slip['username'] ?></td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>:</td>
      <td><?= $slip['nama_jabatan'] ?></td>
    </tr>
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

<!-- <?php } ?> -->

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
      <td>Rp. <?= number_format($slip['gaji_pokok'],0,',','.') ?></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Uang Makan</td>
      <td>Rp. <?= number_format($slip['uang_makan'] * $slip['hadir'],0,',','.') ?></td>
    </tr>
    <tr>

      <?php foreach($potongan as $p) : ?>
        <?php $potongan_gaji = $p['jml_potongan'] * $slip['alpha']; ?>
      <?php endforeach; ?>

      <td>3</td>
      <td>Potongan</td>
      <td>Rp. <?= number_format($potongan_gaji,0,',','.') ?></td>
    </tr>
    <tr>
      <th colspan="2" style="text-align: right;">Total Gaji</th>
      <th>Rp. <?= number_format($slip['gaji_pokok'] + $slip['uang_makan'] * $slip['hadir'] - $potongan_gaji,0,',','.') ?></th>
    </tr>
  </thead>
</table>

<table style="width: 20%">
  <tr>
    <td>Hadir</td>
    <td>:</td>
    <td><?= $slip['hadir'] ?></td>
    <td>|</td>
    <td>Libur</td>
    <td>:</td>
    <td><?= $slip['libur'] ?></td>
    <td>|</td>
    <td>Alpha</td>
    <td>:</td>
    <td><?= $slip['alpha'] ?></td>
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
      <p><?= $slip['nama_karyawan'] ?></p>  
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

</body>
</html>

<script>
	window.print();
</script>