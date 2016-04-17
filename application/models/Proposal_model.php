<?php
class Proposal_model extends CI_model {
  public $title;
  public $purpose;
  public $needed_amount;
  public $file_link;
  public $pic;
  public $approved; 
  public $processed_by; // admin id who processed this proposal to approved or rejected

  // belongs to applicant
  public $applicant_id;

  public function __construct(){
    $this->load->database();
  }

  public function insert($record){
    return $this->db->insert('proposal', $record);
  }

  public function find_by_applicant_id($applicant_id){
    $query = $this->db->get_where('proposal', array('applicant_id' => $applicant_id));
    return $query->num_rows() > 0 ? $query->row() : null;
  }
}

