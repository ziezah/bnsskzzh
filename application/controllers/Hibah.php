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
    redirect('/hibah/new_applicant');
  }

  public function new_record(){
    $this->new_applicant();
  }

  public function new_applicant(){
    $data['positions'] = $this->applicant_model->get_applicant_positions();
    $this->load->view('applicant/new', $data);
  }

  public function create_applicant(){
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

      $this->applicant_model->insert($record);
      redirect('/hibah/new_group');
    } else {
      $data['positions'] = $this->applicant_model->get_applicant_positions();
      $this->load->view('applicant/new', $data);
    }
  }

  public function new_group(){
    $data['part_ofes'] = $this->group_model->get_part_ofes();
    $data['activities'] = $this->group_model->get_activities();
    $this->load->view('group/new', $data);
  }

  public function create_group(){
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
      $this->group_model->insert($record);
      redirect('/hibah/new_proposal');
    } else {
      $data['part_ofes'] = $this->group_model->get_part_ofes();
      $data['activities'] = $this->group_model->get_activities();
      $this->load->view('group/new', $data);
    }
  }

  public function new_proposal(){
    $this->load->view('proposal/new');
  }

  public function create_proposal(){
    $this->proposal_form_validation();

    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->group_model) as $k => $_){
        $record[$k] = $this->input->post("group[$k]");

        // TODO: Dynamic needs list, encode to json
      }
      $this->proposal_model->insert($record);
      redirect('/hibah/registration_success');
    } else {
      $this->load->view('proposal/new');
    }
  }

  private function init_lib_and_helper(){
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  private function init_model(){
    $this->load->model('applicant_model');
    $this->load->model('applicant_group_model', 'group_model');
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
}
