<?= validation_errors(); ?>
<?= form_open('/hibah/create_group'); ?>
  <?= form_label("No. Registrasi Kelompok", "group[no_reg]"); ?>
  <?= form_input("group[no_reg]", set_value("group[no_reg]")) ?>

  <?= form_label("Nama Kelompok", "group[name]"); ?>
  <?= form_input("group[name]", set_value("group[name]")); ?>

  <?= form_label("Tanggal Terdaftar", "group[registered_date]"); ?>
  <?= form_input("group[registered_date][date]", set_value("group[registered_date][date]")); ?>
  <?= form_input("group[registered_date][month]", set_value("group[registered_date][month]")); ?>
  <?= form_input("group[registered_date][year]", set_value("group[registered_date][year]")); ?>

  <?= form_label("Alamat Kantor", "group[address]"); ?>
  <?= form_textarea("group[address]", set_value("group[address]")); ?>

  <?php
  $options = array();
  foreach($part_ofes as $v){ $options[$v] = $v; }
  ?> 
  <?= form_label("Termasuk Dalam Bagian", "group[part_of]"); ?>
  <?= form_dropdown("group[part_of]", $options, set_value("group[part_of]")) ?>

  <?php
  $options = array();
  foreach($activities as $v){ $options[$v] = $v; }
  ?> 
  <?= form_label("Kegiatan di Bidang", "group[activity]"); ?>
  <?= form_dropdown("group[activity]", $options, set_value("group[activity]")) ?>

  <?= form_label("Jumlah Anggota", "group[membership]"); ?>
  <?= form_input("group[membership]", set_value("group[membership]")) ?>

  <?php //TODO: Dynamic membership_list ?>
  <?= form_fieldset("List Semua Anggota") ?>
    <?= form_label("List Semua Anggota", "group[membership_list]"); ?>
    <?= form_input("group[membership_list]", set_value("group[membership_list]")) ?>
  <?= form_fieldset_close() ?>

  <?= form_submit("submit", "Submit") ?>
<?= form_close(); ?>
