<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[3]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[18]');

	  	if($this->form_validation->run() == FALSE) {
	  		if( $this->session->userdata('online') ) {
	  			redirect(base_url(), 'refresh');
	  		} else {
	        	$this->load->view('xi_login.php');
	  		}
	 	} else {
	 		if($this->user_model->login()){
	 			$sess = array(
		        	'Username' => $this->input->post('username'),
		        	'online' => true
		      	);
		      	$this->session->set_userdata($sess);

		      	redirect(base_url(), 'refresh');
	 		} else {
	 			$data['url']     = site_url('login');
	 			$data['message'] = "登录失败,请检查用户名和密码是否正确。";
	 			$data['where']   = "登录页面";
	 			$head['search'] = "";
				$this->load->view('default/xi_header.php',$head);
		 		$this->load->view('default/xi_message.php',$data);
				$this->load->view('default/xi_copy.php');
	        	$this->load->view('default/xi_footer.php');
	 		}


	  	}
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */