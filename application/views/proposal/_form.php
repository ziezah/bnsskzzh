<?php $general_attr = array('class' => 'form-control'); ?>

<div class="row">
<div class="col-sm-6">

<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
    <span class="sr-only">70% Complete</span>
  </div>
</div>

<?php if(validation_errors() != false): ?>
  <div class="alert alert-danger">
    <?= validation_errors(); ?>
  </div>
<?php endif; ?>

<div class="well applicant-data">
  Nama Pendaftar: <?= $applicant['name']; ?> <br >
  Nama Group: <?= $group['name']; ?>
</div>

<?= form_open_multipart('/hibah/create_proposal'); ?>
  <div class="form-group">
    <?= form_label("Tujuan Penggunaan Hibah", "proposal[purpose]"); ?>
    <?= form_textarea("proposal[purpose]", set_value("proposal[purpose]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("Jumlah Dana yang Dibutuhkan", "proposal[needed_amount]"); ?>
    <?= form_input("proposal[needed_amount]", set_value("proposal[needed_amount]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("File PDF Berisi Daftar Kebutuhan", "needs"); ?>
    <?= form_upload("needs", set_value("needs")) ?>
  </div>

  <div class="form-group">
    <?= form_label("Penanggung Jawab Proposal", "proposal[pic]"); ?>
    <?= form_input("proposal[pic]", set_value("proposal[pic]"), $general_attr) ?>
  </div>

  <?php
$agreement = "Dengan ini saya menyatakan bahwa dalam penggunaan dana
hibah ini akan digunakan sesuai dengan tujuan penggunaan dan tidak bertentangan
dengan undang-undang yang berlaku. Serta bersedia menyampaikan pertanggung
jawaban penggunaan dana hibah tersebut kepada pemerintah daerah melalui bagian
sekretariat daerah kabupaten Kubu Raya.
Seandainya saya tidak menyampaikan pertanggung jawaban, saya bertanggung jawab
untuk mengembalikan dana hibah tersebut ke pemerintahan daerah dan bersedia
dituntut sesuai dengan hukum yang berlaku.";
  ?>

  <?= form_fieldset("Pernyataan") ?>
    <div class="checkbox">
      <label>
        <?= form_checkbox("proposal[agreement]", '1', FALSE, array('type' => 'checkbox')) ?><?= $agreement ?>
      </label>
    </div>
  <?= form_fieldset_close() ?>

   <div class="form-group">
    <?= form_submit("submit", "Submit", array('class' => 'btn btn-primary')) ?>
    <?= anchor('', 'Kembali', array('class' => 'btn btn-default')); ?>
  </div>
<?= form_close(); ?>
</div>
</div>
