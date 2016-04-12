<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link href="<?= asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset_url(); ?>css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- disabling responsiveness -->
    <style>
    .container{
      width: 970px !important;
    }
    </style>
  <body>
    <script src="<?= asset_url(); ?>js/jquery-1.12.3.min.js"></script>
    <script src="<?= asset_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?= asset_url(); ?>js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
    $(function () {
      $('.date-picker').datepicker({
        autoclose: true
      });
    });
    </script>

    <div class="container">
    <h1><?= $heading; ?></h1>
     

