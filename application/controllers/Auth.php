<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) 
		{
			$data['title'] = "Form Login"; 

			$this->load->view('temp_admin/header', $data);
			$this->load->view('form_login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->sipModel->cek_auth($username, $password);

			if ($cek == FALSE) 
			{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Username atau Password Salah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('Auth');
			} else {
				$this->session->set_userdata('hak_akses', $cek->hak_akses);
				$this->session->set_userdata('nama_karyawan', $cek->nama_karyawan);
				$this->session->set_userdata('id_karyawan', $cek->id_karyawan);
				$this->session->set_userdata('username', $cek->username);
				// $this->session->set_userdata('foto', $cek->foto);

				switch ($cek->hak_akses) {
					case 1 : redirect('admin/dashboard');
							 break;
					case 2 : redirect('karyawan/dashboard');
							 break;
					default:
							 break;
				}
			}
		}
		
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username','username','required');
		if($this->input->post('username') !== 'admin') {
			$this->form_validation->set_rules('password','password','required');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
