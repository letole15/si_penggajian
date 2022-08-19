<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-fw fa-money-check-alt"></i>
				</div>
				<div class="sidebar-brand-text mx-3">SIP</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('admin/dashboard')?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Master Data
				</div>

				<!-- Master Data -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="<?= base_url('admin/dashboard')?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-users"></i>
						<span>User</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?= base_url('admin/karyawan')?>">Data Karyawan</a>
							<a class="collapse-item" href="<?= base_url('admin/jabatan')?>">Data Jabatan</a>
						</div>
					</div>
				</li>

				<!-- Transaction -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-comments-dollar"></i>
						<span>Transaksi</span>
					</a>
					<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?= base_url('admin/absensi')?>">Data Absensi</a>
							<a class="collapse-item" href="<?= base_url('admin/bonus')?>">Data Bonus</a>
							<a class="collapse-item" href="<?= base_url('admin/gaji')?>">Data Gaji</a>
							<a class="collapse-item" href="<?= base_url('admin/potonganGaji')?>">Data Potongan Gaji</a>
						</div>
					</div>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Laporan
				</div>

				<!-- Report -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
						<i class="fas fa-fw fa-print"></i>
						<span>Laporan</span>
					</a>
					<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?= base_url('admin/laporanAbsensi')?>">Laporan Absensi</a>
							<a class="collapse-item" href="<?= base_url('admin/laporanGaji')?>">Laporan Gaji</a>
							<a class="collapse-item" href="<?= base_url('admin/slipGaji')?>">Slip Gaji</a>
						</div>
					</div>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">

				<!-- Change Password -->
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('gantiPassword') ?>">
						<i class="fas fa-fw fa-key"></i>
						<span>Ubah Password</span></a>
					</li>

					<!-- Logout -->
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('auth/logout') ?>">
							<i class="fas fa-fw fa-sign-out-alt"></i>
							<span>Logout</span></a>
						</li>

						<!-- Divider -->
						<hr class="sidebar-divider d-none d-md-block">

						<!-- Sidebar Toggler (Sidebar) -->
						<div class="text-center d-none d-md-inline">
							<button class="rounded-circle border-0" id="sidebarToggle"></button>
						</div>

					</ul>
					<!-- End of Sidebar -->

					<!-- Content Wrapper -->
					<div id="content-wrapper" class="d-flex flex-column">

						<!-- Main Content -->
						<div id="content">

							<!-- Topbar -->
							<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

								<!-- Sidebar Toggle (Topbar) -->
								<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
									<i class="fa fa-bars"></i>
								</button>

								<!-- Company Name -->
								<h3 class="fas fa-fw fa-building"></h3>
								<h3 class="font-weight-bold">PELANGI FRAME</h3>
								

								<!-- Topbar Navbar -->
								<ul class="navbar-nav ml-auto">

									<div class="topbar-divider d-none d-sm-block"></div>

									<!-- Nav Item - User Information -->
									<li class="nav-item dropdown no-arrow">
										<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang <?= $this->session->userdata('nama_karyawan') ?></span>

											<!-- <img class="img-profile rounded-circle" src="<?= base_url('assets/foto/').$this->session->userdata('foto') ?>"> -->

											<?php foreach($profil as $k) { ?>
												<img class="img-profile rounded-circle" src="<?= base_url('assets/foto/'.$k->foto) ?>">
											<?php } ?>

										</a>
										<!-- Dropdown - User Information -->
										<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
											<a class="dropdown-item" href="<?= base_url('admin/dashboard/profil') ?>">
												<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
												Profil
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
												<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
												Logout
											</a>
										</div>
									</li>

								</ul>

							</nav>
							<!-- End of Topbar -->