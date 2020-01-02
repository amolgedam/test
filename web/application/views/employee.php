<?php $this->load->view('common/header.php');?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
   <style>
      blink {
        animation: blinker 0.8s linear infinite;
        color: red;
       }
      @keyframes blinker {  
        50% { opacity: 0; }
       }
     
    </style>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                                <p><a href="<?php echo site_url('Welcome/index'); ?>">Home </a> >
                                </p><br><br>
                                <h1>Employee Registration Form</h1>
                                 <span  style="color: red; font-size: 28px;"> <blink> <?php echo $this->session->flashdata('message');?></blink></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="contact-area inner-padding6">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="form-area-row foo" data-sr='enter'>
                        <div class="form-area-title">
                   <marquee>Suggestion:<span style="color: red; font-weight: 800px">  Do not use similar Mobile No or Email Id while registration. You can't use mobile no or email id twice</span></marquee>
                         
                        </div>
                        <div class="form-area">
                            <div class="cf-msg"></div>
                            <form action="<?php echo site_url('Welcome/employee_create') ?>" method="POST" enctype="multipart/form-data" >
                                <div class="row">
                                    <ul class="contact-form">
                                    	<div><h3>Personal Details</h3></div>
                                    	<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>First Name<span style="color:red;">* </span><span style="color:red" id="first_name_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="first_name" name="first_name"  class="first_name form-control" placeholder="Write First name">
                                                </div>
                                            </div>
                                    		
                                    	</div>
                                    	<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Middle Name<span style="color:red;">* </span><span style="color:red" id="middle_name_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="middle_name" name="middle_name"  class="middle_name form-control" placeholder="Write Middle name">
                                                </div>
                                            </div>
										</div>
                                    	<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Last Name<span style="color:red;">* </span><span style="color:red" id="last_name_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="last_name" name="last_name"  class="last_name form-control" placeholder="Write last name">
                                                </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>D.O.B<span style="color:red;">* </span><span style="color:red" id="birthday_date_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="date" name="birthday_date" id="birthday_date" class="birthday_date form-control" placeholder="Enter Birthday Date">
                                                     
                                                </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Guardian Name<span style="color:red;">* </span><span style="color:red" id="guardian_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="guardian" name="guardian"  class=" guardian form-control" placeholder="Write Guardian name">
                                                </div>
                                            </div>
										</div>
											<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Gender<span style="color:red;">* </span><span style="color:red" id="gender_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <Select type="text" id="gender" name="gender"  class=" gender form-control" placeholder="Write Gaurdian name">
                                                    	<option value="Male">Male</option>
                                                    	<option value="Female">Female</option>
                                                    </Select>
                                                </div>
                                            </div>
										</div>
										<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<!-- <h5>Mark the Attached Document</h5>
                                    		<input type="checkbox" name="medical" value="medical"> Medical Fitness
											<input type="checkbox" name="character" value="Character">Character Certificate -->
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Height<span style="color: black;font-wieght:100px!important;">&nbsp;(optional)</span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="height" name="height"  class="form-control" placeholder="Write height">
                                                    
                                                   
                                                </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Caste<span style="color:red;">* </span><span style="color:red" id="caste_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="caste" name="caste"  class=" caste form-control" placeholder="Write Caste">
												 </div>
                                            </div>
										</div>
											<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Religion<span style="color:red;">* </span><span style="color:red" id="religion_error"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="religion" name="religion"  class=" religion form-control" placeholder="Write religion">
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Home State<span style="color:red;">* </span><span style="color:red" id="religion_err"> </span></label>
                                                
                                                <div class="input-group">

                                                    <select type="text" id="home_state" name="home_state"  class="home_state form-control" onchange="return getcity(this.value)">
                                                    	<option>Select State</option>
											<?php if(!empty($home_state)){ foreach ($home_state as $key) {?>
                                                <option value="<?= $key->id; ?>"><?= $key->state_name; ?></option>
                                            <?php }} ?>
                                                    </select>
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Home City<span style="color:red;">* </span><span style="color:red" id="city_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <select type="text" id="home_city" name="home_city"  class=" home_city form-control">
                                                     <option value="">Select City</option>
                                           <?php if(!empty($home_city)){ foreach ($home_city as $key) {?>
                                              <option value="<?= $key->id; ?>"><?= $key->city_name; ?></option>
                                          <?php }} ?>
                                                    </select>
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Blood Group<span style="color: black; font-weight:100px;">&nbsp;(optional) </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="" name="blood_group"  class="blood_group form-control">
                                                    	

												 </div>
                                            </div>
										</div>
										
										<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<h5>Employee Office Details</h5>
										</div>
											<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Date of Appointment<span style="color:red;">* </span><span style="color:red" id="appointment_err"> </span></label>
													<div class="input-group">
                                                    <input type="date" id="appointment" name="appointment"  class="appointment form-control" placeholder="">
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Current Designation<span style="color:red;">* </span><span style="color:red" id="designation_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <select type="text" id="designation" name="designation"  class="designation form-control">
                                                    	<option >Select Designation</option>
                                                        <?php if(!empty($designation)){foreach ($designation as $key) { ?>
                                                         <option value="<?php echo $key->id; ?>"><?= $key->designation_name ?></option>
                                                        <?php }} ?>
                                                    
                                                    
                                                    </select>
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Date of Joining in Department<span style="color:red;">* </span><span style="color:red" id="office_join_error"> </span></label>
													<div class="input-group">
                                                    <input type="date" id="office_join" name="office_join"  class="office_join form-control" placeholder="">
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Current Office<span style="color:red;">* </span><span style="color:red" id="office_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <select type="text" id="current_state" name="current_office"  class="form-control">
                                                    	<option>World Planet E Solution Nagpur</option>
                                                    	<option>World Planet E Solution Australia</option>
                                                    	<option>World Planet E Solution Nashik</option>
                                                    	<option>World Planet E Solution Pune</option>
                                                    	<option>World Planet E Solution Mumbai</option>
                                                    </select>
												 </div>
                                            </div>
										</div>
										<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<h5>Present Address Details</h5>
										</div>
										<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<div class="form-group">
                                                <label>Present Address<span style="color:red;">* </span><span style="color:red" id="present_address_error"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="present_address" name="present_address"  class="present_address form-control" placeholder="Write present_address">
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>State<span style="color:red;">* </span><span style="color:red" id="present_state_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <Select type="text" id="present_state" name="present_state"  class="present_state form-control" placeholder="Write present_address" onchange="return getcity(this.value)">
                                                    	<option>Select State</option>
											<?php if(!empty($home_state)){ foreach ($home_state as $key) {?>
                                                <option value="<?= $key->id; ?>"><?= $key->state_name; ?></option>
                                            <?php }} ?>
                                                    </Select>
												 </div>
                                            </div>
										</div>


                                         

										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>District<span style="color:red;">* </span><span style="color:red" id="district_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <Select type="text" id="district" name="district"  class="district form-control" placeholder="Write District">
                                                    	    <option value="">Select City</option>
                                          		 <?php if(!empty($home_city)){ foreach ($home_city as $key) {?>
                                             		 <option value="<?= $key->id; ?>"><?= $key->city_name; ?></option>
                                         			 <?php }} ?>
                                                    </Select>
												 </div>
                                            </div>
										</div>


                                       
                                        


										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Pin Code<span style="color:red;">* </span><span style="color:red" id="pin_code_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="pin_code" name="pin_code"  class="pin_code form-control" placeholder="Write Pin code">
												 </div>
                                            </div>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Mobile No<span style="color:red;">* </span><span style="color:red" id="mobile_no_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="mobile_no" name="mobile_no"  class="mobile_no form-control" placeholder="Write Mobile No" maxlength="10" onkeypress="only_number(event)">
												 </div>
                                            </div>
										</div>
										<div class="col-md-3 col-sm-3 col-lg-3">
                                    		<div class="form-group">
                                                <label>Email Id<span style="color:red;">* </span><span style="color:red" id="email_id_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="email_id" name="email_id"  class="email_id form-control" placeholder="Write Mobile No">
												 </div>
                                            </div>
										</div>
                                          <div class="col-md-2 col-sm-2 col-lg-2">
                                            <div class="form-group">
                                                <label>Guardian Type<span style="color:red;">* </span><span style="color:red" id="guardian_type_err"> </span></label>
                                                
                                                <div class="input-group">
                                                    <select type="text" id="guardian_type" name="guardian_type"  class=" guardian_type form-control">
                                                        <option value="">...select... </option>
                                                        <option>Father</option>
                                                        <option>Mother</option>
                                                        <option>Husband</option>
                                                        <option>Wife</option>
                                                        <option>Brother</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div> 
                                     
                                   
										<div class="col-md-3 col-sm-3 col-lg-3">
                                    		<div class="form-group">
                                                <label>Guardian Mobile No<span style="color:red;">* </span><span style="color:red" id="gmobile_no_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="gmobile_no" name="gmobile_no"  class="gmobile_no form-control" placeholder="Write Gaurdian Mobile No" maxlength="10" >
												 </div>
                                            </div>
										</div>


											<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<h5>Previous  Company Details</h5>
										</div>
									
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Past Office Name <span style="color:red;">* </span><span style="color:red" id="appointment_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="office_name" name="office_name"  class="form-control" placeholder="Name Of Office">
												 </div>
                                            </div>
										</div>
										
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Initial Designation<span style="color:red;">* </span><span style="color:red" id="initial_deg_err"> </span></label>
													<div class="input-group">
                                                    <input type="text" id="initial_deg" name="initial_deg"  class="form-control" placeholder="Enter Designation">
												 </div>
                                            </div>
										</div>
										<div class="col-md-12 col-sm-12 col-lg-12">
                                    		<h5>Salary Details</h5>
										</div>
										<div class="col-md-4 col-sm-4 col-lg-4">
                                    		<div class="form-group">
                                                <label>Basic Salary<span style="color:red;">* </span><span style="color:red" id="basic_salary_err"> </span></label>
													<div class="input-group">
                                                    <input type="Number" id="basic_salary" name="basic_salary"  class="basic_salary form-control" placeholder="Enter Basic Salary">
												 </div>
                                            </div>
										</div>
										
                                  
									</ul>
								
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-default btn-form" name="submit" onclick="return valid_data();">SUBMIT</button>
                                    </div>
                                    
                                </div>
                               
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer.php');?>
<script type="text/javascript">
function getcity(val)
{
    var id=val;

    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('Welcome/get_city');?>",
        data:{id:id},
        success:function(returndata)
        {   
            $('#home_city').html(returndata);
            $('#district').html(returndata);
        }
    });
}
    
