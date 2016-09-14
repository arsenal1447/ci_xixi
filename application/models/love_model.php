<?php
class Love_model extends CI_Model {
  private $pagenum = 15;

	public function __construct() {
    	$this->load->database();
  	}
	//SELECT
  public function is_love($uuid,$username) {
    $query = $this->db->get_where('xi_love',array('love_pic' => $uuid,'love_user' => $username));
    return $query->num_rows();
  }

  public function pic_love($uuid) {
    $query = $this->db->get_where('xi_love',array('love_pic' => $uuid));
    return $query->num_rows();
  }

  public function user_love($user,$page) {
    $query = $this->db->get_where('xi_love',array('love_user' => $user),$this->pagenum,$this->pagenum*($page-1));
    return $query->result_array();
  }
	//INSERT
  public function add_love($uuid,$username) {
    $date = date("Y-m-d H:i:s");
    $love = array(
      'love_pic'      => $uuid, 
      'love_user'     => $username,
      'love_datetime' => $date
    );

    $query = $this->db->insert('xi_love',$love);
    return $query;
  }
	//UPDATE
	//DELETE
  public function remove_love($uuid,$username) {
    $this->db->where('love_pic',$uuid);
    $this->db->where('love_user',$username);
    $query=$this->db->delete('xi_love'); 
    return $query; 
  }
}
?>