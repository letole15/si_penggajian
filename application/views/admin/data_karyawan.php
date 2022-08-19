	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<a class="btn btn-sm btn-success mb-3" href="<?= base_url('admin/karyawan/tambah') ?>"><i class="fas fa-plus"></i>Tambah Data</a>

    <?= $this->session->flashdata('pesan') ?>

		<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Nama Karyawan</th>
                      <th>Jenis Kelamin</th>
                      <th>Jabatan</th>
                      <th>Foto</th>
                      <th>Hak Akses</th>
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
                      <th>Foto</th>
                      <th>Hak Akses</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>

                  <tbody>
                  	<?php $no=1; foreach ($karyawan as $k) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $k->username ?></td>
                      <td><?= $k->nama_karyawan ?></td>
                      <td><?= $k->jenis_kelamin ?></td>
                      <td><?= $k->jabatan ?></td>
                      <td><img src="<?= base_url('/assets/foto/').$k->foto ?>" width="75px"></td>
                      <td>
                        <?php if($k->hak_akses == '1') { ?>
                          Admin
                        <?php } else { ?>
                          Karyawan  
                        <?php } ?>
                      </td>
                      <td>
                      	<center>
                      		<a class="btn btn-sm btn-primary" href="<?= base_url('admin/karyawan/edit/'.$k->id_karyawan) ?>"><i class="fas fa-edit"></i></a>
                      		<a onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/karyawan/hapus/'.$k->id_karyawan) ?>"><i class="fas fa-trash"></i></a>
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