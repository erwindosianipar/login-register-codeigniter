<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_activate extends CI_Model {

	public function activate($code, $email)
	{
		$this->db->select('kode_aktifasi');
		$this->db->from('user');
		$this->db->where('email', $email);

		$kode_aktifasi = $this->db->get()->row('kode_aktifasi');

		if ($kode_aktifasi === $code)
		{
			$data = array(
		        'kode_aktifasi' => NULL,
		        'aktif'			=> 1
			);

			$this->db->where('email', $email);
			$this->db->update('user', $data);

			return TRUE;
		} else return FALSE;
	}
}

/* End of file model_activate.php */
/* Location: ./application/models/model_activate.php */