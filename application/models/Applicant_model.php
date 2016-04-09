<?php
class Applicant_model extends CI_model {
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
    $this->db->insert('applicant', $record);
    return $this->db->insert_id();
  }

  public function find($id){
    $query = $this->db->get_where('applicant', array('id' => $id));
    return $query->row();
  }

  public function get_applicant_positions(){
    return array(
      'Ketua',
      'Wakil Ketua',
      'Sekretaris',
      'Bendahara',
      'Anggota',
      'Lain-lain'
    );
  }
}
