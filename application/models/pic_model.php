<?php
class Pic_model extends CI_Model {
  private $pagenum = 15;
  
	public function __construct() {
    	$this->load->database();
      $this->load->model('tags_model');

  	}
    
    public function pictures( $page ) {  //按照添加日期返回所有图像记录
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function hot( $page ) {  //按照 赞 的数量返回所有图像记录
      $this->db->order_by("pic_like", "desc");
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function is_view( $uuid ) {  //查看某条记录是否存在
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid,'pic_status' => 1));
      return $query->num_rows();
    }

    public function one( $uuid ) {  //返回一条记录的信息
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      return $query->result_array();
    }

    public function max_id() {  //返回最大的ID
      $this->db->order_by("ID", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1),1);
      foreach ($query->result_array() as $value) {
        return $value['ID'];
      }
    }

    public function guuid($id) {   //根据记录的ID返回uuid
      $query = $this->db->get_where('xi_picture',array('ID' => $id));
      foreach ($query->result_array() as $value) {
        return $value['pic_uuid'];
      }
    }

    public function search($search,$page) {
      $this->db->like('pic_name', $search);
      $this->db->or_like('pic_text', $search);
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function catalogue( $catalogue,$page,$arraySon ) {  //根据类型返回记录信息
      $this->db->where('pic_status', 1);
      $this->db->where('pic_type', $catalogue);

      $count = count($arraySon);

      for ($i = 0; $i < $count; $i++) { 
        $this->db->or_where('pic_type', $arraySon[$i]);
      }
      $this->db->order_by("pic_datetime", "desc");
      $query = $this->db->get('xi_picture',$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function tag($tag,$page) {  //根据标签返回记录信息
      $this->db->like('pic_tag', $tag);
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function alltag($tag) {  //根据标签返回记录信息
      $sql   = "SELECT * FROM xi_picture WHERE pic_tag LIKE ? AND pic_status = ? ORDER BY RAND() LIMIT 3"; 
      $query = $this->db->query($sql, array('%'. $tag . '%',1));
      return $query->result_array();
    }

    public function check($page) {  //返回所有未审核的记录
      $this->db->order_by("ID", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 0),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function checknum() {
      $query = $this->db->get_where('xi_picture', array('pic_status' => 0));
      return $query->num_rows();
    }

    public function picturenum() {
      $query = $this->db->get_where('xi_picture', array('pic_status' => 1));
      return $query->num_rows();
    }

    public function todayhot() {
      $today       = date("Y-m-d");
      $today_start = $today . " 00:00:00";
      $today_end   = $today . " 23:59:59";
      $sql   = "SELECT * FROM xi_picture WHERE pic_datetime BETWEEN ? AND  ? AND pic_status = ? LIMIT 0,3"; 
      $query = $this->db->query($sql, array($today_start,$today_end,1));
      return $query->result_array();
    }

    public function todayhot2() {
      $today       = date("Y-m-d");
      $today_start = $today . " 00:00:00";
      $today_end   = $today . " 23:59:59";
      $sql   = "SELECT * FROM xi_picture WHERE pic_datetime BETWEEN ? AND  ? AND pic_status = ? LIMIT 3,3"; 
      $query = $this->db->query($sql, array($today_start,$today_end,1));
      return $query->result_array();
    }

    public function random() {  //随机返回3条记录
      $sql   = "SELECT * FROM xi_picture WHERE pic_status = 1 ORDER BY RAND() LIMIT 3"; 
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function user( $user, $page ) {  //按照添加日期返回$user的所有图像记录
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1, 'pic_user' => $user),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function collect( $user, $page ) {  
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('xi_picture',array('pic_status' => 1, 'pic_user' => $user),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

  	//INSERT
  	public function release( $picurl, $status ) { //插入一条图片记录
  		$now  = date("Y-m-d H:i:s");
      $uuid = sha1($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . time() . rand());
      $tags = $this->input->post('pictag');
      if ($this->input->post('tags') != "") {
        foreach ($this->input->post('tags') as $key => $value) {
          if (!strpos($tags,$value)) {
            $tags = $tags . " " . $value;
          }
        }
      }

      $username = $this->session->userdata('Username');

	    $pic = array(
        'pic_uuid' => $uuid,
	      'pic_url' => $picurl,
        'pic_name' => $this->input->post('picname'),
        'pic_type' => $this->input->post('pictype'),
        'pic_text' => $this->input->post('pictext'),
        'pic_user' => $username,
        'pic_tag' => trim($tags),
        'pic_status' => $status,
	      'pic_datetime' => $now
	    );
	    $db = $this->db->insert('xi_picture',$pic);

      //更新标签的次数
      $tag  = explode (" ", $tags);
      for ($i = 0; $i < count($tag); $i++) {
        if ($this->tags_model->is_tag($tag[$i])) {
          $this->tags_model->addamount($tag[$i]);
        } else {
          if ($tag[$i] != "") {
            $this->tags_model->addtag($tag[$i]);
          }
        }
      }

	    return $db;
  	}
  	//UPDATE
    public function addview( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $view = $value['pic_view'];
      }

      $view++;

      $data = array( 'pic_view' => $view );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('xi_picture', $data); 

      return $view;
    }


    public function addlike( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $like = $value['pic_like'];
      }

      $like++;

      $data = array( 'pic_like' => $like );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('xi_picture', $data); 

      return $like;
    }

    public function removelike( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $like = $value['pic_like'];
      }

      if ($like>0) {
         $like--;
      }

      $data = array( 'pic_like' => $like );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('xi_picture', $data); 

      return $like;
    }


    public function addlove( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $love = $value['pic_collect'];
      }

      $love++;

      $data = array( 'pic_collect' => $love );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('xi_picture', $data); 

      return $love;
    }

    public function removelove( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $love = $value['pic_collect'];
      }

      if ($love>0) {
         $love--;
      }
      
      $data = array( 'pic_collect' => $love );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('xi_picture', $data); 

      return $love;
    }


    public function pass( $uuid ) {   //审核通过
      $this->db->where('pic_uuid', $uuid);
      $this->db->update('xi_picture', array('pic_status' => 1)); 
    }

    public function reject( $uuid ) {   //审核未通过
      $this->db->where('pic_uuid', $uuid);
      $this->db->update('xi_picture', array('pic_status' => 2)); 
    }
  	//DELETE
    public function delete( $uuid ) {   //删除图片记录
      $this->db->delete('xi_picture', array('pic_uuid' => $uuid)); 
    }

}
?>