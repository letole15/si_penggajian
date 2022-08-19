<!-- <?php

if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
  $bulan = $this->input->post('bulan');
  $tahun = $this->input->post('tahun');
  $bulanTahun = $bulan.$tahun;
} else {
  $bulan = date('m');
  $tahun = date('Y');
  $bulanTahun = $bulan.$tahun;
}
?> -->

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <?= $this->session->flashdata('pesan') ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary">
      <h6 class="m-0 font-weight-bold text-white">Filter Data Gaji Karyawan</h6>
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
            for ($i=2020; $i<$tahun+5; $i++) { ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php  } ?>
          </select>
        </div>

        <?php
        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
          $bulan = $_GET['bulan'];
          $tahun = $_GET['tahun'];
          $bulanTahun = $bulan.$tahun;
        }else{
          $bulan = date('m');
          $tahun = date('Y');
          $bulanTahun = $bulan.$tahun;
        }
        ?>

        <button type="submit" class="btn btn-primary mb-3 ml-auto"><i class="fas fa-eye"></i>Tampilkan</button>

        <?php if(count($gaji) > 0) { ?>
          <a href="<?= base_url('admin/gaji/cetakGaji?bulan='.$bulan),'&tahun='.$tahun?>" class="btn btn-success mb-3 ml-3"><i class="fas fa-print"></i> Cetak Daftar Gaji </a>
        <?php } else { ?>
          <button type="button" class="btn btn-success mb-3 ml-3" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Daftar Gaji </button>
        <?php } ?>

      </form>

      <?php
      if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulanTahun = $bulan.$tahun;
      }else{
        $bulan = date('m');
        $tahun = date('Y');
        $bulanTahun = $bulan.$tahun;
      }
      ?>

      <div class="alert alert-info">
        Menampilkan Data Gaji Karyawan Bulan: <?= $bulan ?> <span class="font-weight-bold"></span> Tahun: <?= $tahun ?> <span class="font-weight-bold"></span>
      </div>

      <?php 

      $jml_data = count($gaji);
      if($jml_data > 0 ) { ?>

        <div class="table-responsive">
          <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
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
                <th>Uang Transportasi</th>
                <th>Hadir</th>
                <th>Total Uang Transportasi</th>
                <th>Potongan</th>
                <th>Alpha</th>
                <th>Total Potongan</th>
                <th>Total Gaji</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Intensif</th>
                <th>Bonus</th>
                <th>Tunjangan Hari Raya(THR)</th>
                <th>Uang Transportasi</th>
                <th>Hadir</th>
                <th>Total Uang Transportasi</th>
                <th>Potongan</th>
                <th>Alpha</th>
                <th>Total Potongan</th>
                <th>Total Gaji</th>
              </tr>
            </tfoot>

            <tbody>
              <?php foreach ($potongan as $p) : {
                $alpha = $p->jml_potongan; 
              } ?>

              <?php $no=1; foreach ($gaji as $g) : ?>
              <?php $potongan = $g->alpha * $alpha;?>

              <tr>
                <td><?= $no++ ?></td>
                <td><?= $g->nama_karyawan ?></td>
                <td><?= $g->jenis_kelamin ?></td>
                <td><?= $g->nama_jabatan ?></td>
                <td>Rp. <?= number_format($g->gaji_pokok,0,',','.') ?></td>
                <td>Rp. <?= number_format($g->intensif,0,',','.') ?></td>
                <td>Rp. <?= number_format($g->bonus,0,',','.') ?></td>
                <td>Rp. <?= number_format($g->thr,0,',','.') ?></td>
                <td>Rp. <?= number_format($g->uang_transport,0,',','.') ?></td>
                <td>x <?= $g->hadir ?></td>
                <td>= Rp. <?= number_format($g->uang_transport * $g->hadir ,0,',','.')?></td>
                <td>Rp. <?= number_format($alpha,0,',','.') ?></td>
                <td>x <?= $g->alpha ?></td>
                <td>= <?= $potongan ?></td>
                <td>Rp. <?= number_format($g->gaji_pokok + $g->intensif + $g->bonus + $g->thr + $g->uang_transport * $g->hadir - $potongan,0,',','.') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- ?php } ?> -->

    </div>

<!--<?php if(empty($gaji)) : ?>
        <span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data masih kosong, silahkan isi data kehadiran pada bulan dan tahun yang Anda pilih!</span>
        <?php endif; ?> -->

      </div>
    </div>

    <!-- Content Row -->

  </div>
  <!-- /.container-fluid -->

<?php }else { ?>
  <span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data masih kosong, silahkan isi data kehadiran pada bulan dan tahun yang Anda pilih!</span>
<?php } ?>

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role=""><i class="fas fa-info"></i> Data gaji bulan <?= $bulan; ?> dan tahun <?= $tahun; ?> masih kosong. Silahkan input absensi terlebih dahulu pada bulan dan tahun yang anda pilih.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>