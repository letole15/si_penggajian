<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Absensi_model');
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$data['title'] = 'Absensi Pegawai';
		if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$bulanTahun = $bulan.$tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}

		$data['absensi'] = $this->Absensi_model->joinPegawaiJabatan($bulanTahun);
		// var_dump($data['absensi']); die;
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('admin/absensi/index', $data);
		$this->load->view('themeplates/footer');
	}

	public function input_absensi()
	{
		$data['title'] = 'Input Absensi';
		if((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$bulanTahun = $bulan.$tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulanTahun = $bulan.$tahun;
		}

		$data['inputAbsensi'] = $this->Absensi_model->InputjoinPegawaiJabatan($bulanTahun);
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('admin/absensi/input_absensi', $data);
		$this->load->view('themeplates/footer');
	}

	public function aksi_input_kehadiran()
	{
		$post = $this->input->post();
		// var_dump($post); die;
		foreach($post['bulan'] as $key => $value) {
			if($post['bulan'][$key] != null || $post['nik'][$key] != null) {
				$data[] =
					[
						'bulan' => $post['bulan'][$key],
						'nik' => $post['nik'][$key],
						'id_pegawai' => $post['id_pegawai'][$key],
						'jk_kehadiran' => $post['jk_pegawai'][$key],
						'id_jabatan' => $post['id_jabatan'][$key],
						'hadir' => $post['hadir'][$key],
						'sakit' => $post['sakit'][$key],
						'alpa' => $post['alpa'][$key]
					];
			}
		}
		$this->Absensi_model->tambah_batch($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Kehadiran <strong>Berhasil Ditambahkan.</strong></div>');
		redirect('admin/absensi');
	}

	public function laporan_absensi()
	{
		$data['title'] = 'Laporan Absensi Pegawai';
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('admin/absensi/laporan_absensi', $data);
		$this->load->view('themeplates/footer');
	}

	public function cetaklaporanabsensi()
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
	    $data['absensi'] = $this->Absensi_model->joinPegawaiJabatan($bulanTahun);
	    $this->load->view('themeplates/header', $data);
		$this->load->view('admin/cetak/cetak_absensi', $data);
	}


	


}