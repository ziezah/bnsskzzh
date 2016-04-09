<?php
$data['title'] = "Pendaftaran Hibah Berhasil";
$data['heading'] = "Pendaftaran Berhasil";
$this->load->view('templates/header', $data);
?>

<div class="alert alert-success">
  Pendaftaran hibah berhasil dilakukan
</div>

<div class="panel panel-default">
  <div class="panel-heading">Username dan Password anda</div>
  <div class="panel-body">
    Username: <strong>Paklong</strong> <br>
    Password: <strong>xxkksjjsk</strong> <br>
    Harap catat username dan password anda.<br>
    Untuk mengganti password, silahkan <a>login</a> terlebih dahulu.
  </div>
</div>

<?php
$this->load->view('templates/footer', $data);
?>

