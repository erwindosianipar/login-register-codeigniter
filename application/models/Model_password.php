<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_password extends CI_Model {

	public function cek($email, $kode_aktifasi)
	{
		$this->db->where('email', $email);

		if ($this->db->count_all_results('user')>0)
		{
			$this->load->helper('string');
			$data = array(
				'kode_aktifasi' => $kode_aktifasi,
				'aktif'			=> 0
			);

			$this->db->where('email', $email);
			$this->db->update('user', $data);

			return TRUE;
		} else return FALSE;
	}

	public function reset($code, $email)
	{
		$this->db->select('kode_aktifasi');
		$this->db->from('user');
		$this->db->where('email', $email);

		$kode_aktifasi = $this->db->get()->row('kode_aktifasi');

		if ($kode_aktifasi === $code) return TRUE;
		else return FALSE;
	}

	public function renew($email, $password)
	{
		$data = array(
			'password'		=> password_hash($password, PASSWORD_DEFAULT),
			'kode_aktifasi' => NULL,
			'aktif'			=> 1
		);

		$this->db->where('email', $email);
		$this->db->update('user', $data);
	}
}

/* End of file model_password.php */
/* Location: ./application/models/model_password.php */