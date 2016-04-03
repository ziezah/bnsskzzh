<?php
class Applicant_model extends CI_model {
  public $id;

  public $nik;
  public $name;
  public $job;
  public $birth_place;
  public $birth_day;
  public $address;
  public $position;

  // belongs to group
  public $group_id;

  // generated after all valid
  public $username;
  public $password;

  public function __construct(){
    $this->load->database();
  }

  public function insert($record){
    return $this->db->insert('applicant', $record);
  }
}
