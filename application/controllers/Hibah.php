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
      $this->load->view('group/new');
    } else {
      $data['positions'] = $this->applicant_model->get_applicant_positions();
      $this->load->view('applicant/new', $data);
    }
  }

  public function new_group(){
    $this->load->view('group/new');
  }

  public function create_group(){
  }

  public function new_proposal(){
    $this->load->view('proposal/new');
  }

  public function create_proposal(){
  }

  private function init_lib_and_helper(){
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  private function init_model(){
    $this->load->model('applicant_model');
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

  private function set_error_messages(){
    $this->form_validation->set_message('required', "{field} wajib diisi");
    $this->form_validation->set_message('integer', "{field} hanya boleh diisi dengan angka");
    $this->form_validation->set_message('is_unique', "{field} sudah pernah diinput");
  }
}
