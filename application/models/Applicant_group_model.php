<?php
class Applicant_group_model extends CI_model {
  public $no_reg;
  public $name;
  public $registered_date;
  public $address;
  public $part_of;
  public $activity;
  public $membership;
  public $membership_list;

  public $applicant_id;

  public function __construct(){
    $this->load->database();
  }

  public function insert($record){
    return $this->db->insert('applicant_group', $record);
  }

  public function find_by_applicant_id($applicant_id){
    $query = $this->db->get_where('applicant_group', array('applicant_id' => $applicant_id));
    return $query->num_rows() > 0 ? $query->row() : null;
  }

  public function get_part_ofes(){
    return array(
      'Kesbangpol',
      'Setda'
    );
  }

  public function get_activities(){
    return array(
      'Perekonomian',
      'Pendidikan',
      'Kesehatan',
      'Agama',
      'Kesenian, Adat dan Olahraga',
      'Non-Profesional'
    );
  }
}

