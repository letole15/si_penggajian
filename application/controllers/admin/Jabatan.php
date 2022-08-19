<?php

class Jabatan extends CI_Controller
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
	}
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$data['title'] = "Data Jabatan";
		$data['jabatan'] = $this->sipModel->get_data('data_jabatan')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/data_jabatan', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambah()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$data['title'] = "Tambah Data";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/tambah_data_jabatan', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambahAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$uang_makan		= $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'uang_makan' => $uang_makan,
			);

			$this->sipModel->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/jabatan');
		}
	}

	public function edit($id)
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		
		$where = array('id_jabatan' => $id);
		$data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan = '$id' ")->result();
		
		$data['title'] = "Edit Data";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/edit_data_jabatan',$where, $id, $data);
		$this->load->view('temp_admin/footer');
	}

	public function editAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->edit();
		} else {
			$id 			= $this->input->post('id_jabatan');
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$uang_makan		= $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'uang_makan' => $uang_makan,
			);

			$where = array('id_jabatan' => $id);

			$this->sipModel->update_data('data_jabatan', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/jabatan');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_jabatan','nama jabatan', 'required');
		$this->form_validation->set_rules('gaji_pokok','gaji pokok', 'required');
		$this->form_validation->set_rules('uang_makan','uang makan', 'required');
	}

	public function hapus($id)
	{
		$where = array('id_jabatan' => $id);
		$this->sipModel->delete_data($where, 'data_jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data Berhasil Dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/jabatan');
	}
}

?>