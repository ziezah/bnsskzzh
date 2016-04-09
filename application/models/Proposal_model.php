<?php
class Proposal_model extends CI_model {
  public $title;
  public $purpose;
  public $needed_amount;
  public $needs;
  public $pic;

  // belongs to applicant
  public $applicant_id;

  public function __construct(){
    $this->load->database();
  }

  public function insert($record){
    return $this->db->insert('applicant_group', $record);
  }
}

