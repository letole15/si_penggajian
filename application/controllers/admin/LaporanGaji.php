<?php

class LaporanGaji extends CI_Controller
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

		$this->load->model('Gaji_M');
	}
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$data['title'] = "Filter Laporan Gaji Karyawan";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar', $data);
		$this->load->view('admin/lap_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function cetakLaporanGaji()
	{
		$data['title'] = 'Cetak Data Gaji Karyawan';

		if((isset($_GET['bulan']) && $_GET['bulan'] != null) && (isset($_GET['tahun']) && $_GET['tahun'] != null)) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulanTahun = $bulan.$tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}
		$data['potongan'] = $this->db->get('data_potongan_gaji')->result_array();
		/*$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();*/
		$data['cetakGaji'] = $this->Gaji_M->tampil_lap_gaji($bulanTahun);
		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_lap_gaji', $data);
	}
}

?>