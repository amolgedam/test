<?php 
    //print_r($_SESSION);exit();
  if(empty($_SESSION['SESSION_NAME']['id'])) 
  {
    redirect('Welcome');
  }
  $user_id = $_SESSION['SESSION_NAME']['id'];

  $con = "id='".$user_id."'";
  $userData = $this->Crud_model->get_single('admin',$con);
   if (file_exists('uploads/document/'.$userData->profile)) {
    if (!empty($userData->profile)) {
      $imageProfile = base_url('uploads/document/'.$userData->profile);
    }else{
      $imageProfile = base_url('uploads/document/user.jpg');
    }
  }else{
    $imageProfile = base_url('uploads/document/user.jpg');
  }

  $checkAttendence= $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');
?>

<style type="text/css">
  
  .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
@media only screen and (max-width:780px) {
  #attend{
    display:none;
  }
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WPES | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!--ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--end ajax-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?= base_url()?>assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?= base_url()?>assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link rel="stylesheet" href="<?= base_url();?>assets/select2/select2.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?= site_url('Welcome/Dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>WPES</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
     <center> <span class="message"></span></center>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      
        <ul class="nav navbar-nav">
        	<li>
        		<?php if(empty($checkAttendence)){?>
        <button type="button" class="form-control btn btn-sm btn-success" id="attend" style="margin-top: 10px;" onclick="makeattendence()"> Attendence</button>
    <?php } ?>
    
    	<span style="margin-top: 10px;color: white" id="msg1"><?php if(!empty($checkAttendence)){?>Login Time <?php } ?></span><br/><span id="login_time" style="color: white;">
    		<?php if(!empty($checkAttendence)){?>
    		<?= date("g:i a", strtotime($checkAttendence->in_time)) ?>
    			<?php } ?>
    		</span>
          </li>
          
          <li>
            <?php if(!empty($checkAttendence))
            {

              if(empty($checkAttendence->out_time))
              {

              ?>
        <button type="button" class="form-control btn btn-sm btn-danger dd" id="" style="margin-top: 10px;" data-toggle="modal" data-target="#checkStatus"> Logout</button>
         <?php  }} 
          ?>
          <button type="button" class="form-control btn btn-sm btn-danger dd" id="log_out_div" style="margin-top: 10px;display:none;" data-toggle="modal" data-target="#checkStatus" > Logout</button>
    
      <span style="margin-top: 10px;color: white" id="msg1"></span><br/><span id="logout_time" style="color: white;">
        <?php if(!empty($checkAttendence->out_time)){?>
        Log Out : <?= date("g:i a", strtotime($checkAttendence->out_time)) ?>
          <?php } ?>
        </span>
          </li>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $imageProfile; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(!empty($userData)){?><?php echo ucfirst($userData->name); ?><?php }else{ echo "-";} ?></span>
            </a>
            <ul class="dropdown-menu ">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $imageProfile; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php if(!empty($userData)){?><?php echo ucfirst($userData->name); ?><?php }else{ echo "-";} ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= site_url('Profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url("Welcome/logOut"); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
           
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>

      </div>

    </nav>
  </header>
  
  <div class="modal inmodal" id="checkStatus" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" >
        <div class="modal-content animated bounceInRight">   
            <form method="post" action="<?= site_url("Welcome/logOut");?>">       
                <div class="modal-body">
                    <center>
                      <h3><b>Todays Work</b></h3>
                    <input type="hidden" name="id" id="statusId" style="display: none;"> 
                    <span style="color:red" id="err_remark"><?php echo form_error('remark')?> </span>
                    <textarea name="remark" id="remark" class="form-control ckeditor" placeholder="Enter Remark"></textarea>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-flat" onclick="return get_logout();">Sign out</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <script type="text/javascript">
  
  function makeattendence()
  {
     var site_url = $("#site_url").val();
       
         //var datastring = 'current_password='+current_password+'&new_password='+new_password+'&confirm_password='+confirm_password;
        var url = site_url+"Attendence/makeattendence";
        
         $.ajax({
                  type : "POST",
                  url  : url,
                 // data : datastring,
                  cache:false,
             
              success:function(returndata)
             {
              
                   
                    var obj = JSON.parse(returndata);
                    $("#login_time").html(obj.inTime);
                    $("#msg1").html(obj.msg);
                    $(".message").fadeIn().html("Attendence marked successfully").css('color','white');
                   setTimeout(function() {
                    $(".message").fadeOut();
                    }, 3000);

                   $("#attend").hide();
                  
             }

           });
  }
  
  function get_logout()
  {
    var remark=CKEDITOR.instances['remark'].getData( ).replace( /<[^>]*>/gi, '' );
    var id=$("#id").val();
    var attendance_id=$("#attendance_id").val();

    //alert(attendance_id);return false;

     if(!remark)
      {
        $("#err_remark").fadeIn().html("Required");
        $("#remark").css("border-color","red");
        setTimeout(function(){$("#err_remark").html("&nbsp;");$("#remark").css("borderColor","#00A654")},5000)
        $("#remark").focus();
        return false;
      }
         $.ajax({ 
          type:'post',
          cache:false,
          url:'<?php echo site_url('Welcome/logData') ?>',
          data:{remark:remark,attendance_id:attendance_id},
          success:function(returndata)
          {
            location.reload();
            $(".dd").hide();

          }
        });
    }
</script>
  

