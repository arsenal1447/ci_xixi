<?php
class System_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
	//SELECT
    public function get_webtitle() {
      $query = $this->db->get_where('xi_systeminfo',array('sys_title' => 'webtitle'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

        public function get_keywords() {
      $query = $this->db->get_where('xi_systeminfo',array('sys_title' => 'keywords'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

        public function get_description() {
      $query = $this->db->get_where('xi_systeminfo',array('sys_title' => 'description'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }
	//INSERT
	//UPDATE
    public function set_webtitle() {
      $info = array( 'sys_value' => $this->input->post('webtitle') );  
      $this->db->where('sys_title','webtitle'); 
      $this->db->update('xi_systeminfo', $info); 
    }

    public function set_keywords() {
      $info = array( 'sys_value' => $this->input->post('keywords') );  
      $this->db->where('sys_title','keywords'); 
      $this->db->update('xi_systeminfo', $info); 
    }

    public function set_description() {
      $info = array( 'sys_value' => $this->input->post('description') );  
      $this->db->where('sys_title','description'); 
      $this->db->update('xi_systeminfo', $info); 
    }
	//DELETE
}
?>