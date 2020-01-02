<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Aboutus/index'); ?>">About Us </a></li>
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
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Heading <span style="color:red;">* </span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                 <input type="text" placeholder="Enter Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                </div>
                            </div>
                            
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="des_err"> </span>
                        <textarea type="text" class="form-control ckeditor" id="description" name="description"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Aboutus');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
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
   

function check_error() 
{
    var heading = $("#heading").val().trim();
    var description= CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
//alert(description);return false;
    if (heading== "") 
    {
        $("#heading_err").fadeIn().html("Please enter Heading");
        setTimeout(function() {$("#heading_err").fadeOut();}, 3000);
        $("#heading").focus();
        return false;
    }
    if (description== 0) 
    {
        $("#des_err").fadeIn().html("Please enter Description");
        setTimeout(function() { $("#des_err").fadeOut();}, 3000);
        $("#description").focus();
        return false;
    }
    // if ($.trim(image) == "") 
    // {
    //     $("#image_err").fadeIn().html("Select image");
    //     setTimeout(function() {
    //         $("#image_err").fadeOut();
    //     }, 3000);
    //     $("#image").focus();
    //     return false;
    // }
}

     
</script>