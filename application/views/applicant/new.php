<?php
$data['title'] = "Pendaftaran Hibah";
$data['heading'] = "Pendaftaran Identitas Diri";
$data['positions'] = $positions;
$this->load->view('templates/header', $data);
$this->load->view('applicant/_form', $data);
$this->load->view('templates/footer', $data);

