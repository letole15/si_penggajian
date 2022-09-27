<?php 

class DataGaji extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') !='2') 
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

		$data['title'] = "Data Gaji";
		$username = $this->session->userdata('username');
		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulanTahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}

		$data['gaji'] = $this->db->query("SELECT data_karyawan.nama_karyawan, data_karyawan.username, data_jabatan.gaji_pokok, data_jabatan.intensif, data_jabatan.uang_transport, data_bonus.bonus, data_bonus.thr, data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran
			FROM data_karyawan
			INNER JOIN data_kehadiran 
				ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan 
			ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			INNER JOIN data_bonus
				ON data_bonus.username = data_karyawan.username AND data_bonus.bulan='".$bulanTahun."'
			WHERE data_kehadiran.username = '$username'
			ORDER BY data_kehadiran.bulan DESC")->result();

		$this->load->view('temp_karyawan/header', $data);
		$this->load->view('temp_karyawan/sidebar');
		$this->load->view('karyawan/data_gaji', $data);
		$this->load->view('temp_karyawan/footer');
	}

	public function cetakSlip($id)
	{
		$data['title'] = "Cetak Slip Gaji";

		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();
		
		$nama = $this->input->post('nama_karyawan');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulanTahun = $bulan.$tahun;

		$data['print_slip'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_jabatan.intensif, data_bonus.bonus, data_bonus.thr, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.bulan
			FROM data_karyawan
			INNER JOIN data_kehadiran ON data_kehadiran.username = data_karyawan.username  
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan  
			INNER JOIN data_bonus
				ON data_bonus.username = data_karyawan.username 
			WHERE data_kehadiran.id_kehadiran = '$id'")->result();

		$this->load->view('temp_karyawan/header', $data);
		$this->load->view('karyawan/cetak_slip', $data);
	}
}

?>