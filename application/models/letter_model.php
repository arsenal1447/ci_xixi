<?php
class Letter_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT
  public function letter($username,$page) { //私信
    $this->db->order_by("letter_status", "asc");
    $this->db->order_by("letter_datetime", "desc");
    $query = $this->db->get_where('xi_letter', array('letter_to' => $username, 'letter_type' => 0),20,20*($page-1));
    return $query->result_array();
  }

  public function commnet($username,$page) { //评论
    $this->db->order_by("letter_status", "asc");
    $this->db->order_by("letter_datetime", "desc");
    $query = $this->db->get_where('xi_letter', array('letter_to' => $username, 'letter_type' => 2),20,20*($page-1));
    return $query->result_array();
  }

  public function notice($username,$page) { //通知
    $this->db->order_by("letter_status", "asc");
    $this->db->order_by("letter_datetime", "desc");
    $query = $this->db->get_where('xi_letter', array('letter_to' => $username, 'letter_type' => 1),20,20*($page-1));
    return $query->result_array();
  }

  public function is_letter( $id ) {  //查看记录是否存在
    $query = $this->db->get_where('xi_letter',array('ID' => $id));
    return $query->num_rows();
  }
  //INSERT
  public function send_letter($user,$name,$text) {
    $date   = date("Y-m-d H:i:s");
    $letter = array(
      'letter_form'     => $name, 
      'letter_to'       => $user,
      'letter_text'     => $text,
      'letter_type'     => 0,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    $query = $this->db->insert('xi_letter',$letter);
    return $query;
  }

  public function add_commnet($username,$uuid){
    $date    = date("Y-m-d H:i:s");
    $text    = "你的图片有了一条新的评论。<a href='" . base_url('view/' . $uuid) . "'>查看</a>";
    $commnet = array(
      'letter_form'     => "系统", 
      'letter_to'       => $username,
      'letter_text'     => $text,
      'letter_type'     => 2,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    $query = $this->db->insert('xi_letter',$commnet);
    return $query;
  }

  public function add_notice($username,$text){
    $date    = date("Y-m-d H:i:s");
    $notice  = array(
      'letter_form'     => "系统", 
      'letter_to'       => $username,
      'letter_text'     => $text,
      'letter_type'     => 1,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    $query = $this->db->insert('xi_letter',$notice);
    return $query;
  }
  //UPDATE
  //DELETE
    public function delete( $id ) {   //删除图片记录
      $this->db->delete('xi_letter', array('ID' => $id)); 
    }
}
?>