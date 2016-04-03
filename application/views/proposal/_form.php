<?= form_open('/proposal/create_proposal'); ?>
  <?= form_label("Tujuan Penggunaan Hibah", "proposal['purpose']"); ?>
  <?= form_textarea("proposal['purpose']") ?>

  <?= form_label("Jumlah yang Dibutuhkan", "proposal['needed_amount']"); ?>
  <?= form_input("proposal['needed_amount']") ?>

  <?= form_fieldset("List Semua Kebutuhan") ?>
    <?= form_label("List Semua Anggota", "proposal['membership']"); ?>
    <?= form_input("proposal['needs']") ?>
  <?= form_fieldset_close() ?>

  <?= form_label("Penanggung Jawab Proposal", "proposal['pic']"); ?>
  <?= form_input("proposal['pic']") ?>

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
  <?= form_label($agreement, "proposal['agreement']"); ?>
  <?= form_checkbox("proposal['agreement']", '1') ?>

  <?= form_submit("submit", "Submit") ?>
<?= form_close(); ?>
