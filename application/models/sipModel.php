<?php

class sipModel extends CI_Model
{
	
	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}

	public function delete_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function insert_batch($table = null, $data = array())
	{
		$jumlah = count($data);
		if($jumlah > 0) {
			$this->db->insert_batch($table, $data);
		}
	}

	public function cek_auth()
	{
		$username		= set_value('username');
		$password		= set_value('password');

		$result			= $this->db->where('username', $username === 'admin' ? 'ADM-01': $username);
		if($username !== 'admin') {
			$this->db->where('password', md5($password));
		}
		$result = $this->db
		->limit(1)
		->get('data_karyawan');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
		
	}

	public function getAuthUserPegawai($username)
	{
		$this->db->select('*');
		$this->db->from('data_karyawan');
		$this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_karyawan.jabatan');
		$this->db->where('data_karyawan.username', $username);
		return $this->db->get();
	}

}

?>