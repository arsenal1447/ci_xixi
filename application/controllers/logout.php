<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index() {
		if( $this->session->userdata('online') ) {
      $this->session->sess_destroy();
      redirect(base_url(), 'refresh');
    } else {
      $data['url']     = base_url();
      $data['message'] = "非法操作。";
      $data['where']   = "首页";
      $head['search'] = "";
      $this->load->view('default/xi_header.php',$head);
      $this->load->view('default/xi_message.php',$data);
      $this->load->view('default/xi_copy.php');
      $this->load->view('default/xi_footer.php');
    }
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */