<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hibah extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('applicant_model');

    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->output->enable_profiler(TRUE);
  }

  public function new_record(){
    $this->new_applicant();
  }

  public function new_applicant(){
    $this->load->view('applicant/new');
  }

  public function create_applicant(){
    $this->form_validation->set_rules('applicant[nik]', 'NIK', 'required');

    if($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->applicant_model) as $k => $_){
        $record[$k] = $this->input->post($k);
      }

      $this->applicant_model->insert($record);
      $this->load->view('group/new');
    } else {
      $this->load->view('applicant/new');
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
}
