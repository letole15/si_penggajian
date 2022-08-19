<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_M extends CI_Model {
	public function tampil_absensi($bulanTahun)
	{
		$this->db->select('*');
		$this->db->from('data_kehadiran');
		$this->db->join('data_karyawan', 'data_karyawan.username = data_kehadiran.username');
		$this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_kehadiran.nama_jabatan');
		$this->db->where('data_kehadiran.bulan', $bulanTahun);
		return $this->db->get()->result_array();
	}

	public function tambah_absensi($bulanTahun)
	{
		return $this->db->query("
			SELECT data_karyawan.*, data_jabatan.nama_jabatan FROM data_karyawan 
			INNER JOIN data_jabatan ON data_karyawan.jabatan = data_jabatan.nama_jabatan 
			WHERE NOT EXISTS (SELECT * FROM data_kehadiran 
			WHERE bulan = '$bulanTahun' AND data_karyawan.username = data_kehadiran.username)")->result_array();
	}

	public function tambah_batch($data)
	{
		$jumlahData = count($data);
		if($jumlahData > 0) {
			$this->db->insert_batch('data_kehadiran', $data);
		}
	}
}