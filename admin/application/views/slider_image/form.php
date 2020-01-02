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
           <!--  <li><a href="< ?php echo site_url('Cities/index'); ?>">Manage Company</a></li> -->
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
                                    <label class="control-label">Select Image <span style="color:red;">*</span></label>
                                    <span style="color:red" id="image_err"> </span>
                                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                                    <p>Note:Please select jpg and png images</p>
                                    <?php if(!empty($image_data)) {?>
                                        <?php foreach($image_data as $img){ ?>
                                    <div class="col-md-3">
                                  <p>  <img src="<?= base_url('uploads/Client_image/'.$img->image); ?>" width="200px" height="200px" style="margin-top:5px;"><!-- &nbsp; <center>
<a href=" "class="btn btn-danger"  onclick="myFunction(< ?php echo $img->id;?>)">Remove</a> </center></p> -->
                                          &nbsp;&nbsp;&nbsp;&nbsp;
                                     </div>
                                     
                                  <?php } } ?>

                                </div>
                            </div>
                           
                           
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Products');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
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
    var title = $("#title").val().trim();
    var type= $('#type').val();
   
    if ($.trim(title) == "") 
    {
        $("#title_err").fadeIn().html("Please enter Title");
        setTimeout(function() {
            $("#title_err").fadeOut();
        }, 3000);
        $("#title").focus();
        return false;
    }
    if ($.trim(type) == "") 
    {
        $("#type_err").fadeIn().html("Select Type");
        setTimeout(function() {
            $("#type_err").fadeOut();
        }, 3000);
        $("#type").focus();
        return false;
    }
}


</script>