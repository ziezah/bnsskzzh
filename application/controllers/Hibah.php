<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hibah extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->output->enable_profiler(TRUE);

    $this->init_lib_and_helper();
    $this->init_model();
    $this->set_error_messages();
  }

  public function index(){
    # TODO: Front Page of Hibah?
    $this->new_record();
  }

  public function new_record(){
    switch($this->get_applicant_status()){
    case 'completely_new':
      redirect('/hibah/new_applicant');
      break;
    case 'applicant_created':
      redirect('/hibah/new_group');
      break;
    case 'group_created':
      redirect('/hibah/new_proposal');
      break;
    default:
      redirect('/hibah/new_proposal');
    }
  }

  public function new_applicant(){
    if($this->get_applicant_status() !== 'completely_new'){
      $this->new_record();
    }

    $data = $this->prepare_new_applicant();
    $this->load->view('applicant/new', $data);
  }

  public function create_applicant(){
    if($this->get_applicant_status() !== 'completely_new'){
      $this->new_record();
    }

    $this->applicant_form_validation();
    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->applicant_model) as $k => $_){
        if ($k == "birth_day"){
           $temp_date = $this->input->post("applicant[$k][year]");
           $temp_date = $temp_date.$this->input->post("applicant[$k][month]");
           $temp_date = $temp_date.$this->input->post("applicant[$k][date]");
           $record[$k] = $temp_date;
        } else {
          $record[$k] = $this->input->post("applicant[$k]");
        }
      }

      $applicant_id = $this->applicant_model->insert($record);
      $random_number = $this->applicant_cookie_model->create_cookie_id($applicant_id);
      $this->session->set_userdata('app_cookie_id', $random_number);

      redirect('/hibah/new_group');
    } else {
      $data = $this->prepare_new_applicant();
      $this->load->view('applicant/new', $data);
    }
  }

  public function new_group(){
    if($this->get_applicant_status() !== 'applicant_created'){
      $this->new_record();
    }

    $data = $this->prepare_new_group();
    $this->load->view('group/new', $data);
  }

  public function create_group(){
    if($this->get_applicant_status() !== 'applicant_created'){
      $this->new_record();
    }
    $this->group_form_validation();

    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->group_model) as $k => $_){
        if ($k == "registered_date"){
           $temp_date = $this->input->post("group[$k][year]");
           $temp_date = $temp_date.$this->input->post("group[$k][month]");
           $temp_date = $temp_date.$this->input->post("group[$k][date]");
           $record[$k] = $temp_date;
        } else {
          $record[$k] = $this->input->post("group[$k]");
        }
        // TODO: Dynamic membership list, encode to json
      }
      $record['applicant_id'] = $this->applicant_cookie_model->get_applicant_id($this->session->userdata('app_cookie_id'));
      $this->group_model->insert($record);
      redirect('/hibah/new_proposal');
    } else {
      $data = $this->prepare_new_group();
      $this->load->view('group/new', $data);
    }
  }

  public function new_proposal(){
    if($this->get_applicant_status() !== 'group_created'){
      $this->new_record();
    }

    $data = $this->prepare_new_proposal();
    $this->load->view('proposal/new', $data);
  }

  public function create_proposal(){
    if($this->get_applicant_status() !== 'group_created'){
      $this->new_record();
    }

    $this->proposal_form_validation();

    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->group_model) as $k => $_){
        $record[$k] = $this->input->post("group[$k]");

        // TODO: Dynamic needs list, encode to json
      }
      $record['applicant_id'] = $this->applicant_cookie_model->get_applicant_id($this->session->userdata('app_cookie_id'));
      $this->proposal_model->insert($record);
      redirect('/hibah/registration_success');
    } else {
      $data = $this->prepare_new_proposal();
      $this->load->view('proposal/new', $data);
    }
  }

  private function init_lib_and_helper(){
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  private function init_model(){
    $this->load->model('applicant_cookie_model');

    $this->load->model('applicant_model');
    $this->load->model('applicant_group_model', 'group_model');
    $this->load->model('proposal_model');
  }

  private function applicant_form_validation(){
    $this->form_validation->set_rules('applicant[nik]', 'NIK', 'required|integer|is_unique[applicant.nik]');
    $this->form_validation->set_rules('applicant[name]', 'Nama', 'required');
    $this->form_validation->set_rules('applicant[job]', 'Pekerjaan', 'required');
    $this->form_validation->set_rules('applicant[birth_place]', 'Tempat Lahir', 'required');
    $this->form_validation->set_rules('applicant[birth_day][year]', 'Tahun Lahir', 'required|integer');
    $this->form_validation->set_rules('applicant[birth_day][month]', 'Bulan Lahir', 'required|integer');
    $this->form_validation->set_rules('applicant[birth_day][date]', 'Tanggal Lahir', 'required|integer');
    $this->form_validation->set_rules('applicant[address]', 'Alamat', 'required');
    $this->form_validation->set_rules('applicant[position]', 'Jabatan di Organisasi', 'required');
  }

  private function group_form_validation(){
    $this->form_validation->set_rules('group[no_reg]', 'No. Registrasi', 'required|integer|is_unique[applicant_group.no_reg]');
    $this->form_validation->set_rules('group[name]', 'Nama Kelompok', 'required');
    $this->form_validation->set_rules('group[registered_date][year]', 'Tahun Terdaftar Kelompok', 'required');
    $this->form_validation->set_rules('group[registered_date][month]', 'Bulan Terdaftar Kelompok', 'required');
    $this->form_validation->set_rules('group[registered_date][date]', 'Tanggal Terdaftar Kelompok', 'required');
    $this->form_validation->set_rules('group[address]', 'Alamat Kantor', 'required');
    $this->form_validation->set_rules('group[part_of]', 'Bagian Grup', 'required');
    $this->form_validation->set_rules('group[activity]', 'Kegiatan', 'required');
    $this->form_validation->set_rules('group[membership]', 'Jumlah Anggota', 'required|integer');

    //TODO: Dynamic membership_list, with array
    $this->form_validation->set_rules('group[membership_list]', 'Daftar Anggota', 'required');
  }

  private function proposal_form_validation(){
    $this->form_validation->set_rules('proposal[purpose]', 'Tujuan penggunaan hibah', 'required');
    $this->form_validation->set_rules('proposal[needed_amount]', 'Jumlah yang dibutuhkan', 'required|integer');

    # TODO: Dynamic needed list
    # TODO: sum of needed list must equal needed amount
    $this->form_validation->set_rules('proposal[needs][0]', 'List Semua Kebutuhan', 'required');

    $this->form_validation->set_rules('proposal[pic]', 'Penanggung Jawab Proposal', 'required');
    $this->form_validation->set_rules('proposal[aggreement]', 'Pernyataan', 'callback_agreed_tnc');
  }

  private function set_error_messages(){
    $this->form_validation->set_message('required', "{field} wajib diisi");
    $this->form_validation->set_message('integer', "{field} hanya boleh diisi dengan angka");
    $this->form_validation->set_message('is_unique', "{field} sudah pernah diinput");
  }

  public function agreed_tnc($str){
    if($str == 1){
      return TRUE;
    } else {
      $this->form_validation->set_message('agreed_tnc', "Untuk melanjutkan anda harus menyetujui {field}");
      return FALSE;
    }
  }

  private function get_applicant_from_session_id(){
    $cookie_id = $this->session->userdata('app_cookie_id');
    $applicant_id = $this->applicant_cookie_model->get_applicant_id($cookie_id);
    return $this->applicant_model->find($applicant_id);
  }

  private function get_applicant_status(){
     $applicant = $this->get_applicant_from_session_id();
     if(empty($applicant)){
       return 'completely_new';
     } else {
       $group = $this->group_model->find_by_applicant_id($applicant->id);
       if(empty($group)){
         return 'applicant_created';
       } else {
         $proposal = $this->proposal_model->find_by_applicant_id($applicant->id);
         if(empty($proposal)){
           return 'group_created';
         } else {
           return 'proposal_created';
         }
       }
     }
  }

  private function prepare_new_applicant(){
    $data['positions'] = $this->applicant_model->get_applicant_positions();
    return $data;
  }

  private function prepare_new_group(){
    $data['applicant'] = $this->get_applicant_from_session_id();
    $data['part_ofes'] = $this->group_model->get_part_ofes();
    $data['activities'] = $this->group_model->get_activities();
    return $data;
  }

  private function prepare_new_proposal(){
    $data['applicant'] = $this->get_applicant_from_session_id();
    $data['group'] = $this->group_model->find_by_applicant_id($data['applicant']->id);
    return $data;
  }
}
