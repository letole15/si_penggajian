	<div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
		</div>

		<?= $this->session->flashdata('pesan') ?>

		<!-- <a class="btn btn-sm btn-success mb-2 mt-2" href="<?= base_url('admin/PotonganGaji/tambah') ?>"><i class="fas fa-plus"></i>Tambah Data</a> -->

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
                      <th>Jenis Potongan</th>
                      <th>Jumlah Potongan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Jenis Potongan</th>
                      <th>Jumlah Potongan</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>

                  <tbody>
                  	<?php $no=1; foreach ($pot_gaji as $p) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $p->potongan ?></td>
                      <td>Rp. <?= number_format($p->jml_potongan,0,',','.') ?></td>
                      <td>
                      	<center>
                      		<a class="btn btn-sm btn-primary" href="<?= base_url('admin/PotonganGaji/edit/'.$p->id_potongan) ?>"><i class="fas fa-edit"></i></a>
                      		<!-- <a onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/PotonganGaji/hapus/'.$p->id_potongan) ?>"><i class="fas fa-trash"></i></a> -->
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