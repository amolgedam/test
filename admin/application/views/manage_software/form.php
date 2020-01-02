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
            <li><a href="<?php echo site_url('Manage_Software'); ?>">Manage Software Details</a></li>
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
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Software Title <span style="color:red;">*</span></label> <span style="color:red" id="software_title_err"> </span>
                                    <select name="software_title_id" id="software_title_id" class="form-control" >
                                             <option value="">Select</option>
                                            <?php if(!empty($software)){ foreach ($software as $key) {?>
                                                
                                                <option value="<?= $key->id; ?>" <?php if ($software_title_id==$key->id) { echo "selected";
                                                }?>><?= $key->title; ?></option>
                                            <?php }} ?>
                                            
                                            
                                        </select>
                                    
                                </div>
                            </div> -->
                             <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Software Details<span style="color:red;">*</span></label> <span  style="color:red" id="software_details_err" class= "software_details_err"><?php echo form_error('software_details');?></span>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Software Details" class="form-control" id="software_details" name="software_details" value="<?php echo $software_details;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                              
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Manage_Software/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer');?>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>

<script type="text/javascript">
    function check_error() 
    {
        var software_details = $("#software_details").val().trim();
     
         if(software_details=='')
        {
            $("#software_details_err").fadeIn().html("Please enter software details").css("color","red");
            setTimeout(function(){$("#software_details_err").fadeOut("&nbsp;");},2000)
            $("#software_details").focus();
            return false;
        }    
    }
</script>
