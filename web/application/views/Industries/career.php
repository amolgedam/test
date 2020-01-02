
<?php $this->load->view('common/header.php');?>
<div class="contact-area inner-padding6">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="form-area-row foo" data-sr='enter'>
                        <div class="form-area-title">
                            <h3>Apply Form</h3>
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                        <div class="form-area" style="padding: 30px;">
                            <div class="cf-msg"></div>
                            <form action="<?php echo site_url('Industries/career_action') ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <ul class="contact-form">
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Your name<span style="color:red;">* </span><span style="color:red" id="name_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Write Your name">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Your Skills<span style="color:red;">* </span><span style="color:red" id="skill_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="skill" name="skill" placeholder="Write Your skill">
                                                </div>
                                            </div>
                                        </li>

                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Your Email id<span style="color:red;">* </span><span style="color:red" id="email_err"> </span><?php echo form_error('email')?></label>
                                                
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Write Your email id">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Applying For<span style="color:red;">* </span><span style="color:red" id="apply_for_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="apply_for" name="apply_for" placeholder="Ex: PHP Developer,Android Developer">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subject">Address<span style="color:red;">* </span><span style="color:red" id="address_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <textarea rows="7" class="form-control form-message" placeholder="Write your Address" id="address" name="address"></textarea>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Date<span style="color:red;">* </span><span style="color:red" id="date_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="date" class="form-control" id="date" name="date" placeholder="Ex: PHP Developer,Android Developer">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Upload Resume<span style="color:red;">* </span><span style="color:red" id="resume_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="resume" name="resume">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Phone Number<span style="color:red;">* </span><span style="color:red" id="mobile_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Write your Mobile No" maxlength="10">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-default btn-form" onclick="return validation()">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <?php $this->load->view('common/footer');?>

<script type="text/javascript">
    function validation()
  {
      var name=$("#name").val().trim();
      var skill=$("#skill").val().trim();
      var email=$("#email").val().trim();
      var apply_for=$("#apply_for").val().trim();
      var address=$("#address").val().trim();
      var date=$("#date").val().trim();
      var resume=$("#resume").val().trim();
      var mobile=$("#mobile").val().trim();
      var mobile_pattern = /^[789]\d{9}$/;
      if(name=="")
      {
          $("#name_err").fadeIn().html("Enter Your Name").css('color','red');
          setTimeout(function(){$("#name_err").html("&nbsp;");},3000);
          $("#name").focus();
          return false;
      }
      if(skill=="")
      {
          $("#skill_err").fadeIn().html("Enter Your Skill").css('color','red');
          setTimeout(function(){$("#skill_err").html("&nbsp;");},3000);
          $("#skill").focus();
          return false;
      }
      if(email=="")
      {
          $("#email_err").fadeIn().html("Enter Your Email").css('color','red');
          setTimeout(function(){$("#email_err").html("&nbsp;");},3000);
          $("#email").focus();
          return false;
      }
      if(apply_for=="")
      {
          $("#apply_for_err").fadeIn().html("Enter your Profile Applying for").css('color','red');
          setTimeout(function(){$("#apply_for_err").html("&nbsp;");},3000);
          $("#apply_for").focus();
          return false;
      }
      if(address=="")
      {
          $("#address_err").fadeIn().html("Enter your Address").css('color','red');
          setTimeout(function(){$("#address_err").html("&nbsp;");},3000);
          $("#address").focus();
          return false;
      }
      if(date=="")
      {
          $("#date_err").fadeIn().html("Select Date").css('color','red');
          setTimeout(function(){$("#date_err").html("&nbsp;");},3000);
          $("#date").focus();
          return false;
      }
      if(resume=="")
      {
          $("#resume_err").fadeIn().html("Select Your Resume").css('color','red');
          setTimeout(function(){$("#resume_err").html("&nbsp;");},3000);
          $("#resume").focus();
          return false;
      }
      if(mobile=="")
      {
          $("#mobile_err").fadeIn().html("Enter Your Mobile No").css('color','red');
          setTimeout(function(){$("#mobile_err").html("&nbsp;");},3000);
          $("#mobile").focus();
          return false;
      }
      if(!mobile_pattern.test(mobile))
      {
          $("#mobile_err").fadeIn().html("Invalid").css('color','red');
          setTimeout(function(){$("#mobile_err").html("&nbsp;");},3000);
          $("#mobile").focus();
          return false;
      }
      
  }
</script>