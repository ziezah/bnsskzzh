<?php
class Applicant_cookie_model extends CI_model {
  public $cookie_id;
  public $applicant_id;

  public function create_cookie_id($applicant_id){
    $this->load->helper('string');
    $cookie_id = random_string('alnum', 8);

    while ($this->cookie_id_exist($cookie_id)){
      $cookie_id = random_string('alnum', 8);
    }

    $record['cookie_id'] = $cookie_id;
    $record['applicant_id'] = $applicant_id;

    $this->db->insert('applicant_cookie', $record);
    return $cookie_id;
  }

  public function cookie_id_exist($cookie_id){
    $query = $this->db->get_where('applicant_cookie', array('cookie_id' => $cookie_id));
    return $query->num_rows() > 0 ? true : false;
  }

  public function get_applicant_id($cookie_id){
    $this->db->select('applicant_id');
    $query = $this->db->get_where('applicant_cookie', array('cookie_id' => $cookie_id));
    return $query->num_rows() > 0 ? $query->row()->applicant_id : null;
  }
}
