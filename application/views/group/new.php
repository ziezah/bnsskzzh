<?php
$data['title'] = "Pendaftaran Hibah";
$data['heading'] = "Pendaftaran Identitas Kelompok";
$data['part_ofes'] = $part_ofes;
$data['activities'] = $activities;
$data['applicant'] = $applicant;
$this->load->view('templates/header', $data);
$this->load->view('group/_form');
