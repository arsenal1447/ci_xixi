<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		$this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[3]|max_length[12]|is_unique[xi_users.user_login]|xss_clean');
		$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[18]|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
		$this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email|is_unique[xi_users.user_email]');
	  	
	  	if($this->form_validation->run() == FALSE) {
	  		if( $this->session->userdata('online') ) {
	  			redirect(base_url(), 'refresh');
	  		} else {
				$this->load->view('xi_register.php');
	  		}
	 	} else {
	 		if($this->user_model->register()){
				redirect(base_url('login'), 'refresh');
	 		} else {
	 			$data['url']     = site_url('register');
	 			$data['message'] = "注册失败。";
	 			$data['where']   = "注册页面";
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