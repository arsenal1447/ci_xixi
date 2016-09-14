<?php
class User_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
  	//SELECT
  	public function users($page) {
  		$query = $this->db->get('xi_users',10,10*($page-1));
      return $query->result_array();
  	}

    public function login() {  //用户登录
      $this->db->where('user_login',$this->input->post('username'));
      $this->db->where('user_pass',md5($this->input->post('password')));
      $query = $this->db->get('xi_users');

      return $query->num_rows();
    }

    public function email() {  //邮箱是否存在
      $query = $this->db->get_where('xi_users',array('user_email' => $this->input->post('email')));
      return $query->num_rows();
    }

    public function password() {  //根据邮箱返回密码
      $query = $this->db->get_where('xi_users',array('user_email' => $this->input->post('email')));
      foreach ($query->result_array() as $value) {
        return $value['user_pass'];
      }
    }

    public function is_admin($username) {   //是否是管理员
      $query = $this->db->get_where('xi_users',array('user_login' => $username,'user_status' => 1));
      return $query->num_rows();
    }

    public function is_user($username) {   //会员是否存在
      $query = $this->db->get_where('xi_users',array('user_login' => $username));
      return $query->num_rows();
    }

    public function usernum() {
      $query = $this->db->get('xi_users');
      return $query->num_rows();
    }

    public function picture($username) {
      $query = $this->db->get_where('xi_users',array('user_login' => $username));
      foreach ($query->result_array() as $value) {
        return $value['user_picture'];
      }
    }
  	//INSERT
  	public function register() { //用户注册
  		$now  = date("Y-m-d H:i:s");
	    $user = array(
	      'user_login' => $this->input->post('username'), 
	      'user_pass'  => $this->input->post('password'),
	      'user_email' => $this->input->post('email'),
        'user_nicename' => $this->input->post('nicename'),
        'user_mobile' => $this->input->post('mobile'),
	      'user_register' => $now
	    );

	    $db = $this->db->insert('xi_users',$user);
	    return $db;
  	}
  	//UPDATE
    public function add_picture($username,$picture) {
      $this->db->where('user_login', $username);
      $this->db->update('xi_users', array('user_picture' => $picture));
    }
  	//DELETE
    public function delete( $id ) {  
      $this->db->delete('xi_users', array('ID' => $id)); 
    }

    public function createRandomCode($length)
    {
      $randomCode = "";
      $randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      for ($i = 0; $i < $length; $i++)
      {
        $randomCode .= $randomChars { mt_rand(0, 35) };
      }
      return $randomCode;
    }
}
?>