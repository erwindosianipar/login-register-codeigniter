<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = array('title' => 'Home');

		$this->load->view('template/header', $data, FALSE);
		$this->load->view('home');
		$this->load->view('template/footer');
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/beranda.php */