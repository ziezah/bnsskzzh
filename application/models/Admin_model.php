<?php
class Admin_model extends CI_model {
  public $id;

  public $name;
  public $password;

  public function __construct(){
    $this->load->database();
  }
}

