<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {

	public function index()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[user.email]', array('is_unique' => 'This %s is already used'));
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'confirm password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == TRUE)
		{
			$email 		= $this->input->post('email');
			$password 	= $this->input->post('password');

			$this->load->model('model_join');
			$this->load->helper('string');
			
			$kode_aktifasi = random_string('alnum', 50);

			if ($this->model_join->join($email, $password, $kode_aktifasi))
			{
				$this->_email($email, $kode_aktifasi);

				$this->session->set_flashdata('info', '<script>swal({title: "Info", text: "Check your email to activate account", timer: 10000, icon: "info", button: false});</script>');
				redirect(base_url(), 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', '<script>swal({title: "Error", text: "Something when wrong when create your account", timer: 10000, icon: "error", button: false});</script>');
				redirect(base_url('join'), 'refresh');
			}
		}
		else
		{
			$data = array('title' => 'Join');

			$this->load->view('template/header', $data, FALSE);
			$this->load->view('join');
			$this->load->view('template/footer');
		}
	}

	function _email($email, $kode_aktifasi)
	{
		$config = [
			'mailtype'  	=> 'html',
            'charset'   	=> 'utf-8',
            'protocol'  	=> 'smtp',
            'smtp_host' 	=> 'smtp.gmail.com',
            'smtp_user' 	=> '', // gmail address
            'smtp_pass'   	=> '', // gmail password
            'smtp_crypto' 	=> 'ssl',
            'smtp_port'   	=> 465,
            'crlf'    		=> "\r\n",
            'newline' 		=> "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('gmail@gmail.com', 'Your Name');

		$this->email->to($email);
		$this->email->subject('[Confirmation Email]');

        $html = '
			<div style="margin-bottom: 20px; font-weight: bold;">Hello There,</div>

			<div>Thank you for using and for join.</div>
			<div style="margin-bottom: 10px;">To activate your account, please click this link and we will redirect you to login page: <a href="'.base_url('activate?code='.$kode_aktifasi.'&email='.$email).'">Confirm my email address</a>.
			</div>
			<div>If that link cannot working you can access this URL from your browser</div>
			<div><a href="'.base_url('activate?code='.$kode_aktifasi.'&email='.$email).'">'.base_url('activate?code='.$kode_aktifasi.'&email='.$email).'</a></div>

			<div style="margin-bottom: 20px; margin-top: 10px;">If you have a question reply this email and we will contact you as soon as possible, thank you!</div>
		';

		$this->email->message($html);
		return $this->email->send();
	}
}

/* End of file join.php */
/* Location: ./application/controllers/join.php */