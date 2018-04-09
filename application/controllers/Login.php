<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
      $this->load->model('Member_model');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function logging_in()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		if ($this->Member_model->validasi_login($email, $password)) {
			redirect('/Shop/');
		} else {
			redirect('/Login/');
		};
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/Login/');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */