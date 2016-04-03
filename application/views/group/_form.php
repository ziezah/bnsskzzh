<?= form_open('/group/create_group'); ?>
  <?= form_label("No. Registrasi Kelompok", "group[no_reg]"); ?>
  <?= form_input("group[no_reg]") ?>

  <?= form_label("Nama Kelompok", "group[name]"); ?>
  <?= form_input("group[name]") ?>

  <?= form_label("Tanggal Lahir", "group[registered_date]"); ?>
  <?= form_input("group[registered_date][date]") ?>
  <?= form_input("group[registered_date][month]") ?>
  <?= form_input("group[registered_date][year]") ?>

  <?= form_label("Alamat Kantor", "group[address]"); ?>
  <?= form_textarea("group[address]") ?>

  <?php
  $options = array('Kesbangpol' => 'Kesbangpol',
                   'Setda' => 'Setda')
  ?> 
  <?= form_label("Termasuk Dalam Bagian", "group[part_of]"); ?>
  <?= form_dropdown("group[part_of]", $options, "Kesbangpol") ?>

  <?php
  $options = array('Perekonomian' => 'Perekonomian',
    'Pendidikan' => 'Pendidikan',
    'Kesehatan' => 'Kesehatan',
    'Agama' => 'Agama',
    'Kesenian, Adat dan Olah Raga' => 'Kesenian, Adat dan Olah Raga',
    'Non-Profesional' => 'Non-Profesional',
  )
  ?> 
  <?= form_label("Kegiatan di Bidang", "group[part_of]"); ?>
  <?= form_dropdown("group[part_of]", $options, "Kesbangpol") ?>

  <?= form_label("Jumlah Anggota", "group[membership]"); ?>
  <?= form_input("group[membership]") ?>

  <?= form_fieldset("List Semua Anggota") ?>
    <?= form_label("List Semua Anggota", "group[membership_list]"); ?>
    <?= form_input("group[membership_list]") ?>
  <?= form_fieldset_close() ?>

  <?= form_submit("submit", "Submit") ?>
<?= form_close(); ?>
