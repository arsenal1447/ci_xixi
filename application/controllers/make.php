<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Make extends CI_Controller {

	public function index() {
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['make'] = $this->tags_model->alltags();
	 	$this->load->view('xi_make.php',$data);
		$this->load->view('default/xi_copy.php');
    	$this->load->view('default/xi_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */