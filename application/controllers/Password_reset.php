<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_reset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_password');
		$this->load->helper('string');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

		if ($this->form_validation->run() == TRUE)
		{
			$email 			= $this->input->post('email');
			$kode_aktifasi 	= random_string('alnum', 50);

			if ($this->model_password->cek($email, $kode_aktifasi))
			{
				$this->_email_reset($email, $kode_aktifasi);

				$this->session->set_flashdata('info', '<script>swal({title: "Success", text: "Link to reset your password was send", timer: 10000, icon: "success", button: false});</script>');
				redirect(base_url('login'),'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', '<script>swal({title: "Error", text: "No account with email you entered", timer: 10000, icon: "error", button: false});</script>');
				redirect(base_url('password_reset'),'refresh');
			}
		}
		else
		{
			$data = array('title' => 'Password Reset');

			$this->load->view('template/header', $data, FALSE);
			$this->load->view('password_reset');
			$this->load->view('template/footer');
		}
	}

	public function reset()
	{
		$code 	= $this->input->get('code');
		$email 	= $this->input->get('email');

		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'confirm password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == TRUE)
		{
			$password = $this->input->post('password');

			$this->model_password->renew($email, $password);
			$this->_email_sukses($email);

			$this->session->set_flashdata('info', '<script>swal({title: "Success", text: "Your password has been reset", timer: 10000, icon: "success", button: false});</script>');
			redirect(base_url(), 'refresh');
		}
		else
		{
			if (strlen($code)==50 && !empty($email))
			{
				if ($this->model_password->reset($code, $email))
				{
					$data = array('title' => 'Password Renew');

					$this->load->view('template/header', $data, FALSE);
					$this->load->view('password_renew');
					$this->load->view('template/footer');
				} else show_404();
			}
			else if(empty($code) && empty($email))
			{
				show_404();
			}
			else
			{
				$this->session->set_flashdata('info', '<script>swal({title: "Success", text: "Your password reset link is incorrect", timer: 10000, icon: "success", button: false});</script>');
				redirect(base_url('password_reset'), 'refresh');
			}
		}
	}

	function _email_reset($email, $kode_aktifasi)
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
		$this->email->subject('[Password Reset]');

		$html = '
		<div style="margin-bottom: 20px; font-weight: bold;">Hello '.$email.',</div>

		<div>Someone has requested a password reset to our sistem.</div>
		<div style="margin-bottom: 10px;">To reset your password, please click this link and we will redirect you to reset password form: <a href="'.base_url('password_reset/reset?code='.$kode_aktifasi.'&email='.$email).'">Reset my password</a>.
		</div>
		<div>If that link cannot working you can access this URL from your browser</div>
		<div><a href="'.base_url('password_reset/reset?code='.$kode_aktifasi.'&email='.$email).'">'.base_url('password_reset/reset?code='.$kode_aktifasi.'&email='.$email).'</a></div>

		<div style="margin-bottom: 20px; margin-top: 10px;">If you have a question reply this email and we will contact you as soon as possible, thank you!</div>
		';

		$this->email->message($html);
		return $this->email->send();
	}

	function _email_sukses($email)
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
		$this->email->subject('[Password Reset Success]');

		$html = '
		<div style="margin-bottom: 20px; font-weight: bold;">Hello '.$email.',</div>

		<div>Your password has been reset at '.date('Y/m/d h:i:s a').', please keep your account secure</div>

		<div style="margin-bottom: 20px; margin-top: 10px;">If you have a question reply this email and we will contact you as soon as possible, thank you!</div>
		';

		$this->email->message($html);
		return $this->email->send();
	}
}

/* End of file password_reset.php */
/* Location: ./application/controllers/password_reset.php */