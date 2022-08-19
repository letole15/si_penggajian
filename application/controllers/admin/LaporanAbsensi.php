<?php

class LaporanAbsensi extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') !='1') 
		{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda belum login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('Auth');
		}

		$this->load->model('Absensi_M');
	}
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		
		$data['title'] = "Filter Laporan Absensi";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/lap_absensi', $data);
		$this->load->view('temp_admin/footer');
	}


	public function cetakLaporanAbsensi()
	{
		$data['title'] = 'Cetak Absensi Pegawai';
		if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
	        $bulan = $this->input->post('bulan');
	        $tahun = $this->input->post('tahun');
		    $bulanTahun = $bulan.$tahun;
	    } else {
	        $bulan = date('m');
	        $tahun = date('Y');
	        $bulanTahun = $bulan.$tahun;
	    }
	    $data['lap_kehadiran'] = $this->Absensi_M->tampil_absensi($bulanTahun);
		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_lap_absensi', $data);
	}

/*	Public function cetakLaporanAbsensi()
	{
		$data['title'] = "Cetak Laporan Absensi";
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
		$bulantahun = $bulan.$tahun;
		$data['lap_kehadiran'] = $this->db->query("SELECT * FROM data_kehadiran 
			WHERE bulan = '$bulantahun'
			ORDER BY nama_karyawan ASC")->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_lap_absensi');
	}*/

}
?>