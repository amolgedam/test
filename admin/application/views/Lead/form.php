<link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
<style>
    textarea {
        resize: none; 
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Lead'); ?>">Manage Lead</a></li>
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
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Client Name <span style="color:red;">*</span></label> <span style="color:red" id="client_err"><?php echo form_error('client_name') ?></span>
                                    <input type="text" placeholder="Enter Client Name" class="form-control" id="client_name" name="client_name" value="<?php echo $client_name ?>" onkeypress="only_alphabets(event)">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Company/Business Name <span style="color:red;">*</span></label> <span style="color:red" id="comp_err"><?php echo form_error('client_name') ?></span>
                                    <input type="text" placeholder="Enter Company Name" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Client Mobile <span style="color:red;">*</span></label> <span style="color:red" id="mobile_err"><?php echo form_error('client_mobile') ?></span>
                                    <input type="text" placeholder="Enter mobile" class="form-control" id="client_mobile" name="client_mobile" value="<?php echo $client_mobile ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email <span style="color:red;"></span></label> <span style="color:red" id="email_err"><?php echo form_error('email') ?></span>
                                    <input type="email" placeholder="Enter email" class="form-control" id="email" name="email" value="<?php echo $email ?>" >
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Required Product <span style="color:red;">*</span></label> <span style="color:red" id="prduct_err"><?php echo form_error('requred_product') ?></span>
                                    <input type="text" placeholder="Enter requred product" class="form-control" id="requred_product" name="requred_product" value="<?php echo $requred_product ?>" onkeypress="only_alphabets(event)">
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label class="control-label">Appointment Date <span style="color:red;">*</span></label> <span style="color:red" id="adate_err"><?php echo form_error('appoint_date') ?></span>
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text"  placeholder="Enter appoint_date" class="form-control" id="appoint_date" name="appoint_date" value="<?php echo $appoint_date ?>">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group clockpicker">
                                        <label class="control-label">Appointment Time <span style="color:red;">*</span></label> <span style="color:red" id="appoint_err"><?php echo form_error('appoint_date') ?></span>
                                        <input type="text" placeholder="Enter appointment time" class="form-control  timepicker" id="appoint_time" name="appoint_time" value="<?php echo $appoint_date ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Followup Date <span style="color:red;"></span></label> <span style="color:red" id="fdate_err"><?php echo form_error('follop_date') ?></span>
                                     <div class="input-group date" data-provide="datepicker">
                                    <input type="text" placeholder="Enter follop date" class="form-control" id="follop_date" name="follop_date" value="<?php echo $follop_date ?>" >
                                     <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alternet no <span style="color:red;"></span></label> <span style="color:red" id="no_err"><?php echo form_error('date') ?></span>
                                    <input type="text" placeholder="Enter alternet no" class="form-control" id="alternet_no" name="alternet_no" value="<?php echo $alternet_no ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address <span style="color:red;">*</span></label> <span style="color:red" id="add_err"><?php echo form_error('title') ?></span>
                                    <textarea placeholder="Enter address" class="form-control" id="address" name="address"><?php echo $address ?></textarea>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Remark<span style="color:red;"></span></label> <span style="color:red" id="no_err"><?php echo form_error('remark') ?></span>
                                    <textarea class="form-control" placeholder="Enter Remark" id="remark" name="remark"><?php echo $remark ?></textarea>
                                </div>
                                <input type="hidden" id="flag" name="flag" value="<?php echo $flag?>">
                            </div>

                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()"><?php echo $button; ?>
                                        </button>
                                        <?php if(!empty($flag)) { ?>
                                        <a href="<?php echo site_url('Lead/index/'.$flag) ?>" class="btn btn-danger" type="button">Cancel</a>
                                    <?php }else { ?>
                                        <a href="<?php echo site_url('Lead/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url('assets/custom_js/lead.js');?>"></script>
<script type="text/javascript" src="dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>
