<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_join extends CI_Model {

	public function join($email, $password, $kode_aktifasi)
	{
		$data = array(
			'email' 		=> $email,
			'password' 		=> password_hash($password, PASSWORD_DEFAULT),
			'kode_aktifasi' => $kode_aktifasi
		);

		$this->db->insert('user', $data);

		return TRUE;
	}	
}

/* End of file model_join.php */
/* Location: ./application/models/model_join.php */