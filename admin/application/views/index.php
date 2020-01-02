<?php 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WPES | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?= base_url()?>assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?= base_url()?>assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('../admin/uploads/home/driving_school1.jpg');" >
<div class="login-box">
  <div class="login-logo">
    
    <img src="<?= base_url('uploads/logo/logo.png');?>" style="height:150px;width:150px">
   
    <br>
    <!-- <a href="<?= site_url('Welcome/index'); ?>" style="color:#DB1B1B"><b>ebco</b></a> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <span class="msghide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></span>
    <form method="post" action="<?php echo $actionUrl; ?>" method="post" onsubmit="return validation()">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email_id" id="email_id">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="error" id="error_email"><?php echo form_error('email_id'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="error" id="error_password"><?php echo form_error('password'); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  function validation(){
    
       
        var email = $("#email_id").val().trim();
        var password = $("#password").val().trim();
        var alpha = /^[a-z A-Z]+$/;
        var validateEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        
        if(email =='')
        {
          $("#error_email").fadeIn().html("Please enter email").css("color","red");
          setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
          $("#email_id").focus();
          return false;       
        }
        else if(!validateEmail.test(email))
        {
          $("#error_email").fadeIn().html("Please enter valid email").css("color","red");
          setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
          $("#email_id").focus();
          return false;       
        }

        if(password =='')
        {
          $("#error_password").fadeIn().html("Please enter password").css("color","red");
          setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
          $("#password").focus();
          return false;       
        }
        /*else if(password.length>'0' && password.length>'8')
        {
            $("#error_password").fadeIn().html("Password should be 8 characters only").css("color","red");
            setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
            $("#password").focus();
            return false;
        }*/
}

setTimeout(function(){$("#messages").fadeOut();},3000);
</script>
</body>
</html>
