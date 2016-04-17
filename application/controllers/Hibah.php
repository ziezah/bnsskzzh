<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hibah extends CI_Controller {
  public function __construct(){
    parent::__construct();
    // $this->output->enable_profiler(TRUE);

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
      $this->new_applicant();
      break;
    case 'applicant_created':
      $this->new_group();
      break;
    case 'group_created':
      $this->new_proposal();
      break;
    default:
      echo $this->get_applicant_status();
    }
  }

  private function new_applicant(){
    if($this->get_applicant_status() !== 'completely_new')
      return $this->new_record();

    $data = $this->prepare_new_applicant();
    $this->load->view('applicant/new', $data);
  }

  public function create_applicant(){
    if($this->get_applicant_status() !== 'completely_new')
      return $this->new_record();

    $this->applicant_form_validation();
    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->applicant_model) as $k => $_)
        $record[$k] = $this->input->post("applicant[$k]");

      $this->session->set_userdata('applicant', $record);
      redirect('hibah/new_record');
    } else {
      $data = $this->prepare_new_applicant();
      $this->load->view('applicant/new', $data);
    }
  }

  public function new_group(){
    if($this->get_applicant_status() !== 'applicant_created')
      return $this->new_record();

    $data = $this->prepare_new_group();
    $this->load->view('group/new', $data);
  }

  public function create_group(){
    if($this->get_applicant_status() !== 'applicant_created')
      return $this->new_record();

    $this->group_form_validation();

    if ($this->form_validation->run() === TRUE){
      $record = array();
      foreach(get_object_vars($this->group_model) as $k => $_)
        $record[$k] = $this->input->post("group[$k]");

      $this->session->set_userdata('group', $record);
      redirect('hibah/new_record');
    } else {
      $data = $this->prepare_new_group();
      $this->load->view('group/new', $data);
    }
  }

  private function new_proposal(){
    if($this->get_applicant_status() !== 'group_created')
      return $this->new_record();

    $data = $this->prepare_new_proposal();
    $this->load->view('proposal/new', $data);
  }

  public function create_proposal(){
    if($this->get_applicant_status() !== 'group_created')
      return $this->new_record();

    $this->proposal_form_validation();

    if ($this->form_validation->run() === TRUE){
      $record = array();

      foreach(get_object_vars($this->proposal_model) as $k => $_)
        $record[$k] = $this->input->post("proposal[$k]");

      $upload_data = $this->upload->data();
      $record['file_link'] = $upload_data['full_path'];
      $record['approved'] = PROPOSAL_UNPROCESSED;

      $this->session->set_userdata('proposal', $record);

      $this->process_new_hibah();

      $this->registration_success();
    } else {
      $data = $this->prepare_new_proposal();
      $this->load->view('proposal/new', $data);
    }
  }

  private function registration_success(){
    $this->load->view('hibah/success_page.php');
  }

  public function destroy_session(){
    $this->session->sess_destroy();
  }

