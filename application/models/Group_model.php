<?php
class Group_model extends CI_model {
  public $id;

  public $no_reg;
  public $name;
  public $registered_date;
  public $address;
  public $part_of;
  public $membership;
  public $membership_list;

  public function __construct(){
    $this->load->database();
  }
}

