<?php

class SlipGaji extends CI_Controller
{
/*	public function __construct() 
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

		/*$this->load->model('Gaji_M');
	}*/
	
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		
		$data['title'] = "Filter Slip Gaji Karyawan";
		/*$data['karyawan'] = $this->db->get('data_karyawan')->result_array();*/
		$data['karyawan'] = $this->sipModel->get_data('data_karyawan')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/slip_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function cetakSlipGaji()
	{
		$data['title'] = "Cetak Slip Gaji";
		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();

		$nama = $this->input->post('nama_karyawan');

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulanTahun = $bulan.$tahun;

		/*$data['print_slip'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.intensif, data_jabatan.uang_transport, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.alpha, data_bonus.bonus, data_bonus.thr
			FROM data_karyawan
			INNER JOIN data_kehadiran ON data_kehadiran.username = data_karyawan.username  
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan  
			INNER JOIN data_bonus ON data_bonus.nama_jabatan = data_karyawan.jabatan  
			WHERE data_kehadiran.bulan = '$bulanTahun' AND data_kehadiran.nama_karyawan = '$nama'")->result();*/
		/*var_dump($data);
		die();*/

    $data['print_slip'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.intensif, data_jabatan.uang_transport, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.alpha, data_bonus.bonus, data_bonus.thr
            FROM data_karyawan
            INNER JOIN data_kehadiran ON data_kehadiran.username = data_karyawan.username  
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan  
            INNER JOIN data_bonus ON data_bonus.nama_jabatan = data_karyawan.jabatan  
            WHERE data_kehadiran.nama_karyawan = '$nama' and data_bonus.bulan='$bulanTahun' and data_kehadiran.bulan='$bulanTahun'")->result();
    /*var_dump($data);
		die();*/
		
		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_slip_gaji', $data);
	}

	/*public function cetakSlipGaji()
	{
		$this->form_validation->set_rules('nama_karyawan', 'Nama_Karyawan', 'required|trim');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
		$this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
		if($this->form_validation->run() == FALSE) 
		{
			return $this->index();
		} else {
			$data['title'] = "Cetak Slip Gaji";
			$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();
			$nama = $this->input->post('nama_karyawan');

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
			$bulanTahun = $bulan.$tahun;

			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$bulanTahun = $bulan.$tahun;

			$slip['print_slip'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.alpha
				FROM data_karyawan
				INNER JOIN data_kehadiran ON data_kehadiran.username = data_karyawan.username  
				INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan  
				WHERE data_kehadiran.bulan = '$bulanTahun' AND data_kehadiran.nama_karyawan = '$nama'")->result();
		var_dump($slip);
		die();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_slip_gaji', $data);
		}
		
	}*/

	/*public function cetakSlipGaji()
	{
		$this->form_validation->set_rules('karyawan', 'Karyawan', 'required|trim');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
		$this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
		if($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} else {
			$data['title'] = 'Filter Slip Gaji Karyawan';
			if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) 
			{
				$bulan = $_POST['bulan'];
				$tahun = $_POST['tahun'];
				$bulanTahun = $bulan.$tahun;
			} else {
				$bulan = date('m');
				$tahun = date('Y');
				$bulanTahun = $bulan.$tahun;
			}
			$karyawan = $this->input->post('data_karyawan');
			$data['slip'] = $this->Gaji_M->tampil_print_slip($bulanTahun, $karyawan);
			// var_dump($data['slip']); die;
			$data['potongan'] = $this->db->get('data_potongan_gaji')->result_array();
			$this->load->view('temp_admin/header', $data);
			$this->load->view('admin/cetak_slip_gaji', $data);
		}
		
	}

	/*public function cetakSlipGaji()
	{
		$data['title'] = "Cetak Slip Gaji";
		$data['potongan'] = $this->sipModel->get_data('data_potongan_gaji')->result();
		$nama = $this->input->post('nama_karyawan');
		
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

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulantahun = $bulan.$tahun;

		$data['print_slip'] = $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur
			FROM data_karyawan
			INNER JOIN data_kehadiran ON data_kehadiran.username = data_karyawan.username  
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan  
			WHERE data_kehadiran.bulan = '$bulantahun' AND data_kehadiran.nama_karyawan = '$nama'")->result();
		/*var_dump($slip);
		die();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('admin/cetak_slip_gaji', $data);
	}*/

}
?>