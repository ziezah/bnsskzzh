<?php $general_attr = array('class' => 'form-control'); ?>

<div class="row">
<div class="col-sm-6">

<?php if(validation_errors() != false): ?>
  <div class="alert alert-danger">
    <?= validation_errors(); ?>
  </div>
<?php endif; ?>

<div class="applicant-data">
  Nama Pendaftar: <?= $applicant->name;?>
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
    <div class="row">
      <div class="col-md-4">
      <?= form_input("group[registered_date][date]", set_value("group[registered_date][date]"), $general_attr); ?>
      </div>
      <div class="col-md-4">
        <?= form_input("group[registered_date][month]", set_value("group[registered_date][month]"), $general_attr); ?>
      </div>
      <div class="col-md-4">
        <?= form_input("group[registered_date][year]", set_value("group[registered_date][year]"), $general_attr); ?>
      </div>
    </div>
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

  <?php //TODO: Dynamic membership_list ?>
  <div class="form-group">
  <?= form_label("List Semua Anggota", "group[membership_list]"); ?>
  <?= form_input("group[membership_list]", set_value("group[membership_list]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_submit("submit", "Submit", array('class' => 'btn btn-primary')) ?>
    <?= anchor('', 'Kembali', array('class' => 'btn btn-default')); ?>
  </div>
<?= form_close(); ?>
</div>
</div>
