<?php

class Gaji extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('Gaji_M');

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
	}
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		
		$data['title'] = "Data Gaji Karyawan";

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulanTahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}

/*		if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$bulanTahun = $bulan.$tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}*/

		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();
		/*$data['gaji'] = $this->Gaji_M->tampil_gaji($bulanTahun);*/

		$data['gaji'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.intensif, data_jabatan.uang_transport, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_bonus.bonus, data_bonus.thr
			FROM data_karyawan
			INNER JOIN data_kehadiran 
			ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan
			ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			INNER JOIN data_bonus
			ON data_bonus.nama_jabatan = data_karyawan.jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/data_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function cetakGaji()
	{
		$data['title'] = "Cetak Data Gaji Karyawan";

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!=''))
		{
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulanTahun = $bulan.$tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}

		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();
		$data['cetakGaji'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_kehadiran.alpha, data_kehadiran.hadir
			FROM data_karyawan
			INNER JOIN data_kehadiran 
			ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan
			ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_lap_gaji', $data);
	}
}

?>