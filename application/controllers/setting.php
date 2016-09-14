<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function index() {
		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
			$data['user'] = $username;
		} else {
			redirect(base_url(), 'refresh');
		}

		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);

		$picture           = 'upload/user/' . $this->user_model->picture($username) . '_source.jpg';
		if (file_exists($picture)) {
			$data['image'] = $picture;
		} else {
			$data['image'] = base_url('upload/user/default.jpg');
		}
		
	 	$this->load->view('xi_setting.php',$data);
		$this->load->view('default/xi_copy.php');
    	$this->load->view('default/xi_footer.php');
	}

	public function upload() {

		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
		} else {
			redirect(base_url(), 'refresh');
		}

		$str = md5($username);

		$result            = array();
		$result['success'] = false;
		$successNum        = 0;
		$avatarNumber      = 1;
		$i                 = 0;
		$msg               = '';
		$dir               = "upload/user";
		while (list($key, $val) = each($_FILES))
		{
			if ( $_FILES[$key]['error'] > 0)
		    {
				$msg .= $_FILES[$key]['error'];
			}
			else
			{
				if ($key == '__source')
				{
					$virtualPath = "$dir/" . $str . "_source" . ".jpg";
					$result['sourceUrl'] = '/' . $virtualPath;
					move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					$successNum++;
				}
				else if(strpos($key, '__avatar') === 0)
				{
					$virtualPath = "$dir/" . $str . "_" . $successNum . ".jpg";
					$result['avatarUrls'][$i] = '/' . $virtualPath;
					move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					$successNum++;
					$i++;
				}
			}
		}
		$result['msg'] = $msg;
		if ($successNum > 0)
		{
			$result['success'] = true;
			$this->user_model->add_picture($username,$str);
		}
		print json_encode($result);
	}

}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */