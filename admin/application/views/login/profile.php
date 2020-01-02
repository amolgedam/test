<?php
 $this->load->view('common/header'); 
$this->load->view('common/left_panel');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <!--   <li><a href="#">Examples</a></li> -->
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>uploads/profile/<?php echo $row->profile;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $row->name; ?></h3>
            </div>
            <!-- /.box-body -->
          </div>

       
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
             <div class="box-body box-profile">
            <div class="tab-pane" id="settings">
                <form role="form" action="<?php echo site_url('Welcome/actionProfile') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name <span style="color:red">*</span><span id="name_err"></span></label>
                    <input type="text" value="<?php  echo $row->name; ?>" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email <span style="color:red">*</span><span id="email_err"></span></label>
                  <input type="text" class="form-control" name="email" value="<?php echo $row->email; ?>" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Mobile <span style="color:red">*</span><span id="mobile_err"></span></label>
                   <input type="text" class="form-control" name="mobile" value="<?php echo $row->mobile_no;?>" maxlength="10" id="mobile" placeholder="Mobile" onkeypress="only_number(event)">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                   <input type="file" class="form-control" name="profile">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" onclick="return validation()">Submit</button>
              </div>
            </form>
              </div>
              <!-- /.tab-pane -->
            </div>
          </div>
        </div>
       
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('common/footer');?>

  <script>
    function validation()
    {
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        var mobile = $("#mobile").val().trim();
         if(name=="")
        {
            $("#name_err").fadeIn().html("Please enter name").css('color','red');
            setTimeout(function(){$("#name_err").html("&nbsp;");},3000);
            $("#name").focus();
            return false;
        }
        if(email =="")
        {
            $("#email_err").fadeIn().html("Please enter email").css('color','red');
            setTimeout(function(){$("#email_err").html("&nbsp;");},3000);
            $("#email").focus();
            return false;
        }
        else if(!email_pattern.test(email))
        {
           $("#email_err").fadeIn().html("Please enter valid email").css('color','red');
            setTimeout(function(){$("#email_err").html("&nbsp;");},3000);
            $("#email").focus();
            return false;
        }

        if(mobile =="")
        {
            $("#mobile_err").fadeIn().html("Please enter mobile").css('color','red');
            setTimeout(function(){$("mobile_err").html("&nbsp;");},3000);
            $("#mobile").focus();
            return false;
        }  
    }
    function only_number(event)
    {
       var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
        {
            return;
        }else{
            event.preventDefault();
        }    
    }
  </script>