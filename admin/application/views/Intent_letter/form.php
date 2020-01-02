<style>
    textarea {
        resize: none;
    }
</style>
<!-- <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link> -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Intent_letter/index'); ?>">Manage Intent Letter</a></li>
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
                                    <label class="control-label">Name <span style="color:red;">* </span></label>
                                    <span style="color:red" id="name_err"> </span>
                                    <?php echo form_error('name')?>
                                    <input type="text" placeholder="Enter Name" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile No. <span style="color:red;">* </span></label>
                                    <span style="color:red" id="mobile_err"> </span>
                                    <?php echo form_error('mobile')?>
                                    <input type="text" placeholder="Enter Mobile No." class="form-control" id="mobile" name="mobile" maxlength="10" value="<?php echo $mobile; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email ID <span style="color:red;">* </span></label>
                                    <span style="color:red" id="email_err"> </span>
                                    <?php echo form_error('email')?>
                                    <input type="text" placeholder="Enter Email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date <span style="color:red;">* </span></label>
                                    <span style="color:red" id="date_err"> </span>
                                    <?php echo form_error('date')?>
                                    <input type="text" placeholder="Enter Date" class="form-control mydatepicker" id="date" name="date" value="<?php echo $date; ?>">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Designation <span style="color:red;">* </span></label>
                                    <span style="color:red" id="designation_id_err"> </span>
                                    <?php echo form_error('designation_id')?>
                                <select name="designation_id" class="form-control" id="designation_id">
                                 <option value="">--Select Designation--</option>
                                 <?php if(!empty($designation_name)){ foreach($designation_name as $row){?>
                                 <option value="<?php echo $row->id;?>"<?php if($designation_id==$row->id){ echo "selected"; }?>>
                                               
                                     <?php echo $row->designation_name;?></option>
                                 <?php } } ?>  
                                </select>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address <span style="color:red;">* </span></label>
                                    <span style="color:red" id="address_err"> </span>
                                    <?php echo form_error('address')?>
                                    <textarea type="text" placeholder="Enter Address" class="form-control" id="address" name="address"> <?php echo $address; ?></textarea>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="address_err"> </span>
                                    <?php echo form_error('certificate_id')?>
                                    <textarea type="text" placeholder="Enter Address" class=" ckeditor form-control" id="certificate_id" name="certificate_id"> <?php if (!empty($description)){echo $description;}else{ echo "";} ?></textarea>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return validation()"><?= $button ?></button>
                           <a href="<?= site_url('Intent_letter');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                          </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer');?>
<!-- <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script> -->
<script  src="<?php echo base_url('assets/custom_js/Intent_letter.js') ?>" type="text/javascript"></script>

<script type="text/javascript">
   jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();   



     
</script>