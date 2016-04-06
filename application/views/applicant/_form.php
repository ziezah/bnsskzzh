<?php $general_attr = array('class' => 'form-control'); ?>

<div class="row">
<div class="col-sm-6">
<?= validation_errors(); ?>
<?= form_open('/hibah/create_applicant'); ?>
  <div class="form-group">
    <?= form_label("NIK", "applicant[nik]"); ?>
    <?= form_input("applicant[nik]", set_value('applicant[nik]'), $general_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Nama", "applicant[name]"); ?>
    <?= form_input("applicant[name]", set_value('applicant[name]'), $general_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Pekerjaan", "applicant[job]"); ?>
    <?= form_input("applicant[job]", set_value('applicant[job]'), $general_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Tempat Lahir", "applicant[birth_place]"); ?>
    <?= form_input("applicant[birth_place]", set_value('applicant[birth_place]'), $general_attr); ?>
  </div>

  <div class="form-group">
    <?= form_label("Tanggal Lahir", "applicant[birth_day]"); ?>
    <div class="row">
      <div class="col-md-4">
      <?= form_input("applicant[birth_day][date]", set_value('applicant[birth_day][date]'), $general_attr); ?>
      </div>
      <div class="col-md-4">
      <?= form_input("applicant[birth_day][month]", set_value('applicant[birth_day][month]'), $general_attr); ?>
      </div>
      <div class="col-md-4">
      <?= form_input("applicant[birth_day][year]", set_value('applicant[birth_day][year]'), $general_attr); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <?= form_label("Alamat", "applicant[address]", set_value('applicant[address]')); ?>
    <?= form_textarea("applicant[address]", set_value('applicant[address]'), $general_attr); ?>
  </div>

  <?php
  $options = array();
  foreach($positions as $v){ $options[$v] = $v; }
  ?> 
  <div class="form-group">
    <?= form_label("Jabatan di Organisasi", "applicant[position]"); ?>
    <?= form_dropdown("applicant[position]", $options, set_value('applicant[position]'), $general_attr); ?>
  </div>

  <?= form_submit("submit", "Submit", array('class' => 'btn btn-default')); ?>
<?= form_close(); ?>
</div> <!-- column -->
</div> <!-- row -->
