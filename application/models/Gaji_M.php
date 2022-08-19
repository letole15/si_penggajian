<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_M extends CI_Model {
	public function tampil_gaji($bulanTahun)
	{
		/*return $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_karyawan.jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_jabatan.intensif, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.alpha, data_bonus.bonus, data_bonus.thr
			FROM data_karyawan
			INNER JOIN data_kehadiran 
			ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan
			ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result_array();*/

		/*return $this->db->query("SELECT data_karyawan.username, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_karyawan.jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_jabatan.intensif, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur, data_kehadiran.alpha
			FROM data_karyawan
			INNER JOIN data_kehadiran 
			ON data_kehadiran.username = data_karyawan.username
			INNER JOIN data_jabatan
			ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result_array();*/
		$this->db->select('*');
		$this->db->from('data_karyawan');
		$this->db->join('data_kehadiran', 'data_kehadiran.username = data_karyawan.username');
		$this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_karyawan.jabatan');
		$this->db->join('data_bonus', 'data_bonus.nama_jabatan = data_karyawan.jabatan');
		$this->db->where('data_kehadiran.bulan', $bulanTahun);
		$this->db->order_by('data_karyawan.nama_karyawan', 'asc');
		return $this->db->get()->result_array();

		/*$result = $query->result_array(); //Store data as Array
        return $result;*/
	}

	public function tampil_lap_gaji($bulanTahun)
	{
		/*$this->db->select('data_karyawan.username, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.uang_transport, data_jabatan.intensif, data_kehadiran.alpha, data_kehadiran.hadir, data_kehadiran.libur');*/
		$this->db->select('*');
		$this->db->from('data_karyawan');
		$this->db->join('data_kehadiran', 'data_kehadiran.username = data_karyawan.username');
		$this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_karyawan.jabatan');
		$this->db->join('data_bonus', 'data_bonus.nama_jabatan = data_karyawan.jabatan');
		$this->db->where('data_kehadiran.bulan', $bulanTahun);
    $this->db->group_by('data_karyawan.username');
		$this->db->order_by('data_karyawan.nama_karyawan', 'asc');
		return $this->db->get()->result_array();
	}

	public function tampil_print_slip($bulanTahun, $karyawan)
	{
		$this->db->select('*');
		$this->db->from('data_kehadiran');
		$this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_kehadiran.nama_jabatan');
		$this->db->join('data_karyawan', 'data_karyawan.username = data_kehadiran.username');
		$this->db->join('data_bonus', 'data_bonus.nama_jabatan = data_karyawan.jabatan');
		$this->db->where('data_kehadiran.bulan', $bulanTahun);
		$this->db->where('data_karyawan.username', $karyawan);
		return $this->db->get()->result();
	}
}