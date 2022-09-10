<?php

class Karyawan extends CI_Controller
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

		$data['title'] = "Data Karyawan";
		$data['karyawan'] = $this->sipModel->get_data('data_karyawan')->result();
		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/data_karyawan', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambah()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$data['title'] = "Tambah Data";
		$data['jabatan'] = $this->sipModel->get_data('data_jabatan')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/tambah_data_karyawan', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambahAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$username		= $this->input->post('username');
			$nama_karyawan	= $this->input->post('nama_karyawan');
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$jabatan		= $this->input->post('jabatan');
			$hak_akses		= $this->input->post('hak_akses');
			$password		= md5($this->input->post('password'));
			$foto			= $_FILES['foto']['name'];
			if ($foto = null) {
				$foto = ['foto' => 'default.jpg'];
			} else {
				$config['upload_path']	 = './assets/foto';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')) {
					echo "Foto Anda Gagal Terupload!";
				} else {
					$foto = $this->upload->data('file_name');
				}
			}

			$data = array(
				'username' => $username,
				'nama_karyawan' => $nama_karyawan,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' => $jabatan,
				'hak_akses' => $hak_akses,
				'password' => $password,
				'foto' => $foto
			);

			$this->sipModel->insert_data($data, 'data_karyawan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/karyawan');
		}
	}

	public function edit($id)
	{
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$where = array('id_karyawan' => $id);
		$data['jabatan'] = $this->sipModel->get_data('data_jabatan')->result();
		$data['karyawan'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id' ")->result();

		
		$data['title'] = "Edit Data";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/edit_data_karyawan', $data);
		$this->load->view('temp_admin/footer');
	}

	public function editAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->edit();
		} else {
			$id 			= $this->input->post('id_karyawan');
			$username 			= $this->input->post('username');
			$nama_karyawan	= $this->input->post('nama_karyawan');
			$jenis_kelamin		= $this->input->post('jenis_kelamin');
			$jabatan		= $this->input->post('jabatan');
			$hak_akses		= $this->input->post('hak_akses');
			$password		= md5($this->input->post('password'));
			$foto		= $_FILES['foto']['name'];
			if ($foto) {
				$config['upload_path']	 = './assets/foto';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$foto = $this->upload->data('file_name');
					$this->db->set('foto', $foto);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'username' => $username,
				'nama_karyawan' => $nama_karyawan,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' => $jabatan,
				'hak_akses' => $hak_akses,
			);

			$where = array('id_karyawan' => $id);

			$this->sipModel->update_data('data_karyawan', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/karyawan');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username','Username', 'required');
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan', 'required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin', 'required');
		$this->form_validation->set_rules('jabatan','Jabatan', 'required');
		// $this->form_validation->set_rules('foto','Foto', 'required');
	}

	public function hapus($id)
	{
		$where = array('id_karyawan' => $id);
		$this->sipModel->delete_data($where, 'data_karyawan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data Berhasil Dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/karyawan');
	}
}

?>