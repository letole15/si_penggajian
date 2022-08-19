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
		<h2>Daftar Absensi Karyawan</h2>
	</center>

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

 <div class="table-responsive">
  <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Karyawan</th>
        <th>Username</th>
        <th>Jenis Kelamin</th>
        <th>Jabatan</th>
        <th>Hadir</th>
        <th>Libur</th>
        <th>Alpha</th>
      </tr>
    </thead>

    <tbody>
      <?php $no=1; foreach ($lap_kehadiran as $l) { ?>
       <tr>
         <td><?= $no++ ?></td>
         <td><?= $l['nama_karyawan'] ?></td>
         <td><?= $l['username'] ?></td>
         <td><?= $l['jenis_kelamin'] ?></td>
         <td><?= $l['nama_jabatan'] ?></td>
         <td><?= $l['hadir'] ?></td>
         <td><?= $l['libur'] ?></td>
         <td><?= $l['alpha'] ?></td>
       </tr>
     <?php } ?>
   </tbody>
 </table>

 <?php if(empty($lap_kehadiran)) : ?>
  <div class="alert alert-danger text-center" role="alert">Data Tidak Ditemukan!</div>
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

<!-- <script type="text/javascript">
	window.print();
</script> -->