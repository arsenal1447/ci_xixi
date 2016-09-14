<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if( $this->session->userdata('online') ) {
			$username = $this->session->userdata('Username');
			if (!$this->user_model->is_admin($username)) {
				redirect(base_url(), 'refresh');
			}
		} else {
			redirect(base_url(), 'refresh');
		}
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$this->load->view('admin/admin_nav.php');
	}

	public function index() {
		$data['picture'] = $this->pic_model->picturenum();
		$data['images']  = $this->pic_model->checknum();
		$data['user']    = $this->user_model->usernum();

		$this->load->view('admin/admin_index.php',$data);
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function system() {
		$this->load->view('admin/admin_system.php');
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function types() {
		$data['catalogue'] = $this->catalogue_model->cat_all();

		$this->load->view('admin/admin_types.php',$data);
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function tags() {
		$data['tag'] = $this->tags_model->alltags();

		$this->load->view('admin/admin_tags.php',$data);
		$this->load->view('default/xi_copy.php');
		$this->load->view('default/xi_footer.php');
	}

	public function image($page=1) {
		$data['image'] = $this->pic_model->check($page);

		$this->load->view('admin/admin_image.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/image');
	    $config['total_rows'] = $this->pic_model->checknum();
	    $config['per_page']   = 10;
	    $config['num_links']  = 4;
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

	public function picture($page=1) {
		$data['image'] = $this->pic_model->pictures($page);

		$this->load->view('admin/admin_picture.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/picture');
	    $config['total_rows'] = $this->pic_model->picturenum();
	    $config['per_page']   = 10;
	    $config['num_links']  = 4;
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

	public function usercen($page=1) {
		$data['image'] = $this->user_model->users($page);

		$this->load->view('admin/admin_users.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/usercen');
	    $config['total_rows'] = $this->user_model->usernum();
	    $config['per_page']   = 10;
	    $config['num_links']  = 4;
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

	public function pass($uuid) {
		$this->pic_model->pass($uuid);

		$one  = $this->pic_model->one($uuid);
		foreach ($one as $value) {
			$username = $value['pic_user'];
		}
		$text = "你发布的图片已经通过管理员审核。<a href='" . base_url('view/' . $uuid) . "'>查看</a>";
		$this->letter_model->add_notice($username,$text);
	}

	public function reject($uuid) {
		$this->pic_model->reject($uuid);

		$one  = $this->pic_model->one($uuid);
		foreach ($one as $value) {
			$username = $value['pic_user'];
		}
		$text = "你发布的图片未通过管理员审核。";
		$this->letter_model->add_notice($username,$text);
	}

	public function delete($uuid) {
		if($this->pic_model->is_view($uuid)) {
			$query = $this->pic_model->one($uuid);
			foreach ($query as $value) {
				$path = $value['pic_url'];
			}

			if (file_exists($path)) {
				@unlink($path);
			}
		}

		$this->pic_model->delete($uuid);	
	}

	public function setsystem() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger border">', '</div>');

		$this->form_validation->set_rules('webtitle', '网站标题', 'trim|required|max_length[5]|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('default/xi_header.php');
			$this->load->view('admin/admin_nav.php');

			$data['catalogue'] = $this->catalogue_model->catalogue();

			$this->load->view('admin/admin_system.php',$data);
			$this->load->view('default/xi_copy.php');
			$this->load->view('default/xi_footer.php');
		} else {
			$this->system_model->set_webtitle();
			$this->system_model->set_keywords();
			$this->system_model->set_description();
			redirect(base_url('admin/system'), 'refresh');
		}
	}

	public function addtype() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		$this->form_validation->set_rules('name', '名称', 'trim|required|max_length[64]|is_unique[xi_catalogue.cat_name]|xss_clean');
		$this->form_validation->set_rules('another', '别名', 'trim|required|max_length[64]|alpha|is_unique[xi_catalogue.cat_another_name]|xss_clean');
		//$this->form_validation->set_rules('icon', '图标', 'trim|required|max_length[64]|alpha_dash|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('default/xi_header.php');
			$this->load->view('admin/admin_nav.php');

			$data['catalogue'] = $this->catalogue_model->catalogue();

			$this->load->view('admin/admin_types.php',$data);
			$this->load->view('default/xi_copy.php');
			$this->load->view('default/xi_footer.php');
		} else {
			$this->catalogue_model->add_type();
			redirect(base_url('admin/types'), 'refresh');
		}
	}

	public function deletetype($id) {
		$this->catalogue_model->delete($id);	
	}

	public function deletetag($id) {
		$this->tags_model->delete($id);	
	}

	public function deleteuser($id) {
		$this->user_model->delete($id);	
	}

}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */