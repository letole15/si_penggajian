<?php

	class GantiPassword extends CI_Controller
	{
		
		public function index()
		{
			$data['title'] = "Ganti Password";

			$this->load->view('temp_karyawan/header', $data);
			$this->load->view('temp_karyawan/sidebar');
			$this->load->view('form_ganti_pass', $data);
			$this->load->view('temp_karyawan/footer');
		}

		public function GantiPassAksi()
		{
			$passBaru = $this->input->post('passBaru');
			$ulangPassBaru = $this->input->post('ulangPassBaru');

			$this->form_validation->set_rules('passBaru','password baru','required|matches[ulangPassBaru]');
			$this->form_validation->set_rules('ulangPassBaru','ulangi password baru','required|matches[passBaru]');

			if ($this->form_validation->run() != FALSE)
			{
				$data = array('password' => md5($passBaru) );

				$id = array('id_karyawan' => $this->session->userdata('id_karyawan'));

				$this->sipModel->update_data('data_karyawan', $data, $id);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Password Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('Auth');
			} else {
				$data['title'] = "Ganti Password";

				$this->load->view('temp_karyawan/header', $data);
				$this->load->view('temp_karyawan/sidebar');
				$this->load->view('form_ganti_pass', $data);
				$this->load->view('temp_karyawan/footer');
			}
			
		}
	}

?>