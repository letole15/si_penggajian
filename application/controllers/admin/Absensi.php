<?php

class Absensi extends CI_Controller
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
		$this->load->helper('url');
		$this->load->model('Absensi_M');
	}
	
	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
		$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();

		$data['title'] = "Data Kehadiran Karyawan";
		// $data['absensi'] = $this->sipModel->get_data('data_kehadiran')->result();

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

		$data['absensi'] = $this->Absensi_M->tampil_absensi($bulantahun);

		/*$data['absensi'] = $this->db->query("SELECT data_kehadiran.*, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_karyawan.jabatan
			FROM data_kehadiran
			INNER JOIN data_karyawan ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan ON data_karyawan.jabatan = data_jabatan.nama_jabatan
			WHERE data_kehadiran.bulan = '$bulantahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result();*/

			$this->load->view('temp_admin/header', $data);
			$this->load->view('temp_admin/sidebar');
			$this->load->view('admin/data_absensi', $data);
			$this->load->view('temp_admin/footer');
		}

		public function inputAbsensi()
		{
			$id = $this->session->userdata('id_karyawan');
			$data['profil'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan = '$id'")->result();
			
			
			if($this->input->post('submit', TRUE) == 'submit') {
				$post = $this->input->post();
				//var_dump($post); die;
				$errors = [];
				$data = [];
				foreach ($post['bulan'] as $key => $value) {
					$maxDate = date('t');
					$totalAbsen = $post['hadir'][$key] + $post['libur'][$key] + $post['alpha'][$key];
					if($totalAbsen > $maxDate) {
						array_push($errors, $key);
					}
					if ($post['bulan'][$key] != '' || $post['username'][$key] != '' ) {
						$vals = [
							'bulan' => $post['bulan'][$key],
							'username' => $post['username'][$key],
							'nama_karyawan' => $post['nama_karyawan'][$key],
							'jenis_kelamin' => $post['jenis_kelamin'][$key],
							'nama_jabatan' => $post['nama_jabatan'][$key],
							'hadir' => $post['hadir'][$key],
							'libur' => $post['libur'][$key],
							'alpha' => $post['alpha'][$key]
						];
						array_push($data, $vals);
					}
				}
				
				if(sizeof($errors) == 0) {
					$this->Absensi_M->tambah_batch($data);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Data Berhasil Ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				} else {
					$bln = $this->input->get('bulan');
					$thn = $this->input->get('tahun');
					$names = [];
					foreach ($errors as $key => $value) {
						array_push($names, $post['nama_karyawan'][$value]);
					}
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data '.implode(', ', $names).' melebihi jumlah tanggal.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('admin/absensi/inputAbsensi?bulan='.$bln.'&tahun='.$thn);
				}
				redirect('admin/absensi');
			}

			$data['title'] = "Form Input Kehadiran";

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


			$data['input_absensi'] = $this->Absensi_M->tambah_absensi($bulantahun);

			$this->load->view('temp_admin/header', $data);
			$this->load->view('temp_admin/sidebar');
			$this->load->view('admin/tambah_data_absensi', $data);
			$this->load->view('temp_admin/footer');
		}

	public function update()
	{
		$maxDate = date('t');
		$totalAbsen = $this->input->post('hadir') + $this->input->post('libur') + $this->input->post('alpha');
		if($totalAbsen <= $maxDate) {
			$this->db->where('id_kehadiran', $this->input->post('id'));
			$this->db->update('data_kehadiran', [
				'hadir' => $this->input->post('hadir'),
				'libur' => $this->input->post('libur'),
				'alpha' => $this->input->post('alpha'),
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
		redirect(base_url('/admin/absensi'));
	}

	public function editAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->edit();
		} else {
			$id 			= $this->input->post('id_kehadiran');
			$nama_absensi	= $this->input->post('nama_absensi');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$uang_transport		= $this->input->post('uang_transport');

			$data = array(
				'nama_absensi' => $nama_absensi,
				'gaji_pokok' => $gaji_pokok,
				'uang_transport' => $uang_transport,
				'total' => $gaji_pokok + $uang_transport
			);

			$where = array('id_kehadiran' => $id);

			$this->sipModel->update_data('data_kehadiran', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil Diperbaharui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/absensi');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_absensi','nama absensi', 'required');
		$this->form_validation->set_rules('gaji_pokok','gaji pokok', 'required');
		$this->form_validation->set_rules('tj_transport','tunjangan transport', 'required');
		$this->form_validation->set_rules('uang_makan','uang makan', 'required');
	}

	public function hapus($id)
	{
		$where = array('id_kehadiran' => $id);
		$this->sipModel->delete_data($where, 'data_kehadiran');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data Berhasil Dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/absensi');
	}
}

?>