<?= validation_errors(); ?>
<?= form_open('/hibah/create_applicant'); ?>
  <?= form_label("NIK", "applicant[nik]"); ?>
  <?= form_input("applicant[nik]") ?>

  <?= form_label("Nama", "applicant[name]"); ?>
  <?= form_input("applicant[name]") ?>

  <?= form_label("Pekerjaan", "applicant[job]"); ?>
  <?= form_input("applicant[job]") ?>

  <?= form_label("Tempat Lahir", "applicant[birth_place]"); ?>
  <?= form_input("applicant[birth_place]") ?>

  <?= form_label("Tanggal Lahir", "applicant[birth_day]"); ?>
  <?= form_input("applicant[birth_day][date]") ?>
  <?= form_input("applicant[birth_day][month]") ?>
  <?= form_input("applicant[birth_day][year]") ?>

  <?= form_label("Alamat", "applicant[address]"); ?>
  <?= form_input("applicant[address]") ?>

  <?php
  $options = array('Ketua' => 'Ketua',
                   'Wakil Ketua' => 'Wakil Ketua',
                   'Sekretaris' => 'Sekretaris',
                   'Bendahara' => 'Bendahara',
                   'Anggota' => 'Anggota',
                   'Lain-lain' => 'Lain-Lain')
  ?> 
  <?= form_label("Jabatan di Organisasi", "applicant[position]"); ?>
  <?= form_dropdown("applicant[position]", $options, "Ketua") ?>

  <?= form_submit("submit", "Submit") ?>
<?= form_close(); ?>
