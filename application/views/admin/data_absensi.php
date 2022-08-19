    <div class="container-fluid">

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
     </div>

     <?= $this->session->flashdata('pesan') ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-3 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Filter Data Kehadiran Karyawan</h6>
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
              /*for($i=2010; $i<$tahun+1; $i++)*/
              for($i=2020; $i<$tahun + 5; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php  } ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary mb-3 ml-auto"><i class="fas fa-eye"></i> Tampilkan</button>
          <a href="<?= base_url('admin/absensi/inputAbsensi') ?>" class="btn btn-success mb-3 ml-3"><i class="fas fa-plus"></i> Input Kehadiran</a>
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
        <form method="POST" action="<?= base_url('/admin/absensi/update') ?>" class="form-edit"></form>
        <div class="form-groups"></div>
        <div class="alert alert-info">
          Menampilkan Data Kehadiran Karyawan Bulan: <?= $bulan ?> <span class="font-weight-bold"></span> Tahun: <?= $tahun ?> <span class="font-weight-bold"></span>
        </div>

        <?php

        $jml_data = count(array($absensi));
        if ($jml_data > 0) { ?>

        <div class="table-responsive">
          <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Hadir</th>
                <th>Libur</th>
                <th>Alpha</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Hadir</th>
                <th>Libur</th>
                <th>Alpha</th>
                <th>Aksi</th>
              </tr>
            </tfoot>

            <tbody>
             <?php $no=1; foreach ($absensi as $a) : ?>
                <input type="hidden" name="id" class="id-hidden-<?= $a['id_kehadiran'] ?>" value="<?= $a['id_kehadiran'] ?>">
                  <td><?= $no++ ?></td>
                  <td><?= $a['username'] ?></td>
                  <td><?= $a['nama_karyawan'] ?></td>
                  <td><?= $a['jenis_kelamin'] ?></td>
                  <td><?= $a['jabatan'] ?></td>
                  <td>
                    <span class="v-hadir-<?= $a['id_kehadiran'] ?>"><?= $a['hadir'] ?></span>
                    <input type="number" value="<?= $a['hadir'] ?>" name="hadir" class="form-control input-max hadir-<?= $a['id_kehadiran'] ?>">  
                  </td>
                  <td>
                    <span class="v-libur-<?= $a['id_kehadiran'] ?>">
                      <?= $a['libur'] ?>
                    </span>
                    <input type="number" value="<?= $a['libur'] ?>" name="libur" class="form-control input-max libur-<?= $a['id_kehadiran'] ?>">  
                    
                  </td>
                  <td>
                    <span class="v-alpha-<?= $a['id_kehadiran'] ?>"><?= $a['alpha'] ?></span>
                    <input type="number" value="<?= $a['alpha'] ?>" name="alpha" class="form-control input-max alpha-<?= $a['id_kehadiran'] ?>">  
                    
                  </td>
                  <td>
                  <center>
                    <div class="section-edit-hide-<?= $a['id_kehadiran'] ?>">
                      <a class="btn btn-sm btn-primary btn-edit-<?= $a['id_kehadiran'] ?>"><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/absensi/hapus/'.$a['id_kehadiran']) ?>"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="section-edit-show-<?= $a['id_kehadiran'] ?>" style="display: none;">
                      <button class="btn btn-sm btn-primary btn-submit-<?= $a['id_kehadiran'] ?>" onclick="$('.form-<?= $a['id_kehadiran'] ?>').submit()" type="submit" name="submit" value="submit">Submit</button>

                      <a class="btn btn-sm btn-primary btn-edit-show-<?= $a['id_kehadiran'] ?>">Cancel</a>
                    </div>
                  </center>
                  </td>
                </td>
              </tr>
              <script type="text/javascript">
                $(document).ready(function() {
                  hideInput<?= $a['id_kehadiran'] ?>()
                });
                function hideText<?= $a['id_kehadiran'] ?>() {
                  $('.v-hadir-<?= $a['id_kehadiran'] ?>').hide();
                  $('.v-libur-<?= $a['id_kehadiran'] ?>').hide();
                  $('.v-alpha-<?= $a['id_kehadiran'] ?>').hide();
                }
                function showText<?= $a['id_kehadiran'] ?>() {
                  $('.v-hadir-<?= $a['id_kehadiran'] ?>').show();
                  $('.v-libur-<?= $a['id_kehadiran'] ?>').show();
                  $('.v-alpha-<?= $a['id_kehadiran'] ?>').show();
                }
                function hideInput<?= $a['id_kehadiran'] ?>() {
                  $('.hadir-<?= $a['id_kehadiran'] ?>').hide();
                  $('.libur-<?= $a['id_kehadiran'] ?>').hide();
                  $('.alpha-<?= $a['id_kehadiran'] ?>').hide();
                }
                function showInput<?= $a['id_kehadiran'] ?>() {
                  $('.hadir-<?= $a['id_kehadiran'] ?>').show();
                  $('.libur-<?= $a['id_kehadiran'] ?>').show();
                  $('.alpha-<?= $a['id_kehadiran'] ?>').show();
                }
                $('.btn-edit-<?= $a['id_kehadiran'] ?>').click(function() {
                  hideText<?= $a['id_kehadiran'] ?>();
                  showInput<?= $a['id_kehadiran'] ?>();
                  $('.section-edit-hide-<?= $a['id_kehadiran'] ?>').hide();
                  $('.section-edit-show-<?= $a['id_kehadiran'] ?>').show();
                });
                $('.btn-edit-show-<?= $a['id_kehadiran'] ?>').click(function() {
                  $('.section-edit-show-<?= $a['id_kehadiran'] ?>').hide();
                  $('.section-edit-hide-<?= $a['id_kehadiran'] ?>').show();
                  hideInput<?= $a['id_kehadiran'] ?>()
                  showText<?= $a['id_kehadiran'] ?>()
                })
                $('.btn-submit-<?= $a['id_kehadiran'] ?>').click(function(){
                  var newForm = jQuery('<form>', {
                      'action': '<?= base_url('/admin/absensi/update') ?>',
                      'method': 'post',
                      'style': 'display: none;'
                  });
                  newForm.append($('.hadir-<?= $a['id_kehadiran'] ?>'));
                  newForm.append($('.libur-<?= $a['id_kehadiran'] ?>'));
                  newForm.append($('.alpha-<?= $a['id_kehadiran'] ?>'));
                  newForm.append(jQuery('<input>', {
                      'name': 'id',
                      'value': '<?= $a['id_kehadiran'] ?>',
                      'type': 'hidden'
                  }));
                  $('.form-groups').append(newForm);
                  // console.log(newForm.html());
                  // return false;
                  newForm.submit();
                });
              </script>
          <?php endforeach; ?>
        </tbody>
      </table>

                <?php if(empty($absensi)) : ?>
            <div class="alert alert-danger text-center" role="alert">Data masih kosong, silahkan isi data pada bulan dan tahun yang Anda pilih!</div>
          <?php endif; ?>

<!--     <?php } else { ?>
      <span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data masih kosong, silahkan isi data pada bulan dan tahun yang Anda pilih!</span>
    <?php } ?> -->

    </div>
  </div>
</div>


</div>

</div>