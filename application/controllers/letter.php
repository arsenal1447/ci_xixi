<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letter extends CI_Controller {

	public function index($page = 1) {
		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
			$data['letter'] = $this->letter_model->letter($username,$page);
		} else {
			redirect(base_url(), 'refresh');
		}

		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);

		$this->load->view('xi_letter.php',$data);

		$this->load->view('default/xi_div.php');
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function send($username,$text) {
		$username = urldecode($username);
		$text     = urldecode($text);
		if ($this->session->userdata('online')) {
			$name = $this->session->userdata('Username');
			if ($name == $username) {
				$static = 1; //不能给自己发
			} else {
				if($this->letter_model->send_letter($username,$name,$text)) {
					$static = 0; //成功
				} else {
					$static = 3; //失败
				}
			}
		} else {
			$static = 2;  //未登录
		}

		$jsonStr = array('static' => $static );

		$letterArray = array();
		array_push($letterArray,$jsonStr);
		echo json_encode($letterArray);
	}

	public function delete($id = 0) {
		if ($this->letter_model->is_letter($id)) {
			$this->letter_model->delete($id);
		}
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */