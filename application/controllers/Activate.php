<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activate extends CI_Controller {

	public function index()
	{
		$code 	= $this->input->get('code');
		$email 	= $this->input->get('email');

		if (strlen($code)==50 && !empty($email))
		{
			$this->load->model('model_activate');

			if ($this->model_activate->activate($code, $email))
			{
				$this->session->set_flashdata('info', '<script>swal({title: "Success", text: "Your account has been activated", timer: 10000, icon: "success", button: false});</script>');
				redirect(base_url(), 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', '<script>swal({title: "Error", text: "Your activation code link is incorrect", timer: 10000, icon: "error", button: false});</script>');
				redirect(base_url(), 'refresh');
			}
		}
		else if(empty($code) && empty($email))
		{
			show_404();
		}
		else
		{
			$this->session->set_flashdata('info', '<script>swal({title: "Error", text: "Your activation code link is incorrect", timer: 10000, icon: "error", button: false});</script>');
			redirect(base_url(), 'refresh');
		}
	}
}

/* End of file activate.php */
/* Location: ./application/controllers/activate.php */