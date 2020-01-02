<?php
$this->load->view('common/header'); 
$this->load->view('common/left_panel');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $heading; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"> <?= $heading; ?></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <div class="tab-pane" id="settings">
               <div class="box-body">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Current Password <span style="color:red">*</span><span style="color:red" id="c_err"><?= $this->session->userdata("message") ?></span></label>
                      <input type="password" id="cpassword" placeholder="Enter Current Password" class="form-control" name="password" value="<?= $password ?>"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password <span style="color:red">*</span><span style="color:red" id="np_err"></span></label>
                      <input type="password" id="npassword" placeholder="Enter New Password" class="form-control" name="n_password" value="<?php $n_password;?>"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Confirm New Password <span style="color:red">*</span><span style="color:red" id="cn_err"></span></label>
                      <input type="password" id="cnpassword" placeholder="Confirm New Password" class="form-control" name="cn_password" value="<?php $cn_password ?>"/>
                    </div>
                  </div> 
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" onclick="return validation()">Submit</button>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
function validation()
{  
  var cpassword=$("#cpassword").val();
  var npassword = $("#npassword").val();
  var cnpassword = $("#cnpassword").val();
  var site_url = $("#site_url").val();

  if(cpassword=="")
  {
    $("#c_err").fadeIn().html("Please Enter Current Password");
    $("#cpassword").css("border-color","red");
    setTimeout(function(){$("#c_err").html("&nbsp;");$("#cpassword").css("borderColor","#00A654")},5000)
    $("#cpassword").focus();
    return false;
  } 

  if(npassword=="")
  {
    $("#np_err").fadeIn().html("Please Enter New Password");
    $("#npassword").css("border-color","red");
    setTimeout(function(){$("#np_err").html("&nbsp;");$("#npassword").css("borderColor","#00A654")},5000)
    $("#npassword").focus();
    return false;
  } 

  if(cnpassword=="")
  {
    $("#cn_err").fadeIn().html("Please Enter Confirm New Password");
    $("#cnpassword").css("border-color","red");
    setTimeout(function(){$("#cn_err").html("&nbsp;");$("#cnpassword").css("borderColor","#00A654")},5000)
    $("#cnpassword").focus();
    return false;
  }

  if(npassword!=cnpassword)
  {
    $("#np_err").fadeIn().html("New password and Confirm password should be same");
    $("#npassword").css("border-color","red");
    setTimeout(function(){$("#np_err").html("&nbsp;");$("#npassword").css("borderColor","#00A654")},5000)
    $("#npassword").focus();
    return false;
  }   

  $.ajax({
        type: "POST",
        url: site_url+"/Welcome/change_password_action",
        data: {npassword:npassword,cnpassword:cnpassword,cpassword:cpassword},
        cache: false,
        success: function(returnData)
        { 
            if(returnData==1)
            {
                $("#np_err").fadeIn().html("New password and Confirm password should be same");
                $("#npassword").css("border-color","red");
                setTimeout(function(){$("#np_err").html("&nbsp;");$("#npassword").css("borderColor","#00A654")},5000)
                $("#npassword").focus();
                return false;
            }
            else if(returnData==2)
            { 
             $("#c_err").fadeIn().html("Current password is Incorrect");
              $("#cpassword").css("border-color","red");
              setTimeout(function(){$("#c_err").html("&nbsp;");$("#cpassword").css("borderColor","#00A654")},5000)
              $("#cpassword").focus();
              return false;
            }
            else 
            {
              window.location = site_url+'/Welcome/index';
            }  
           
        }
    });
}
</script>