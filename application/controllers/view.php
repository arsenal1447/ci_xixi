<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

	public function index( $id = 0 ) {
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);

		static $realip;
	    if (isset($_SERVER)){
	        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
	            $realip = $_SERVER["HTTP_CLIENT_IP"];
	        } else {
	            $realip = $_SERVER["REMOTE_ADDR"];
	        }
	    } else {
	        if (getenv("HTTP_X_FORWARDED_FOR")){
	            $realip = getenv("HTTP_X_FORWARDED_FOR");
	        } else if (getenv("HTTP_CLIENT_IP")) {
	            $realip = getenv("HTTP_CLIENT_IP");
	        } else {
	            $realip = getenv("REMOTE_ADDR");
	        }
	    } 

	    $uuid = $this->pic_model->guuid($id);

		if ( $this->pic_model->is_view($uuid) ) {  //记录存在
			$this->pic_model->addview($uuid);      //更新浏览次数
			$query = $this->pic_model->one($uuid);

			foreach ($query as $value) {
				if (file_exists($value['pic_url'])) { //文件存在
					$pic            = GetImageSize ($value['pic_url']);
					$data['id']     = $value['ID'];
					$data['uuid']   = $uuid;
					$data['name']   = $value['pic_name'];
					$data['text']   = $value['pic_text'];
					$data['tags']   = $value['pic_tag'];
					$data['user']   = $value['pic_user'];
					$picture        = 'upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg';
					if (file_exists($picture)) {
						$data['picture'] = base_url('upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg');
					} else {
						$data['picture'] = base_url('upload/user/default_2.jpg');
					}
					$data['date']   = $value['pic_datetime'];
					$data['collect'] = $this->love_model->pic_love($uuid);
					$data['like']   = $this->like_model->pic_like($uuid);
					$data['view']   = $value['pic_view'];
					$data['share']  = $value['pic_share'];

					$data['url']    = base_url() . $value['pic_url'];
					$data['show']   = TRUE;

					if( $this->session->userdata('online') ) {
						$user = $this->session->userdata('Username');
						if($this->follow_model->is_follow($value['pic_user'],$user)){
							$data['follow'] = 1;
						} else {
							$data['follow'] = 0;
						}
					} else {
						$user = 0;
						$data['follow'] = 0;
					}

					$data['is_love'] = $this->love_model->is_love($uuid,$user);
					$data['is_like'] = $this->like_model->is_like($uuid,$realip);



					$next = $id + 1;
					while ( !$this->pic_model->is_view($this->pic_model->guuid($next)) && $next < $this->pic_model->max_id() ) {
						$next++;
					}
					$pres = $id - 1;
					while ( !$this->pic_model->is_view($this->pic_model->guuid($pres)) && $pres > 0 ) {
						$pres--;
					}
					$data['next']  = $next;
					$data['pres']  = $pres;
				} else {   //文件不存在
					$data['show']   = FALSE;
				}
			}
		} else {                                //记录不存在
			$data['show']  = FALSE;
		}

		$this->load->view('xi_view.php',$data);
		$this->load->view('default/xi_copy.php');
        $this->load->view('default/xi_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */