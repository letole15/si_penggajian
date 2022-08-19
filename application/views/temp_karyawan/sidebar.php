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
				<a class="nav-link" href="<?= base_url('karyawan/Dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
				</li>

				<li class="nav-item">
				<a class="nav-link" href="<?= base_url('karyawan/DataGaji') ?>">
					<i class="fas fa-fw fa-money-check-alt"></i>
					<span>Data Gaji</span></a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">

				<!-- Change Password -->
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('karyawan/gantiPassword') ?>">
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
											<a class="dropdown-item" href="#">
												<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
												Profile
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