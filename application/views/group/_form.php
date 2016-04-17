<?php 
$general_attr = array('class' => 'form-control'); 
$date_picker_attr = $general_attr; 
$date_picker_attr['class'] .=  ' date-picker' ; 
$date_picker_attr['placeholder'] =  'mm/dd/yyyy' ;
?>

<div class="row">
<div class="col-sm-6">

<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
    <span class="sr-only">40% Complete</span>
  </div>
</div>


<?php if(validation_errors() != false): ?>
  <div class="alert alert-danger">
    <?= validation_errors(); ?>
  </div>
<?php endif; ?>

<div class="well applicant-data">
  Nama Pendaftar: <?= $applicant['name'];?>
</div>

<?= form_open('/hibah/create_group'); ?>
  <div class="form-group">
    <?= form_label("No. Registrasi Kelompok", "group[no_reg]"); ?>
    <?= form_input("group[no_reg]", set_value("group[no_reg]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("Nama Kelompok", "group[name]"); ?>
    <?= form_input("group[name]", set_value("group[name]"), $general_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Tanggal Terdaftar", "group[registered_date]"); ?>
    <?= form_input("group[registered_date]", set_value("group[registered_date]"), $date_picker_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Alamat Kantor", "group[address]"); ?>
    <?= form_textarea("group[address]", set_value("group[address]"), $general_attr); ?>
  </div>

  <?php
  $options = array();
  foreach($part_ofes as $v){ $options[$v] = $v; }
  ?> 
  <div class="form-group">
    <?= form_label("Termasuk Dalam Bagian", "group[part_of]"); ?>
    <?= form_dropdown("group[part_of]", $options, set_value("group[part_of]"), $general_attr) ?>
  </div>

  <?php
  $options = array();
  foreach($activities as $v){ $options[$v] = $v; }
  ?> 
  <div class="form-group">
    <?= form_label("Kegiatan di Bidang", "group[activity]"); ?>
    <?= form_dropdown("group[activity]", $options, set_value("group[activity]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("Jumlah Anggota", "group[membership]"); ?>
    <?= form_input("group[membership]", set_value("group[membership]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("NIK Ketua Kelompok", "group[chairman_nik]"); ?>
    <?= form_input("group[chairman_nik]", set_value("group[chairman_nik]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("NIK Sekretaris Kelompok", "group[secretary_nik]"); ?>
    <?= form_input("group[secretary_nik]", set_value("group[secretary_nik]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("NIK Bendahara Kelompok", "group[finance_manager_nik]"); ?>
    <?= form_input("group[finance_manager_nik]", set_value("group[finance_manager_nik]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_submit("submit", "Submit", array('class' => 'btn btn-primary')) ?>
    <?= anchor('', 'Kembali', array('class' => 'btn btn-default')); ?>
  </div>
<?= form_close(); ?>
</div>
</div>
