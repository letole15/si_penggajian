    <div class="container-fluid">

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
     </div>

     <?= $this->session->flashdata('pesan') ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-3 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Input Kehadiran Karyawan</h6>
      </div>
      <div class="card-body">
        <form class="form-inline">

          <div class="form-group mb-2">
            <label for="staticEmail2">Bulan :</label>
            <select class="form-control ml-2" name="bulan">
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
          </div>

          <div class="form-group mb-2 ml-3">
            <label for="staticEmail2 ml-3">Tahun :</label>
            <select class="form-control ml-2" name="tahun">
              <option value="">-- Pilih Tahun --</option>
              <?php $tahun = date('Y');
              for ($i=2010; $i<$tahun+1; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php  } ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i>Generate</button>

        </form>

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

        <div class="alert alert-info">
          Menampilkan Data Kehadiran Karyawan Bulan: <?= $bulan ?> <span class="font-weight-bold"></span> Tahun: <?= $tahun ?> <span class="font-weight-bold"></span>
        </div>

        <form method="POST">
        <div class="table-responsive">
          <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">


            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th width="8%">Hadir</th>
                <th width="8%">Sakit</th>
                <th width="8%">Alpha</th>
              </tr>
            </thead>
            <tfoot class="text-center">
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th width="8%">Hadir</th>
                <th width="8%">Sakit</th>
                <th width="8%">Alpha</th>
              </tr>
            </tfoot>
			<?php $no=1; foreach ($input_absensi as $a) { ?>
	          	<input type="hidden" name="bulan[]" class="form-control" value="<?= $bulantahun ?>">
	          	<input type="hidden" name="username[]" class="form-control" value="<?= $a['username'] ?>">
	          	<input type="hidden" name="nama_karyawan[]" class="form-control" value="<?= $a['nama_karyawan'] ?>">
	          	<input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?= $a['jenis_kelamin'] ?>">
	          	<input type="hidden" name="nama_jabatan[]" class="form-control" value="<?= $a['nama_jabatan'] ?>">
	            
	            <tbody>
	              <tr>
	                <td><?= $no++ ?></td>
	                <td><?= $a['username'] ?></td>
	                <td><?= $a['nama_karyawan'] ?></td>
	                <td><?= $a['jenis_kelamin'] ?></td>
	                <td><?= $a['jabatan'] ?></td>
	                <td><input type="number" name="hadir[]" class="form-control" value="0"></td>
	                <td><input type="number" name="libur[]" class="form-control" value="0"></td>
	                <td><input type="number" name="alpha[]" class="form-control" value="0">
	            </tr>
          	<?php } ?>
        </tbody>
      </table>

      <?php if(empty($input_absensi)) : ?>
        <div class="alert alert-danger text-center" role="alert">Data tidak ditemukan.</div>
      <?php endif; ?>

      <button class="btn btn-success mb-3" type="submit" name="submit" value="submit">Simpan</button>

  		</form>

    </div>
  </div>
</div>

</div>

</div>