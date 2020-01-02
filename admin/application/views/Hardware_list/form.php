<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $headinggg; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Cities/index'); ?>">Manage Company</a></li>
            <li class="active">
                <?= $headinggg;?>
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
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Service Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="ser_err"> </span>
                                    <select class="form-control" id="ser_heading" name="ser_heading">
                                        <option value="">Select Service Heading </option>
                                        <?php if(!empty($serHeading)) {?>
                                        <?php foreach($serHeading as $row) {?>
                                        
                                        <option value="<?php echo $row->id ?>" <?php if($row->id==$page_heading_id) { echo 'selected'; }?>><?php echo $row->heading; ?></option>
                                    <?php }?>
                                <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Service List Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                    <?php echo form_error('heading')?>
                                    <input type="text" placeholder="Enter Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Service List Description</label>
                                    
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Description"><?php echo $description;?></textarea>
                                </div>
                            </div>

                            <div class="clearfix">&nbsp;</div>
                            <input type="hidden" name="button" id="button" value="<?php echo $button; ?>">
                          <div class="box-footer">
                            
                           <a href="<?= site_url('Hardware_list');?>"><button type="button"  class="btn btn-danger pull-right">Cancel</button></a>
                           <button type="submit" class="btn btn-primary pull-right" onclick="return check_error()"><?= $button ?></button>&nbsp;&nbsp;&nbsp;&nbsp;
                          </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer');?>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script type="text/javascript">
   var url="";
   var actioncolumn="";

function check_error() 
{
    var ser_heading= $('#ser_heading').val();
    var heading= $('#heading').val();
    var button=$("#button").val().trim();
    var id = $('#id').val();
    
    
    if ($.trim(ser_heading) == "") 
    {
        $("#ser_err").fadeIn().html("Enter Heading");
        setTimeout(function() {
            $("#ser_err").fadeOut();
        }, 3000);
        $("#ser_heading").focus();
        return false;
    }

    if ($.trim(heading) == "") 
    {
        $("#heading_err").fadeIn().html("Enter Heading");
        setTimeout(function() {
            $("#heading_err").fadeOut();
        }, 3000);
        $("#heading").focus();
        return false;
    }
    
   
}

</script>

