<?php
class Like_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT
  public function is_like($uuid,$ip) {
    $query = $this->db->get_where('xi_like',array('like_pic' => $uuid,'like_ip' => $ip));
    return $query->num_rows();
  }

  public function pic_like($uuid) {
    $query = $this->db->get_where('xi_like',array('like_pic' => $uuid));
    return $query->num_rows();
  }
  //INSERT
  public function add_like($uuid,$ip) {
    $date = date("Y-m-d H:i:s");
    $like = array(
      'like_pic'      => $uuid, 
      'like_ip'       => $ip,
      'like_datetime' => $date
    );

    $query = $this->db->insert('xi_like',$like);
    return $query;
  }
  //UPDATE
  //DELETE
  public function remove_like($uuid,$ip) {
    $this->db->where('like_pic',$uuid);
    $this->db->where('like_ip',$ip);
    $query=$this->db->delete('xi_like'); 
    return $query; 
  }
}
?>