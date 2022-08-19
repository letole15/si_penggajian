	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<a class="btn btn-sm btn-success mb-3" href="<?= base_url('admin/jabatan/tambah') ?>"><i class="fas fa-plus"></i>Tambah Data</a>

    <?= $this->session->flashdata('pesan') ?>

		<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>Uang Makan</th>
                      <th>Total</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>Uang Makan</th>
                      <th>Total</th>
                      <th>Opsi</th>
                    </tr>
                  </tfoot>

                  <tbody>
                  	<?php $no=1; foreach ($jabatan as $j) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $j->nama_jabatan ?></td>
                      <td>Rp. <?= number_format($j->gaji_pokok, 0,',','.') ?></td>
                      <td>Rp. <?= number_format($j->uang_makan, 0,',','.') ?></td>
                      <td>Rp. <?= number_format($j->gaji_pokok + $j->uang_makan, 0,',','.') ?></td>
                      <td>
                      	<center>
                      		<a class="btn btn-sm btn-primary" href="<?= base_url('admin/jabatan/edit/'.$j->id_jabatan) ?>"><i class="fas fa-edit"></i></a>
                      		<a onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/jabatan/hapus/'.$j->id_jabatan) ?>"><i class="fas fa-trash"></i></a>
                      	</center>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


	</div>

</div>