/* =============== INITIALIZER =============== */

  private function init_lib_and_helper(){
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  private function init_model(){
    $this->load->model('applicant_model');
    $this->load->model('applicant_group_model', 'group_model');
    $this->load->model('proposal_model');
  }

/* =============== FORM VALIDATOR =============== */

  private function applicant_form_validation(){
    $this->form_validation->set_rules('applicant[nik]', 'NIK', 'required|integer|is_unique[applicant.nik]');
    $this->form_validation->set_rules('applicant[name]', 'Nama', 'required|min_length[3]');
    $this->form_validation->set_rules('applicant[job]', 'Pekerjaan', 'required');
    $this->form_validation->set_rules('applicant[birth_place]', 'Tempat Lahir', 'required');
    $this->form_validation->set_rules('applicant[birth_day]', 'Tanggal Lahir', 'required|callback_check_date_format');
    $this->form_validation->set_rules('applicant[address]', 'Alamat', 'required');
    $this->form_validation->set_rules('applicant[position]', 'Jabatan di Organisasi', 'required');
  }

  private function group_form_validation(){
    $this->form_validation->set_rules('group[no_reg]', 'No. Registrasi Kelompok', 'required|integer|is_unique[applicant_group.no_reg]');
    $this->form_validation->set_rules('group[name]', 'Nama Kelompok', 'required');
    $this->form_validation->set_rules('group[registered_date]', 'Tahun Terdaftar Kelompok', 'required|callback_check_date_format');
    $this->form_validation->set_rules('group[address]', 'Alamat Kantor', 'required|min_length[10]');
    $this->form_validation->set_rules('group[part_of]', 'Bagian Grup', 'required');
    $this->form_validation->set_rules('group[activity]', 'Kegiatan', 'required');
    $this->form_validation->set_rules('group[membership]', 'Jumlah Anggota', 'required|integer');
    $this->form_validation->set_rules('group[chairman_nik]', 'NIK Ketua Kelompok', 'required|integer');
    // TODO: MAKE SURE THAT chairman_nik, secretary_nik, and finance_manager_nik is different
    $this->form_validation->set_rules('group[secretary_nik]', 'NIK Sekretaris Kelompok', 'required|integer');
    $this->form_validation->set_rules('group[finance_manager_nik]', 'NIK Bendahara Kelompok', 'required|integer');
  }

  private function proposal_form_validation(){
    $this->form_validation->set_rules('proposal[purpose]', 'Tujuan penggunaan hibah', 'required');
    $this->form_validation->set_rules('proposal[needed_amount]', 'Jumlah yang dibutuhkan', 'required|integer');
    $this->form_validation->set_rules('proposal[pic]', 'Penanggung Jawab Proposal', 'required');
    $this->form_validation->set_rules('proposal[agreement]', 'Pernyataan', 'callback_agreed_tnc');
    $this->form_validation->set_rules('proposal[needs]', 'Daftar Kebutuhan', 'callback_proposal_file_check');
  }

  private function set_error_messages(){
    $this->form_validation->set_message('required', "{field} wajib diisi");
    $this->form_validation->set_message('integer', "{field} hanya boleh diisi dengan angka");
    $this->form_validation->set_message('is_unique', "{field} sudah pernah diinput");
    $this->form_validation->set_message('min_length', "{field} harus berisi minimal {param} karakter.");
  }


/* =============== CUSTOM FORM VALIDATOR CALLBACK =============== */

  function check_date_format($date){
    // TODO: NOT YET IMPLEMENTED
    return true;
  }

  function proposal_file_check($file){
    $this->form_validation->set_message('proposal_file_check', '{field} Harus Berupa file PDF');

    $file_name = $_FILES['needs']['name'];
    if (! empty($file_name)) {
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
      if($file_ext == 'pdf'){
        if($this->do_upload_needs())
          return TRUE;
        else
          $this->form_validation->set_message('proposal_file_check', 'Gagal mengupload file');
      }
    }
    return FALSE;
  }

  function agreed_tnc($str){
    if($str == 1){
      return TRUE;
    } else {
      $this->form_validation->set_message('agreed_tnc', "Untuk melanjutkan anda harus menyetujui {field}");
      return FALSE;
    }
  }

/* =============== UTILITY  =============== */

  private function process_new_hibah(){
    // IMPORTANT: This method is not handling race condition case, yet.
    $applicant = $this->session->userdata('applicant');
    $group     = $this->session->userdata('group');
    $proposal  = $this->session->userdata('proposal');

    var_dump($applicant);
    var_dump($group);
    var_dump($proposal);

    $applicant_id = $this->applicant_model->insert($applicant);

    $group['applicant_id'] = $applicant_id;
    $group_id = $this->group_model->insert($group);

    $this->applicant_model->update_group_id($applicant_id, $group_id); 

    $proposal['applicant_id'] = $applicant_id;
    $this->proposal_model->insert($proposal);

    $this->session->sess_destroy();
    $this->session->set_userdata('applicant_id', $applicant_id);
  }

  private function get_applicant_status(){
     $applicant = $this->session->userdata('applicant');
     if(empty($applicant)){
       return 'completely_new';
     } else {
       $group = $this->session->userdata('group');
       if(empty($group)){
         return 'applicant_created';
       } else {
         $proposal = $this->session->userdata('proposal');
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
    $data['applicant'] = $this->session->userdata('applicant');
    $data['part_ofes'] = $this->group_model->get_part_ofes();
    $data['activities'] = $this->group_model->get_activities();
    return $data;
  }

  private function prepare_new_proposal(){
    $data['applicant'] = $this->session->userdata('applicant');
    $data['group'] = $this->session->userdata('group');
    return $data;
  }

  private function do_upload_needs()
  {
    // TODO: later, the directory will be encrypted
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = '5120';
    $config['file_name'] = 'proposal-'.$this->session->userdata('nik').'.pdf';

    $this->load->library('upload', $config);

    if (!file_exists($config['upload_path']))
      mkdir($config['upload_path'], 0777, true);

    if (!$this->upload->do_upload('needs'))
      return FALSE;
    else
      return TRUE;
  }
}

