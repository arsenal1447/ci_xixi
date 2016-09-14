<?php
class Message_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
	//SELECT
  public function pic_message($uuid) {
    $this->db->order_by("msg_datetime", "desc"); 
    $query = $this->db->get_where('xi_messages',array('msg_pic' => $uuid));
    return $query->result_array();
  }

	//INSERT
  public function message($user) { //新增留言
    $now  = date("Y-m-d H:i:s");
    $message = array(
      'msg_text'     => $this->input->post('message'), 
      'msg_pic'    => $this->input->post('view'),
      'msg_user'     => $user,
      'msg_datetime' => $now
    );

    $db = $this->db->insert('xi_messages',$message);
    return $db;
  }
	//UPDATE
	//DELETE
}
?>