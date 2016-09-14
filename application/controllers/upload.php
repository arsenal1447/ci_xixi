<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function index() {
		$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);
		if( $this->session->userdata('online') ) {
			$this->load->view('xi_upload.php');
		} else {
			redirect(base_url(), 'refresh');
		}
		
		$this->load->view('default/xi_copy.php');
        $this->load->view('default/xi_footer.php');
	}

	public function release() {
		$year  = date("Y");
	    $month = date("m");
	    $day   = date("d");

	    if( !is_dir("upload") )
	    {
	      if( !mkdir ("upload", 0755) )
	      {
	        return false;
	      }
	    }
	    chdir("upload");
	    if( !is_dir($year) )
	    {
	      if( !mkdir ($year, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir($year);
	    if( !is_dir($month) )
	    {
	      if( !mkdir ($month, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir($month);
	    if( !is_dir($day) )
	    {
	      if( !mkdir ($day, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir("../../../");

	    $targetFolder = "upload/".$year."/".$month."/".$day."/";

	  	$head['search'] = "";
		$this->load->view('default/xi_header.php',$head);

		$username = $this->session->userdata('Username');
		if($this->user_model->is_admin($username)) {
			$status = 1;
		} else {
			$status = 0;
		}

		$dir         = "upload/xixi";
	    $current_dir = opendir( $dir );
	    $ArrImages   = array();
	    while( ( $file = readdir( $current_dir ) ) !== false ) {
	    	$sub  = $dir . "/" . $file;
	    	$name = basename( $sub );
			$ext  = pathinfo( $sub, PATHINFO_EXTENSION );
	    	$copyFilePath = $targetFolder . md5($name) . "." .$ext;
	 		if( $sub == '.' || $sub == '..' ) {
	    		continue;
	  		} else if( !is_dir( $sub ) ) {
	  			if ($this->pic_model->release($copyFilePath, $status) && rename($sub,$copyFilePath) ) {
	  				$data['url']     = base_url();
			     	$data['message'] = "图片发布成功，请等待管理员审核。";
			      	$data['where']   = "首页"; 
	  			} else {
	  			  	$data['url']     = base_url('upload');
			     	$data['message'] = "图片发布失败。";
			      	$data['where']   = "图片上传页面";   	
	  			}
			}
		}
		$this->load->view('default/xi_message.php',$data);
		$this->load->view('default/xi_copy.php');
        $this->load->view('default/xi_footer.php');
	}

	public function image() {
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    		exit;
		}
		if ( !empty($_REQUEST[ 'debug' ]) ) {
		    $random = rand(0, intval($_REQUEST[ 'debug' ]) );
		    if ( $random === 0 ) {
		        header("HTTP/1.0 500 Internal Server Error");
		        exit;
		    }
		}
		@set_time_limit(5 * 60);
		usleep(5000);
		$targetDir = 'upload/tmp';
		$uploadDir = 'upload/xixi';
		$cleanupTargetDir = true;
		$maxFileAge = 5 * 3600;
		if (!file_exists($targetDir)) {
		    @mkdir($targetDir);
		}
		if (!file_exists($uploadDir)) {
		    @mkdir($uploadDir);
		}
		if (isset($_REQUEST["name"])) {
		    $fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
		    $fileName = $_FILES["file"]["name"];
		} else {
		    $fileName = uniqid("file_");
		}
		$md5File = @file('md5list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$md5File = $md5File ? $md5File : array();
		if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
		    die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
		}
		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
		$uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
		if ($cleanupTargetDir) {
		    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
		    }
		    while (($file = readdir($dir)) !== false) {
		        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		        if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
		            continue;
		        }
		        if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
		            @unlink($tmpfilePath);
		        }
		    }
		    closedir($dir);
		}

		if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
		    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		if (!empty($_FILES)) {
		    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		    }
		    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		    }
		} else {
		    if (!$in = @fopen("php://input", "rb")) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		    }
		}
		while ($buff = fread($in, 4096)) {
		    fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);
		rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
		$index = 0;
		$done = true;
		for( $index = 0; $index < $chunks; $index++ ) {
		    if ( !file_exists("{$filePath}_{$index}.part") ) {
		        $done = false;
		        break;
		    }
		}
		if ( $done ) {
		    if (!$out = @fopen($uploadPath, "wb")) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		    }
		    if ( flock($out, LOCK_EX) ) {
		        for( $index = 0; $index < $chunks; $index++ ) {
		            if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
		                break;
		            }
		            while ($buff = fread($in, 4096)) {
		                fwrite($out, $buff);
		            }
		            @fclose($in);
		            @unlink("{$filePath}_{$index}.part");
		        }
		        flock($out, LOCK_UN);
		    }
		    @fclose($out);
		}
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */