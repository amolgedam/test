<?php $this->load->view('common/header');
$this->load->view('common/left_panel'); ?>
<style type="text/css" media="screen">
	.red{color:red;}
	#file { width:0; height:0; }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<div>&nbsp;<?php echo $heading; ?></div>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">
				<?= $heading;?>
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<div class="col-md-4">&nbsp;&nbsp;</div>
						<div class="col-md-4"></div>
						<div class="clearfix"></div>
					</div>
					<div class="box-body">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#home">Profile Details</a></li>
							<li><a data-toggle="tab" href="#menu1">Banks Details</a></li>
							<li><a data-toggle="tab" href="#menu2">Document Details</a></li>
						</ul>
						<br>
						<br>
						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<form method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
									<div class="row">
										
										 <div class="col-md-6">
											<div class="form-group">
												<label>Profile<span class="red" id="errr">*</span></label>
												<input type="file" class="form-control" name="profile" placeholder="" id="profile" />
											</div>

											<?php if(!empty($profile)) { ?>
											<img src="<?php echo base_url('uploads/document/'.$profile);?>" style="height:100px;width:100px;">
											<?php } ?>
												<input type="hidden" name="profile_old" value="<?php echo $profile;?>">
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>Name<span class="red" id="errr">*</span></label>
												<input type="text" class="form-control" name="name" placeholder="Site Name" id="name"  value="<?php echo $name;?>" readonly />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Email </label><span class="red">*</span>
												<input type="text" class="form-control" placeholder="Email" name="email" id="email"  value="<?php echo $email; ?>" readonly/>
											</div>
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>Pawword </label><span class="red">*</span>
												<input type="text" class="form-control" placeholder="Password" name="password" id="password"  value="<?php echo $password; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Mobile <span class="red">*</span><span class="red" id=""></span></label>
												<input type="text" placeholder="Mobile" class="form-control" name="mobile_no" id="mobile_no" onkeypress="only_number(event)" maxlength="10" value="<?php echo $mobile_no;?>" readonly/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												 <label class="control-label">D.O.B <span style="color:red">*</span>
          										  <span style="color:red" id="birthday_err"> </span></label>
												<input type="date" placeholder="birthday" class="birthday form-control " name="birthday"  id="datepicker" value="<?php echo $birthday;?>"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Designation <span class="red">*</span><span class="red" id=""></span></label>
												<input type="text" placeholder="designation" class="form-control" name="designation_id" id="designation_id" onkeypress="only_number(event)" maxlength="10" value="<?php echo $designation_name;?>" readonly />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Joining Date <span style="color:red">*</span><span style="color:red" id="joining_err"></span></label>
												<input type="date" placeholder="" class="joining form-control" name="joining_date" id=""  maxlength="10" value="<?php echo $joining_date;?>"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Address<span style="color:red">*</span>
          										  <span style="color:red" id="address_err"> </span></label>
												<textarea class="address form-control" rows="3" placeholder="Address" name="address" id="address" style="resize: none"><?php echo $address ?></textarea>
											</div>
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary
          										 </label>
												<input type="text" placeholder="Enter Salary" class="salary form-control" name="salary" id=""  maxlength="10" value="<?php echo $salary;?>" readonly/>
											</div>
										</div>
										<input type="hidden" name="id" value="<?php echo $id; ?>">
									</div>
									<button type="submit" class="btn btn-info btn-sm pull-right" name="submit" onclick="return validation()"><?php echo $button; ?></button>
									<a href="<?php echo site_url('Welcome/dashboard') ?>" class="btn btn-danger btn-sm">Cancel</a>
								</form>
							</div>
							<div id="menu1" class="tab-pane fade">
								<form method="post" action="<?php echo $action1; ?>" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Bank Name<span style="color:red">*</span>
          										  <span style="color:red" id="bank_err"> </span></label>
													<input type="text" class="bank form-control" name="bank_name" placeholder="Bank Name" id="bank_name"  value="<?php echo $bank_name;?>" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Account No.<span style="color:red">*</span>
          										  <span style="color:red" id="account_err"> </span></label>
													<input type="text" class="account form-control" placeholder="Enter Account No" name="account" id="email"  value="<?php echo $account; ?>"/>
												</div>
											</div> 
											<div class="col-md-6">
												<div class="form-group">
													<label>Ifsc Code <span style="color:red">*</span>
          										  <span style="color:red" id="ifsc_err"> </span></label>
													<input type="text" placeholder="Enter Ifsc" class=" ifsc form-control" name="ifsc" id="ifsc"  value="<?php echo $ifsc;?>" />
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-info btn-sm pull-right" onclick="return validation_bank()" name="submit"><?php echo $button ?></button>
										<a href="<?php echo site_url('Welcome/dashboard') ?>" class="btn btn-danger btn-sm">Cancel</a>
									</form> 
								</div>
								<div id="menu2" class="tab-pane fade">
									<form method="post" action="<?php echo $action2; ?>" enctype="multipart/form-data">
										<div class="col-md-12">
											<div class="form-group">
												<label>Candidate Type:<span style="color:red">*</span>
          										  <span style="color:red" id="experience_err"> </span></label>
												<label class="radio-inline">
													<input class="experience" type="radio" value="experience" name="experience" id="experience" unchecked onclick="myFunction(this.value)">Experience</label>
													<label class="radio-inline">
														<input  class="experience" type="radio" value="fresher"  name="experience" id="no" onclick="myFunction(this.value)">Freshers</label>
													</div>
												</div> 
												<div  class="col-md-12"  id="user1" style="display:none;">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Final Marksheet <span style="color:red">*</span>
          										 			 <span style="color:red" id="final_err"> </span></label>
															<input type="file" class="final form-control" name="final" placeholder="" id="final">
															
															<?php if(!empty($final)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$final);?>" style="height:100px;width:100px;">
														<?php }  ?>
														<input type="hidden" name="final_old" value="<?php echo $final;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Final Degree<span style="color:red">*</span>
          										 			 <span style="color:red" id="degree_err"> </span></label>
															<input type="file" class="degree form-control" name="degree" placeholder="" id="degree"  />
															
															<?php if(!empty($degree)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$degree);?>" style="height:100px;width:100px;">
														<?php } ?>
														<input type="hidden" name="degree_old" value="<?php echo $degree;?>">

														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Adhaar Card<span style="color:red">*</span>
          										 			 <span style="color:red" id="adhar_err"> </span></label>
															<input type="file" class="adhar form-control" name="adhar" placeholder="" id="adhar"  value="<?php echo $adhar;?>"  />
															<?php if(!empty($adhar)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$adhar);?>" style="height:100px;width:100px;">
														<?php } ?>
														<input type="hidden" name="adhar_old" value="<?php echo $adhar;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >PAN Card<span style="color:red">*</span>
          										 			 <span style="color:red" id="pan_err"> </span></label>
															<input type="file" class="pan form-control" name="pan" placeholder="" id="pan"  value="< ?php echo $pan;?>"  /><br>
															<?php if(!empty($pan)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$pan);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="pan_old" value="<?php echo $pan;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Experience Certificate<span style="color:red">*</span>
          										 			 <span style="color:red" id="experience_cer_err"> </span></label>
															<input type="file" class="experience_cer form-control" name="experience_cer" placeholder="" id="experience"  value="< ?php echo $experience_cer;?>"/><br>
																<?php if(!empty($experience_cer)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$experience_cer);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="experience_cer_old" value="<?php echo $experience_cer ;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Relieving Letter<span style="color:red">*</span>
          										 			 <span style="color:red" id="relieving_cer_err"> </span></label>
															<input type="file" class="relieving_cer form-control" name="relieving_cer" placeholder="" id="relieving_cer"  value="< ?php echo $relieving_cer;?>"/>
																<?php if(!empty($relieving_cer)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$relieving_cer);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="relieving_cer_old" value="<?php echo $relieving_cer ;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" > Salary Slip<span style="color:red">*</span>
          										 			 <span style="color:red" id="payment_slip_err"> </span></label>
															<input type="file" class="payment_slip form-control" name="payment_slip" placeholder="" id="payment_slip"  value="< ?php echo $payment_slip;?>"  />
																<?php if(!empty($payment_slip)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$payment_slip);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="payment_slip_old" value="<?php echo $payment_slip;?>">
														</div>
													</div>
												</div>
												<div  class="col-md-12"  id="user2" style="display:none;">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" > Final Marksheet<span style="color:red">*</span>
          										 			 <span style="color:red" id="final_marksheet_err"> </span></label>
															<input type="file" class="final_marksheet form-control" name="final_marksheet" placeholder="" id="final_marksheet"  value="< ?php echo $final_marksheet;?>"  />
															<?php if(!empty($final_marksheet)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$final_marksheet);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="final_marksheet_old" value="<?php echo $final_marksheet;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" > Final Degree<span style="color:red">*</span>
          										 			 <span style="color:red" id="final_degree_err"> </span></label>
															<input type="file" class="final_degree form-control" name="final_degree" placeholder="" id="final_degree"  value="< ?php echo $final_degree;?>"  />
															<?php if(!empty($final_degree)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$final_degree);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="final_degree_old" value="<?php echo $final_degree;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >Adhaar Card<span style="color:red">*</span>
          										 			 <span style="color:red" id="final_degree_err"> </span></label>
															<input type="file" class="form-control" name="final_adhar" placeholder="" id="final_adhar"  value="< ?php echo $final_adhar;?>"  />
															<?php if(!empty($final_adhar)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$final_adhar);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="final_adhar_old" value="<?php echo $final_adhar;?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" >PAN Card<span style="color:red">*</span>
          										 			 <span style="color:red" id="final_pan_err"> </span></label>
															<input type="file" class="final_pan form-control" name="final_pan" placeholder="" id="final_pan"  value="< ?php echo $final_pan;?>"  />
															<?php if(!empty($final_pan)) { ?>
															<img src="<?php echo base_url('uploads/document/'.$final_pan);?>" style="height:100px;width:100px;">
														<?php } ?>

															<input type="hidden" name="final_pan_old" value="<?php echo $final_pan;?>">
															<input type="hidden" name="id">
														</div>
													</div>
												</div>
												<button type="submit" class="btn btn-info btn-sm pull-right" onclick="return validation_doc()" name="submit"><?php echo $button ?></button>
												<a href="<?php echo site_url('Welcome/dashboard') ?>" class="btn btn-danger btn-sm">Cancel</a>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/custom_js/settings.js"></script>
<script type="text/javascript">
function myFunction(val)
{
if(val=='experience')
{
$("#user1").show();
$("#user2").hide();
}
else
{
$("#user1").hide();
$("#user2").show();
}
}
</script>
<script>
$(document).ready(function(){
$( "#datepicker" ).datepicker({
changeMonth: true,
changeYear: true
});
});
</script>

<script> 
	function validation()
	{
		var birthday=$(".birthday").val().trim();
		var joining=$(".joining").val().trim();
		var address=$(".address").val().trim();
	
		if(birthday=="")
		{
			$("#birthday_err").fadeIn().html("Please enter birth date").css('color','red');
			setTimeout(function(){   
				$("#birthday_err").html("&nbsp;");},3000);
			$(".birthday").focus();
			return false;
		}
		if(joining=="")
		{
			$("#joining_err").fadeIn().html("Please enter Joining date").css('color','red');
			setTimeout(function(){   
				$("#joining_err").html("&nbsp;");},3000);
			$(".joining").focus();
			return false;
		}
		if(address=="")
		{
			$("#address_err").fadeIn().html("Please enter address").css('color','red');
			setTimeout(function(){   
				$("#address_err").html("&nbsp;");},3000);
			$(".address").focus();
			return false;
		}
	
		
	}
	function validation_bank()
	{
		var bank =$(".bank").val().trim();
		var account=$(".account").val().trim();
		var ifsc=$(".ifsc").val().trim();


		if(bank=="")
		{
			$("#bank_err").fadeIn().html("Please enter bank").css('color','red');
			setTimeout(function(){   
				$("#bank_err").html("&nbsp;");},3000);
			$(".bank").focus();
			return false;
		}
		if(account=="")
		{
			$("#account_err").fadeIn().html("Please enter account").css('color','red');
			setTimeout(function(){   
				$("#account_err").html("&nbsp;");},3000);
			$(".account").focus();
			return false;
		}
		if(ifsc=="")
		{
			$("#ifsc_err").fadeIn().html("Please enter ifsc").css('color','red');
			setTimeout(function(){   
				$("#ifsc_err").html("&nbsp;");},3000);
			$(".ifsc").focus();
			return false;
		}
	}
	function validation_doc()
	{
		var experience=$(".experience").val().trim();

		if(experience=="")
		{
			$("#experience_err").fadeIn().html("Please enter experience").css('color','red');
			setTimeout(function(){   
				$("#experience_err").html("&nbsp;");},3000);
			$(".experience").focus();
			return false;
		}
	}
</script>