<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xixi extends CI_Controller {
	private $realip;
	private $user;
	function __construct()
	{
		parent::__construct();

	    if (isset($_SERVER)){
	        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	            $this->realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
	            $this->realip = $_SERVER["HTTP_CLIENT_IP"];
	        } else {
	            $this->realip = $_SERVER["REMOTE_ADDR"];
	        }
	    } else {
	        if (getenv("HTTP_X_FORWARDED_FOR")){
	            $realip = getenv("HTTP_X_FORWARDED_FOR");
	        } else if (getenv("HTTP_CLIENT_IP")) {
	            $this->realip = getenv("HTTP_CLIENT_IP");
	        } else {
	            $this->realip = getenv("REMOTE_ADDR");
	        }
	    }

    	if( $this->session->userdata('online') ) {
			$this->user = $this->session->userdata('Username');
		} else {
			$this->user = 0;
		}
	}

	public function index() {   //最新
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['pictureURL'] = base_url('xixi/images');
		$this->load->view('xi_index.php',$data);
        $this->load->view('default/xi_footer.php');
	}

	public function popular() {   //热门
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['pictureURL'] = base_url('xixi/hot');
		$this->load->view('xi_index.php',$data);
        $this->load->view('default/xi_footer.php');
	}

	public function images( $page = 1 ) {     //根据记录的发布日期返回所有记录
		$query = $this->pic_model->pictures( $page );

		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) {                   //文件存在
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}

				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function hot( $page = 1 ) {   //根据记录被喜欢的次数返回所有记录
		$query = $this->pic_model->hot( $page );
		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) { //文件存在
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}

				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function search($search) {   //搜索
		$head['search'] = urldecode($search);
		$this->load->view('default/xi_header.php',$head);
		$data['pictureURL'] = base_url('xixi/searcher') . "/" . urldecode($search);
		$this->load->view('xi_index.php',$data);
        $this->load->view('default/xi_footer.php');
	}

	public function searcher($search = "",$page = 1) {   //返回指定搜索内容的数据
		$query = $this->pic_model->search( urldecode($search), $page );
		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) { //文件存在
				//$this->pic_model->addview($value['pic_uuid']);      //更新浏览次数
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}
				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);
				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function catalogue($catalogue = "") {   //分类
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['pictureURL'] = base_url('xixi/cat') . "/" . urldecode($catalogue);
		$this->load->view('xi_index.php',$data);
        $this->load->view('default/xi_footer.php');
	}

	public function cat($catalogue = "",$page = 1) {   //返回指定分类的数据
		$catalogue = urldecode($catalogue);
		$arraySon  = array();
	    $name = $this->catalogue_model->name_by_another($catalogue);
	    if($this->catalogue_model->have_son($name)) {
	        $cat = $this->catalogue_model->cat_name($name);
	        foreach ($cat as $value) {
	        	array_push($arraySon,$value['cat_another_name']);
	        }
	    }

		$query = $this->pic_model->catalogue( $catalogue, $page, $arraySon );
		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) { //文件存在
				//$this->pic_model->addview($value['pic_uuid']);      //更新浏览次数
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}
				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);
				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function tag($tag) {   //标签
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		$data['pictureURL'] = base_url('xixi/gettag') . "/" . urldecode($tag);
		$this->load->view('xi_index.php',$data);
        $this->load->view('default/xi_footer.php');
	}

	public function gettag($tag = "",$page = 1) {   //返回指定标签的数据
		$query = $this->pic_model->tag( urldecode($tag), $page );
		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) { //文件存在
				//$this->pic_model->addview($value['pic_uuid']);      //更新浏览次数
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}
				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);
				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function love($uuid) {
		$loveArray = array();
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			if($this->love_model->is_love($uuid,$user)) {
				$this->love_model->remove_love($uuid,$user);
				$this->pic_model->removelove($uuid);
			} else {
				$this->love_model->add_love($uuid,$user);
				$this->pic_model->addlove($uuid);
			}
			$lovenum = $this->love_model->pic_love($uuid);

			$is_love = $this->love_model->is_love($uuid,$user);

			$jsonStr = array('love' => $lovenum, 'is_love' => $is_love, 'is_login' => 1 );
		} else {
			$jsonStr = array('love' => 0, 'is_love' => 0, 'is_login' => 0 );
		}

		array_push($loveArray,$jsonStr);

		echo json_encode($loveArray);
	}

	public function like( $uuid ) {
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

	    $likeArray = array();

	    $is_like = $this->like_model->is_like($uuid,$realip);

		if ($is_like) {
			$this->like_model->remove_like($uuid,$realip);
			$this->pic_model->removelike($uuid);
		} else {
			$this->like_model->add_like($uuid,$realip);
			$this->pic_model->addlike($uuid);
		}

		$likenum = $this->like_model->pic_like($uuid);

		$is_like = $this->like_model->is_like($uuid,$realip);

		$jsonStr = array('like' => $likenum, 'is_like' => $is_like);

		array_push($likeArray,$jsonStr);

		echo json_encode($likeArray);
	}

	public function collect($user, $page = 1 ) {     //根据记录的发布日期返回所有记录
		$user = urldecode($user);
		$uuid  = $this->love_model->user_love( $user,$page );

		$ArrImages   = array();

		foreach ($uuid as $pic) {
			$picid = $pic['love_pic'];
			$query = $this->pic_model->one( $picid );
		
			foreach ($query as $value) {
				if (file_exists($value['pic_url'])) {                   //文件存在
					$image    = GetImageSize($value['pic_url']);
					$image_w  = $image[0];
					$image_h  = $image[1];
					$image_u  = base_url() . $value['pic_url'];
					$image_t  = $value['pic_name'];
					$image_m  = $value['pic_user'];
					$tag      = explode (" ", $value['pic_tag']);
					if(count($tag) > 0) {
						$image_s = $tag[0];
					} else {
						$image_s  = "";
					}

					$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
					$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

					$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
					array_push($ArrImages,$image_i);
				}
			}
		}
		echo json_encode($ArrImages);
	}

	public function user($user, $page = 1 ) {     //根据记录的发布日期返回所有记录
		$user = urldecode($user);
		$query = $this->pic_model->user( $user,$page );

		$ArrImages   = array();
		foreach ($query as $value) {
			if (file_exists($value['pic_url'])) {                   //文件存在
				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];
				$image_u  = base_url() . $value['pic_url'];
				$image_t  = $value['pic_name'];
				$image_m  = $value['pic_user'];
				$tag      = explode (" ", $value['pic_tag']);
				if(count($tag) > 0) {
					$image_s = $tag[0];
				} else {
					$image_s  = "";
				}

				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

				$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'text' => $image_t, 'user' => $image_m,'tags' => $image_s, 'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}

	public function album($user, $page = 1 ) {     //根据记录的发布日期返回所有记录

	}

}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */