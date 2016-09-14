<?php
class Catalogue_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
  	//SELECT
  	public function catalogue() { //返回分类记录
  		//$query = $this->db->get_where('xi_catalogue', array('cat_father' => "顶级"));
      $query = $this->db->get('xi_catalogue');
      return $query->result_array();
  	}

    public function cat_all() { //返回所以分类记录
      $query = $this->db->get('xi_catalogue');
      return $query->result_array();
    }

    public function max_id() {  //返回最大的ID
      $this->db->order_by("ID", "desc");
      $query = $this->db->get('xi_catalogue',1);
      foreach ($query->result_array() as $value) {
        return $value['ID'];
      }
    }

    public function have_son($name) {
      $query = $this->db->get_where('xi_catalogue', array('cat_father' => $name));
      return $query->num_rows();
    }

    public function cat_name($name) { //返回分类记录
      $query = $this->db->get_where('xi_catalogue', array('cat_father' => $name));
      return $query->result_array();
    }

    public function name_by_another($another_name) {
      $query = $this->db->get_where('xi_catalogue', array('cat_another_name' => $another_name));
      foreach ($query->result_array() as $value) {
        return $value['cat_name'];
      }
    }

    public function is_father($another_name) {
      $query = $this->db->get_where('xi_catalogue', array('cat_another_name' => $another_name));
      foreach ($query->result_array() as $value) {
        if($value['cat_father'] == "顶级") {
          return 1;
        } else {
          return 0;
        }
      }
    }

    public function my_father($another_name) {
      $query = $this->db->get_where('xi_catalogue', array('cat_another_name' => $another_name));
      foreach ($query->result_array() as $value) {
        return $value['cat_father'];
      }

    }
  	//INSERT
    public function add_type() {
      $catalogue = array(
        'cat_name' => $this->input->post('name'), 
        'cat_another_name'  => $this->input->post('another')
        //'cat_icon' => $this->input->post('icon'),
        //'cat_father' => $this->input->post('father')
      );

      $db = $this->db->insert('xi_catalogue',$catalogue);
      return $db;
    }
  	//UPDATE
  	//DELETE
    public function delete( $id ) {  
      $this->db->delete('xi_catalogue', array('ID' => $id)); 
    }
}
?>