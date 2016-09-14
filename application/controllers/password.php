<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {

	public function index() {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger border">', '</div>');
		$this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email');

	  	if($this->form_validation->run() == FALSE) {
	  		if( $this->session->userdata('online') ) {
	  			redirect(base_url(), 'refresh');
	  		} else {
				$this->load->view('xi_forget.php');
	  		}
	 	} else {
	 		if($this->user_model->email()){
	 			    $data['url']     = base_url();
			        $data['message'] = "已发送邮件到你的邮箱，请通过安全链接修改密码。";
			        $data['where']   = "首页";
	 		} else {
	 				$data['url']     = base_url();
			        $data['message'] = "不存在的邮箱，请确认邮箱地址是否正确。";
			        $data['where']   = "首页";
	 		}
	 		$this->load->view('default/xi_header.php');
		 	$this->load->view('default/xi_message.php',$data);
			$this->load->view('default/xi_copy.php');
	        $this->load->view('default/xi_footer.php');
	  	}
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */