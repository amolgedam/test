<?php $this->load->view('common/header');
$this->load->view('common/left_panel'); ?>
<style type="text/css" media="screen">
	.red{color:red;}
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
                       <form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Site Name <span class="red">*</span><span class="red" id="error_sitetitle"></span></label>
								<input type="text" class="form-control" name="site_name" placeholder="Site Name" id="sitetitle"  value="<?php echo $site_name;?>" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email <span class="red">*</span><span class="red" id="error_email"></span></label>
								<input type="text" class="form-control" placeholder="Email" name="email" id="email"  value="<?php echo $email; ?>"/>
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Alternate Email <span class="red">*</span><span class="red" id="alternate_email_err"></span></label>
								<input type="text" class="form-control" placeholder="Alternate Email" name="alternate_email" id="alternate_email"  value="<?php echo $alternate_email; ?>"/>
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Mobile <span class="red">*</span><span class="red" id="error_phone"></span></label>
								<input type="text" placeholder="Mobile" class="form-control" name="mobile" id="phone" onkeypress="only_number(event)" maxlength="10" value="<?php echo $mobile;?>"/>
							</div>
						</div>
							<div class="col-md-6">
							<div class="form-group">
								<label>Alternate Mobile <span class="red">*</span><span class="red" id="alternate_mobile_err"></span></label>
								<input type="text" placeholder="Mobile" class="form-control" name="alternate_mobile" id="alternate_mobile" onkeypress="only_number(event)" maxlength="10" value="<?php echo $alternate_mobile;?>"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Copyright <span class="red">*</span><span class="red" id="error_footer"></span></label>
								<input type="text" placeholder="Copyright" class="form-control" name="copyright" id="footer" value="<?php echo $copyright?>"/>
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Address <span class="red">*</span><span class="red" id="error_address"></span></label>
								<textarea class="form-control" rows="3" placeholder="Address" name="address" id="address" style="resize: none"><?php echo $address?></textarea>
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Terms And Condition <span class="red">*</span><span class="red" id="error_terms_and_condition"></span></label>
								<textarea class="form-control" rows="3" placeholder="Terms And Condition" name="terms_and_condition" id="terms_and_condition" style="resize: none"><?php echo $terms_and_condition?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account No <span class="red">*</span><span class="red" id="error_terms_and_condition"></span></label>
								<input type="text" placeholder="Account No" class="form-control" name="account_no" id="account_no" value="<?php echo $account_no?>"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>IFSC Code<span class="red">*</span><span class="red" id="error_terms_and_condition"></span></label>
								<input type="text" placeholder="IFSC Code" class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $ifsc_code?>"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>GST No<span class="red">*</span><span class="red" id="error_terms_and_condition"></span></label>
								<input type="text" placeholder="GST No" class="form-control" name="gst_no" id="gst_no" value="<?php echo $gst_no?>"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>PAN No<span class="red">*</span><span class="red" id="error_terms_and_condition"></span></label>
								<input type="text" placeholder="PAN No" class="form-control" name="pan_no" id="pan_no" value="<?php echo $pan_no?>"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Favicon <span class="red">*</span><span class="red" id="error_favicon"></span></label>
								<input type="file" value="<?php echo $favicon ;?>" name="favicon" id="favicon" class="form-control" />
								<input type="hidden" name="old_favicon" value="<?php echo $favicon;?>">
								<br>
								<?php if($favicon!='')  { ?>
									<img style="height:25px;width:25px" src="<?php echo base_url(); ?>uploads/logo/<?php echo $favicon ?>" class="img-responsive img-thumbnail" alt="">
								<?php } ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Logo <span class="red">*</span><span class="red" id="error_logo"></span></label>
								<input type="file" value="<?php echo $logo ;?>" name="logo" id="logo" class="form-control" />
								<input type="hidden" name="old" value="<?php echo $logo;?>">
								<br>
								<?php if($logo!='')  { ?>
									<img style="height:64px;width:70px" src="<?php echo base_url(); ?>uploads/logo/<?php echo $logo ?>" class="img-responsive img-thumbnail" alt="">
								<?php } ?>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					</div>
					<button type="submit" class="btn btn-info btn-sm pull-right" onclick="return validateinfo()"><?php echo $button ?></button>
					<a href="<?php echo site_url('Welcome/dashboard') ?>" class="btn btn-danger btn-sm">Cancel</a>
				</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/custom_js/settings.js"></script>