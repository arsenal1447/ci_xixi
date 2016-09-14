<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index($user = "admin") {
		$user     = urldecode($user);
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}


		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow']  = 0;
			$data['setting'] = "";
		}

		$data['active'] = "album";
		
		$this->load->view('xi_user.php',$data);

		$this->load->view('default/xi_div.php');

		$this->load->view('default/xi_copy.php');

		$this->load->view('default/xi_footer.php');
	}

	public function addfollow($user = "") {
		$user = urldecode($user);
		if (!$this->user_model->is_user($user)) {
			return;
		}
		if (!$this->session->userdata('online'))
		{
			return;
		}
		$form_name = $this->session->userdata('Username');
		$to_name   = $user;
		if ($form_name == $to_name) {
			return;
		}

		if($this->follow_model->is_follow($to_name,$form_name)){
			$this->follow_model->remove_follow($to_name,$form_name);
			$jsonStr = array('is_follow' => 0);
		} else {
			$this->follow_model->add_follow($to_name,$form_name);
			$jsonStr = array('is_follow' => 1);
		}

		$followArray = array();

		array_push($followArray,$jsonStr);

		echo json_encode($followArray);
	}

	public function follow($user = "",$page = 1) {
		$user = urldecode($user);
		if (!$this->user_model->is_user($user)) {
			return;
		}

		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}

		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow'] = 0;
			$data['setting'] = "";
		}
		
		$data['active'] = "follow";

		$this->load->view('xi_user.php',$data);

		$follow['user']     = $user;
		$follow['myfollow'] = $this->follow_model->follow($user,$page);

		$this->load->view('xi_follow.php',$follow);


		  //分页
	    $config['base_url']   = base_url('user/follow') . "/" . $user . "/";
	    $config['total_rows'] = $this->follow_model->follow_to($user);
	    $config['per_page']   = 20;
	    $config['num_links']  = 4;
	    $config['uri_segment'] = 4;
	    $config['use_page_numbers'] = TRUE;
	    $config['first_link'] = '首页';
	    $config['last_link']  = '末页';
	    $config['next_link']  = '下一页';
	    $config['prev_link']  = '上一页';

	    $config['num_tag_open']   = '<li>';
	    $config['num_tag_close']  = '</li>';

	    $config['cur_tag_open']   = '<li class="active disabled"><a href="javascript:void(0)">';
	    $config['cur_tag_close']  = '</a></li>';

	    $config['prev_tag_open']  = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';

	    $config['full_tag_open'] = '<nav class="pagination">';
	    $config['full_tag_close'] = '</nav>';

    	$this->pagination->initialize($config); 

		$this->load->view('default/xi_page.php');


		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function atten($user = "",$page = 1) {
		$user = urldecode($user);
		if (!$this->user_model->is_user($user)) {
			return;
		}

		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}

		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow'] = 0;
			$data['setting'] = "";
		}
		
		$data['active'] = "atten";

		$this->load->view('xi_user.php',$data);

		$follow['user']     = $user;
		$follow['myfollow'] = $this->follow_model->atten($user,$page);

		$this->load->view('xi_atten.php',$follow);


		  //分页
	    $config['base_url']   = base_url('user/atten') . "/" . $user . "/";
	    $config['total_rows'] = $this->follow_model->follow_form($user);
	    $config['per_page']   = 20;
	    $config['num_links']  = 4;
	    $config['uri_segment'] = 4;
	    $config['use_page_numbers'] = TRUE;
	    $config['first_link'] = '首页';
	    $config['last_link']  = '末页';
	    $config['next_link']  = '下一页';
	    $config['prev_link']  = '上一页';

	    $config['num_tag_open']   = '<li>';
	    $config['num_tag_close']  = '</li>';

	    $config['cur_tag_open']   = '<li class="active disabled"><a href="javascript:void(0)">';
	    $config['cur_tag_close']  = '</a></li>';

	    $config['prev_tag_open']  = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';

	    $config['full_tag_open'] = '<nav class="pagination">';
	    $config['full_tag_close'] = '</nav>';

    	$this->pagination->initialize($config); 

		$this->load->view('default/xi_page.php');


		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function picture($user = "admin") {
		$user = urldecode($user);
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}

		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow'] = 0;
			$data['setting'] = "";
		}

		$data['active'] = "picture";
		
		$this->load->view('xi_user.php',$data);

		$data['pictureURL'] = base_url('xixi/user/' . $user);
		$this->load->view('xi_index.php',$data);

		
		$this->load->view('default/xi_footer.php');
	}

	public function album($user = "admin") {
		$user = urldecode($user);
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}

		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow'] = 0;
			$data['setting'] = "";
		}

		$data['active'] = "album";
		
		$this->load->view('xi_user.php',$data);

		$data['pictureURL'] = base_url('xixi/album/' . $user);
		$this->load->view('xi_index.php',$data);

		
		$this->load->view('default/xi_footer.php');
	}

	public function collect($user = "admin") {
		$user = urldecode($user);
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['username']    = $user;
		$data['follow_to']   = $this->follow_model->follow_to($user);
		$data['follow_form'] = $this->follow_model->follow_form($user);

		$picture             = 'upload/user/' . $this->user_model->picture($user) . '_1.jpg';
		if (file_exists($picture)) {
			$data['picture'] = base_url('upload/user/' . $this->user_model->picture($user) . '_1.jpg');
		} else {
			$data['picture'] = base_url('upload/user/default_1.jpg');
		}

		if ($this->session->userdata('online')) {
			$form_name = $this->session->userdata('Username');
			if ($user == $form_name) {
				$data['setting'] = $form_name;
			} else {
				$data['setting'] = "";
			}
			if($this->follow_model->is_follow($user,$form_name)){
				$data['follow'] = 1;
			} else {
				$data['follow'] = 0;
			}
		} else {
			$data['follow'] = 0;
			$data['setting'] = "";
		}

		$data['active'] = "collect";
		
		$this->load->view('xi_user.php',$data);

		$data['pictureURL'] = base_url('xixi/collect/' . $user);
		$this->load->view('xi_index.php',$data);

		
		$this->load->view('default/xi_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */