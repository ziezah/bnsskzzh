<?php
$data['title'] = "Pendaftaran Hibah";
$data['heading'] = "Pendaftaran Identitas Kelompok";
$data['part_ofes'] = $part_ofes;
$data['activities'] = $activities;
$this->load->view('templates/header', $data);
$this->load->view('group/_form');
