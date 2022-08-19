<?php

class PotonganGaji extends CI_Controller
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

		$data['title'] = "Data Potongan Gaji";
		$data['pot_gaji'] = $this->sipModel->get_data('data_potongan_gaji')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/data_pot_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambah()
	{
		$data['title'] = "Tambah Data Potongan Gaji";
		$data['pot_gaji'] = $this->sipModel->get_data('data_potongan_gaji')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/tambah_data_pot_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function tambahAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$potongan	= $this->input->post('potongan');
			$jml_potongan		= $this->input->post('jml_potongan');

			$data = array(
				'potongan' => $potongan,
				'jml_potongan' => $jml_potongan
			);

			$this->sipModel->insert_data($data, 'data_potongan_gaji');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/PotonganGaji');
		}
	}

	public function edit($id)
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$where = array('id_potongan' => $id);
		$data['pot_gaji'] = $this->db->query("SELECT * FROM data_potongan_gaji WHERE id_potongan = '$id' ")->result();
		
		$data['title'] = "Edit Data";

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar');
		$this->load->view('admin/edit_data_pot_gaji', $data);
		$this->load->view('temp_admin/footer');
	}

	public function editAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->edit();
		} else {
			$id 			= $this->input->post('id_potongan');
			$potongan	= $this->input->post('potongan');
			$jml_potongan		= $this->input->post('jml_potongan');

			$data = array(
				'potongan' => $potongan,
				'jml_potongan' => $jml_potongan,
			);

			$where = array('id_potongan' => $id);

			$this->sipModel->update_data('data_potongan_gaji', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/PotonganGaji');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('potongan','potongan', 'required');
		$this->form_validation->set_rules('jml_potongan','jml potongan', 'required');
	}

	public function hapus($id)
	{
		$where = array('id_potongan' => $id);
		$this->sipModel->delete_data($where, 'data_potongan_gaji');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data Berhasil Dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/PotonganGaji');
	}
}

?>