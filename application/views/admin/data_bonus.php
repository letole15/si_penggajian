    <div class="container-fluid">

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
     </div>

     <?= $this->session->flashdata('pesan') ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
      <div class="card-header py-3 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Filter Data Kebonusan Karyawan</h6>
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
          <a href="<?= base_url('admin/bonus/inputBonus') ?>" class="btn btn-success mb-3 ml-3"><i class="fas fa-plus"></i> Input Kebonusan</a>
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
        <form method="POST" action="<?= base_url('/admin/bonus/update') ?>" class="form-edit"></form>
        <div class="form-groups"></div>
        <div class="alert alert-info">
          Menampilkan Data Kebonusan Karyawan Bulan: <?= $bulan ?> <span class="font-weight-bold"></span> Tahun: <?= $tahun ?> <span class="font-weight-bold"></span>
        </div>

        <?php

        $jml_data = count(array($bonus));
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
                <th width="15%">Bonus</th>
                <th width="15%">THR</th>
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
                <th width="15%">Bonus</th>
                <th width="15%">THR</th>
                <th>Aksi</th>
              </tr>
            </tfoot>

            <tbody>
             <?php $no=1; foreach ($bonus as $b) : ?>
                <input type="hidden" name="id" class="id-hidden-<?= $b['id_bonus'] ?>" value="<?= $b['id_bonus'] ?>">
                  <td><?= $no++ ?></td>
                  <td><?= $b['username'] ?></td>
                  <td><?= $b['nama_karyawan'] ?></td>
                  <td><?= $b['jenis_kelamin'] ?></td>
                  <td><?= $b['jabatan'] ?></td>
                  <td>
                    <span class="v-bonus-<?= $b['id_bonus'] ?>"><?= $b['bonus'] ?></span>
                    <input type="number" value="<?= $b['bonus'] ?>" name="bonus" class="form-control bonus-<?= $b['id_bonus'] ?>">  
                  </td>
                  <td>
                    <span class="v-thr-<?= $b['id_bonus'] ?>">
                      <?= $b['thr'] ?>
                    </span>
                    <input type="number" value="<?= $b['thr'] ?>" name="thr" class="form-control thr-<?= $b['id_bonus'] ?>">  
                    
                  </td>
                  <td>
                  <center>
                    <div class="section-edit-hide-<?= $b['id_bonus'] ?>">
                      <a class="btn btn-sm btn-primary btn-edit-<?= $b['id_bonus'] ?>"><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/bonus/hapus/'.$b['id_bonus']) ?>"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="section-edit-show-<?= $b['id_bonus'] ?>" style="display: none;">
                      <button class="btn btn-sm btn-primary btn-submit-<?= $b['id_bonus'] ?>" onclick="$('.form-<?= $b['id_bonus'] ?>').submit()" type="submit" name="submit" value="submit">Submit</button>

                      <a class="btn btn-sm btn-primary btn-edit-show-<?= $b['id_bonus'] ?>">Cancel</a>
                    </div>
                  </center>
                  </td>
                </td>
              </tr>
              <script type="text/javascript">
                $(document).ready(function() {
                  hideInput<?= $b['id_bonus'] ?>()
                });
                function hideText<?= $b['id_bonus'] ?>() {
                  $('.v-bonus-<?= $b['id_bonus'] ?>').hide();
                  $('.v-thr-<?= $b['id_bonus'] ?>').hide();
                }
                function showText<?= $b['id_bonus'] ?>() {
                  $('.v-bonus-<?= $b['id_bonus'] ?>').show();
                  $('.v-thr-<?= $b['id_bonus'] ?>').show();
                }
                function hideInput<?= $b['id_bonus'] ?>() {
                  $('.bonus-<?= $b['id_bonus'] ?>').hide();
                  $('.thr-<?= $b['id_bonus'] ?>').hide();
                }
                function showInput<?= $b['id_bonus'] ?>() {
                  $('.bonus-<?= $b['id_bonus'] ?>').show();
                  $('.thr-<?= $b['id_bonus'] ?>').show();
                }
                $('.btn-edit-<?= $b['id_bonus'] ?>').click(function() {
                  hideText<?= $b['id_bonus'] ?>();
                  showInput<?= $b['id_bonus'] ?>();
                  $('.section-edit-hide-<?= $b['id_bonus'] ?>').hide();
                  $('.section-edit-show-<?= $b['id_bonus'] ?>').show();
                });
                $('.btn-edit-show-<?= $b['id_bonus'] ?>').click(function() {
                  $('.section-edit-show-<?= $b['id_bonus'] ?>').hide();
                  $('.section-edit-hide-<?= $b['id_bonus'] ?>').show();
                  hideInput<?= $b['id_bonus'] ?>()
                  showText<?= $b['id_bonus'] ?>()
                })
                $('.btn-submit-<?= $b['id_bonus'] ?>').click(function(){
                  var newForm = jQuery('<form>', {
                      'action': '<?= base_url('/admin/bonus/update') ?>',
                      'method': 'post',
                      'style': 'display: none;'
                  });
                  newForm.append($('.bonus-<?= $b['id_bonus'] ?>'));
                  newForm.append($('.thr-<?= $b['id_bonus'] ?>'));
                  newForm.append(jQuery('<input>', {
                      'name': 'id',
                      'value': '<?= $b['id_bonus'] ?>',
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

                <?php if(empty($bonus)) : ?>
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