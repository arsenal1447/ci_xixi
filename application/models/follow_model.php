<?php
class Follow_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT
  public function follow($username,$page) {  //粉丝
    $query = $this->db->get_where('xi_follow', array('follow_to' => $username),20,20*($page-1));
    return $query->result_array();
  }

  public function follow_to($username) {  //粉丝数
    $query = $this->db->get_where('xi_follow', array('follow_to' => $username));
    return $query->num_rows();
  }

  public function atten($username,$page) {  //关注
    $query = $this->db->get_where('xi_follow', array('follow_form' => $username),20,20*($page-1));
    return $query->result_array();
  }

  public function follow_form($username) { //关注数
    $query = $this->db->get_where('xi_follow', array('follow_form' => $username));
    return $query->num_rows();
  }

  public function is_follow($to,$form) { //是否关注
    $query = $this->db->get_where('xi_follow', array('follow_form' => $form, 'follow_to' => $to));
    return $query->num_rows();
  }
  //INSERT
  public function add_follow($to,$form) {
    $date   = date("Y-m-d H:i:s");
    $follow = array(
      'follow_to'       => $to, 
      'follow_form'     => $form,
      'follow_datetime' => $date
    );

    $query = $this->db->insert('xi_follow',$follow);
    return $query;
  }
  //UPDATE
  //DELETE
  public function remove_follow($to,$form) {
    $this->db->delete('xi_follow', array('follow_form' => $form, 'follow_to' => $to)); 
  }
}
?>