</script>
<script type="text/javascript">


	
	var middle_name=$(".middle_name").val().trim();
	if(middle_name=="")
		{
			$("#middle_name_err").fadeIn().html("Please enter Middle Name").css('color','red');
			setTimeout(function(){   
				$("#middle_name_err").html("&nbsp;");},3000);
			$(".middle_name").focus();
		}
		return false;


</script>
<script >
	function valid_data()
{
	
		var first_name=$(".first_name").val().trim();
		
		if(first_name=="")
		{
			$("#first_name_err").fadeIn().html("Please enter First Name").css('color','red');
			setTimeout(function(){   
				$("#first_name_err").html("&nbsp;");},3000);
			$(".first_name").focus();
			return false;
		}
			var middle_name=$(".middle_name").val().trim();
	if(middle_name=="")
		{
			$("#middle_name_err").fadeIn().html("Please enter Middle Name").css('color','red');
			setTimeout(function(){   
				$("#middle_name_err").html("&nbsp;");},3000);
			$(".middle_name").focus();
			return false;
		}
		var last_name=$(".last_name").val().trim();
	if(last_name=="")
		{
			$("#last_name_err").fadeIn().html("Please enter Last Name").css('color','red');
			setTimeout(function(){   
				$("#last_name_err").html("&nbsp;");},3000);
			$(".last_name").focus();
			return false;
		}
			var birthday_date=$(".birthday_date").val().trim();
	if(birthday_date=="")
		{
			$("#birthday_date_err").fadeIn().html("Please Select Birth day").css('color','red');
			setTimeout(function(){   
				$("#birthday_date_err").html("&nbsp;");},3000);
			$(".birthday_date").focus();
			return false;
		}
		var guardian=$(".guardian").val().trim();
	if(guardian=="")
		{
			$("#guardian_err").fadeIn().html("Please enter Guardian Name").css('color','red');
			setTimeout(function(){   
				$("#guardian_err").html("&nbsp;");},3000);
			$(".guardian").focus();
			return false;
		}
		var gender=$(".gender").val().trim();
	if(gender=="")
		{
			$("#gender_err").fadeIn().html("Please enter Gender").css('color','red');
			setTimeout(function(){   
				$("#gender_err").html("&nbsp;");},3000);
			$(".gender").focus();
			return false;
		}
		var caste=$(".caste").val().trim();
	if(caste=="")
		{
			$("#caste_err").fadeIn().html("Please enter Caste").css('color','red');
			setTimeout(function(){   
				$("#caste_err").html("&nbsp;");},3000);
			$(".caste").focus();
			return false;
		}
		var caste=$(".caste").val().trim();
	if(caste=="")
		{
			$("#caste_err").fadeIn().html("Please enter Caste").css('color','red');
			setTimeout(function(){   
				$("#caste_err").html("&nbsp;");},3000);
			$(".caste").focus();
			return false;
		}
		var religion=$(".religion").val().trim();
	if(religion=="")
		{
			$("#religion_err").fadeIn().html("Please enter religion").css('color','red');
			setTimeout(function(){   
				$("#religion_err").html("&nbsp;");},3000);
			$(".religion").focus();
			return false;
		}
		var home_state=$(".home_state").val().trim();
	if(home_state=="")
		{
			$("#home_state_err").fadeIn().html("Please enter home state").css('color','red');
			setTimeout(function(){   
				$("#home_state_err").html("&nbsp;");},3000);
			$(".home_state").focus();
			return false;
		}
		var home_city=$(".home_city").val().trim();
	if(home_city=="")
		{
			$("#home_city_err").fadeIn().html("Please enter home City").css('color','red');
			setTimeout(function(){   
				$("#home_city_err").html("&nbsp;");},3000);
			$(".home_city").focus();
			return false;
		}
		var blood_group=$(".blood_group").val().trim();
	if(blood_group=="")
		{
			$("#blood_group_err").fadeIn().html("Please enter Blood Group").css('color','red');
			setTimeout(function(){   
				$("#blood_group_err").html("&nbsp;");},3000);
			$(".blood_group").focus();
			return false;
		}
	/*	var designation=$(".designation").val().trim();
	if(designation=="")
		{
			$("#designation_err").fadeIn().html("Please enter designation").css('color','red');
			setTimeout(function(){   
				$("#designation_err").html("&nbsp;");},3000);
			$(".designation").focus();
			return false;
		}*/
		var present_address=$(".present_address").val().trim();
	if(present_address=="")
		{
			$("#present_address_err").fadeIn().html("Please enter present_address").css('color','red');
			setTimeout(function(){   
				$("#present_address_err").html("&nbsp;");},3000);
			$(".present_address").focus();
			return false;
		}
		var present_state=$(".present_state").val().trim();
	if(present_state=="")
		{
			$("#present_state_err").fadeIn().html("Please enter present_state").css('color','red');
			setTimeout(function(){   
				$("#present_state_err").html("&nbsp;");},3000);
			$(".present_state").focus();
			return false;
		}	
		var district=$(".district").val().trim();
	if(district=="")
		{
			$("#district_err").fadeIn().html("Please enter district").css('color','red');
			setTimeout(function(){   
				$("#district_err").html("&nbsp;");},3000);
			$(".district").focus();
			return false;
		}
		var pin_code=$(".pin_code").val().trim();
	if(pin_code=="")
		{
			$("#pin_code_err").fadeIn().html("Please enter pin_code").css('color','red');
			setTimeout(function(){   
				$("#pin_code_err").html("&nbsp;");},3000);
			$(".pin_code").focus();
			return false;
		}
		var mobile_no=$(".mobile_no").val().trim();
	if(mobile_no=="")
		{
			$("#mobile_no_err").fadeIn().html("Please enter mobile_no").css('color','red');
			setTimeout(function(){   
				$("#mobile_no_err").html("&nbsp;");},3000);
			$(".mobile_no").focus();
			return false;
		}
			var email_id=$(".email_id").val().trim();
	if(email_id=="")
		{
			$("#email_id_err").fadeIn().html("Please enter email_id").css('color','red');
			setTimeout(function(){   
				$("#email_id_err").html("&nbsp;");},3000);
			$(".email_id").focus();
			return false;
		}
			var gmobile_no=$(".gmobile_no").val().trim();
	if(gmobile_no=="")
		{
			$("#gmobile_no_err").fadeIn().html("Please enter gmobile_no").css('color','red');
			setTimeout(function(){   
				$("#gmobile_no_err").html("&nbsp;");},3000);
			$(".gmobile_no").focus();
			return false;
		}
        var guardian_type=$(".guardian_type").val().trim();
    if(guardian_type=="")
        {
            $("#guardian_type_err").fadeIn().html("Please enter guardian_type").css('color','red');
            setTimeout(function(){   
                $("#guardian_type_err").html("&nbsp;");},3000);
            $(".guardian_type").focus();
            return false;
        }
			var appointment=$(".appointment").val().trim();
	if(appointment=="")
		{
			$("#appointment_err").fadeIn().html("Please enter appointment").css('color','red');
			setTimeout(function(){   
				$("#appointment_err").html("&nbsp;");},3000);
			$(".appointment").focus();
			return false;
		}
		
			var office_name=$(".office_name").val().trim();
	if(office_name=="")
		{
			$("#office_name_err").fadeIn().html("Please enter office_name").css('color','red');
			setTimeout(function(){   
				$("#office_name_err").html("&nbsp;");},3000);
			$(".office_name").focus();
			return false;
		}
		
			var office_join=$(".office_join").val().trim();
	if(office_join=="")
		{
			$("#office_join_err").fadeIn().html("Please enter office_join").css('color','red');
			setTimeout(function(){   
				$("#office_join_err").html("&nbsp;");},3000);
			$(".office_join").focus();
			return false;
		}
			var basic_salary=$(".basic_salary").val().trim();
	if(basic_salary=="")
		{
			$("#basic_salary_err").fadeIn().html("Please enter basic_salary").css('color','red');
			setTimeout(function(){   
				$("#basic_salary_err").html("&nbsp;");},3000);
			$(".basic_salary").focus();
			return false;
		}
		

		
	}
	
</script>
<script type="text/javascript">
    
</script>
<script>
    $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
    minDate:new Date()

});

</script>
	

















