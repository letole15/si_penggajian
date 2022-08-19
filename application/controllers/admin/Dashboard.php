<?php 

class Dashboard extends CI_Controller
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
		$data['title'] = "Dashboard";

		$karyawan = $this->db->query("SELECT * FROM data_karyawan");
		$jabatan = $this->db->query("SELECT * FROM data_jabatan");
		$admin = $this->db->query("SELECT * FROM data_karyawan WHERE hak_akses = '1'");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");

		$data['karyawan'] = $karyawan->num_rows();
		$data['jabatan'] = $jabatan->num_rows();
		$data['admin'] = $admin->num_rows();
		$data['kehadiran'] = $kehadiran->num_rows();

		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		$this->sipModel->get_data('data_karyawan')->result();

		$this->load->view('temp_admin/header', $data);
		$this->load->view('temp_admin/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('temp_admin/footer');
	}

	public function profil()
	{
		$data['title'] = 'Data Saya';
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
		$this->load->view('admin/profil', $data);
	}

	/*public function profil()
	{
		$this->load->model('sipModel');
		$data['title'] = 'Data Saya';
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->sipModel->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('admin/profil', $data);
	}*/
}

?>