<?php $general_attr = array('class' => 'form-control'); ?>

<div class="row">
<div class="col-sm-6">
<?= form_open('/proposal/create_proposal'); ?>
  <div class="form-group">
    <?= form_label("Tujuan Penggunaan Hibah", "proposal[purpose]"); ?>
    <?= form_textarea("proposal[purpose]", set_value("proposal[purpose]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_label("Jumlah yang Dibutuhkan", "proposal[needed_amount]"); ?>
    <?= form_input("proposal[needed_amount]", set_value("proposal[needed_amount]"), $general_attr) ?>
  </div>

  <div class="form-group">
    <?= form_fieldset("List Semua Kebutuhan") ?>
      <?= form_input("proposal[needs][0]", set_value("proposal[needs][0]"), $general_attr) ?>
    <?= form_fieldset_close() ?>
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

  <div class="form-group">
    <?= form_checkbox("proposal[agreement]", '1', $general_attr) ?><?= $agreement ?>
  </div>

   <div class="form-group">
    <?= form_submit("submit", "Submit", array('class' => 'btn btn-primary')) ?>
    <?= anchor('', 'Kembali', array('class' => 'btn btn-default')); ?>
  </div>
<?= form_close(); ?>
</div>
</div>
