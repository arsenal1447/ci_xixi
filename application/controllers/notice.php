<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {

	public function index($page = 1) {
		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
			$data['letter'] = $this->letter_model->notice($username,$page);
		} else {
			redirect(base_url(), 'refresh');
		}

		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);

		$this->load->view('xi_notice.php',$data);

		$this->load->view('default/xi_div.php');
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */