<?php
class News_model extends CI_model {
  public function __construct(){
    $this->load->database();
  }

  public function get_news($slug = false){
    if($slug === false){
      $query = $this->db->get('news');
      return $query->result_array();
    }
    else{
      echo $slug;
      $query = $this->db->get_where('news', array('slug' => $slug));
      return $query->row_array();
    }
  }
}
