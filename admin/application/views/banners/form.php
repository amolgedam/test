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
                            
                            <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Image">Image <span style="color:red;">*</span></label> <span style="color:red;" id="image_err"></span>
                    <input type="file" name="image" id="image"  class="inputfile form-control" accept="/*" onclick="imageFile();" />&nbsp;<br/>
                    <input type="hidden" name="old_image" value="<?php echo $image?>" />
                    <?php  if($button=='Update'){  if(!empty($image))
                      {if(!file_exists("uploads/banners/".$image)) { ?>
                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                      <?php } else { ?>
                        <img src="<?php echo base_url('uploads/banners/'.    $image)?>" width="100px" height="100px" id="thumb" alt="No Image">
                      <?php } } else { ?>
                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                      <?php }} ?>
                    </div>        
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                  </div>
                           
                           
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <input type="hidden" name="button" id="button" value="<?php echo $button; ?>">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Banner');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
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
    var image=$("#image").val().trim();
    var button=$("#button").val().trim();

    if (button=="Create") 
      {
        if(image=="")
        {
            $("#image_err").fadeIn().html("Please Select Banner Image").css('color','red');
            setTimeout(function(){$("#image_err").html("&nbsp;");},3000);
            $("#image").focus();
            return false;
        }
      } 
} 
</script>