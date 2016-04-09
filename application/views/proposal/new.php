<?php
$data['title'] = "Pendaftaran Hibah";
$data['heading'] = "Pendaftaran Proposal";
$data['applicant'] = $applicant;
$data['group'] = $group;
$this->load->view('templates/header', $data);
$this->load->view('proposal/_form', $data);
$this->load->view('templates/footer', $data);

