<?php
class Bansos_model extends CI_model {
  // belongs to applicant
  public $applicant_id;

  public function __construct(){
    $this->load->database();
  }
}

