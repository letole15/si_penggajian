<?php

class Bonus extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('Bonus_M');

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
		$data['title'] = "Data Bonus Karyawan";

		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

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

		$data['bonus'] = $this->Bonus_M->tampil_bonus($bulantahun);

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar', $data);
		$this->load->view('admin/data_bonus', $data);
		$this->load->view('temp_admin/footer');
	}

	public function inputBonus()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		if($this->input->post('submit', TRUE) == 'submit') {
			$post = $this->input->post();
			//var_dump($post); die;
			$errors = [];
			$data = [];
			foreach ($post['bulan'] as $key => $value) {
				if ($post['bulan'][$key] != '' || $post['username'][$key] != '' ) {

					$data['data'][] = 
					[
						'bulan' => $post['bulan'][$key],
						'username' => $post['username'][$key],
						'nama_karyawan' => $post['nama_karyawan'][$key],
						'jenis_kelamin' => $post['jenis_kelamin'][$key],
						'nama_jabatan' => $post['nama_jabatan'][$key],
						'bonus' => $post['bonus'][$key],
						'thr' => $post['thr'][$key]

					];
				}
			}
			$this->Bonus_M->tambah_batch($data['data']);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/bonus');
		}

		$data['title'] = "Form Input Bonus";

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

		$data['input_bonus'] = $this->Bonus_M->tambah_bonus($bulantahun);

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/tambah_data_bonus', $data);
		$this->load->view('temp_admin/footer');
	}

	public function update()
	{
		$max = '9999999';
		$totalAbsen = $this->input->post('bonus') + $this->input->post('thr');
		if($totalAbsen <= $max) {
			$this->db->where('id_bonus', $this->input->post('id'));
			$this->db->update('data_bonus', [
				'bonus' => $this->input->post('bonus'),
				'thr' => $this->input->post('thr'),
			]);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		} else {
			// ERROR
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data Gagal Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect(base_url('/admin/bonus'));
	}

	public function _rules()
	{
		$this->form_validation->set_rules('bonus','bonus', 'required');
		$this->form_validation->set_rules('thr','thr', 'required');
	}

	public function hapus($id)
	{
		$where = array('id_bonus' => $id);
		$this->sipModel->delete_data($where, 'data_bonus');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data Berhasil Dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/bonus');
	}
}

?>