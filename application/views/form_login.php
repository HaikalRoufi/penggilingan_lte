<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Penggilingan Padi | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #3572EF, #3ABEF9, #A7E6FF);
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-warning">
      <div class="card-header text-center">
        <a href="#" class="h5"><b>Sistem Informasi Penggilingan Padi</a>
        <img src="<?= base_url('assets/images/padi.jpeg'); ?>" alt="" width="300" style="border-radius: 5%; margin-top: 5%;" />
      </div>
      <div class="card-body">
        <?php
        $data = $this->session->flashdata('sukses');
        if ($data != "") { ?>
          <div id="notifikasi" class="alert alert-success alert-dismissible fade show"><strong>Sukses! </strong>
            <?= $data; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button></div>
        <?php } ?>

        <?php
        $data2 = $this->session->flashdata('error');
        if ($data2 != "") { ?>
          <div id="notifikasi" class="alert alert-warning alert-dismissible fade show"><strong>Error! </strong>
            <?= $data2; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
          </div>
        <?php } ?>
        <p class="login-box-msg h6">Sign in to start your session</p>

        <form action="<?= base_url('auth/cek_login'); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
            <div class="input-group-append">
              <div class="input-group-text" id="togglePassword" style="cursor: pointer">
                <i class="far fa-eye-slash" id="icon"></i>
              </div>
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function () {
      $("#togglePassword").click(function (e) {
        e.preventDefault();
        if ($("#icon").hasClass("fa-eye-slash")) {  //check the class
          $("#icon").removeClass("fa-eye-slash").addClass("fa-eye");
        } else if ($("#icon").hasClass("fa-eye")) {
          $("#icon").removeClass("fa-eye ").addClass("fa-eye-slash");
        }
        var input = $("#password");

        if (input.attr("type") == "text") {
          input.attr("type", "password");
        } else {
          input.attr("type", "text");
        }
      });
    });
  </script>
</body>

</html>
