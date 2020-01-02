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
            <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('CategoryMaster/index'); ?>">Manage Category</a></li>
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
                                    <label class="control-label">Category Name<span style="color:red;">*</span></label> <span style="color:red" id="cat_name_err"> </span><?php echo form_error('cat_name')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Category Name" class="form-control" id="cat_name" name="cat_name" value="<?php echo $cat_name; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Image
                                    <span style="color:red;">*</span> </label><span style="color:red" id="image_err"> </span><span style="color:red"><!-- < ?php echo form_error('company_logo')?> </span> -->
                                    <input type="file" placeholder="Category" class="form-control" id="image" name="image">
                                    <?php if($button!='Create'){?>
                                        <img src="<?= base_url('uploads/categories/'.$image);?>" width="50px">
                                        <input type="hidden" name="old_image" id="old_image" value="<?= $image; ?>">
                                    <?php }?>
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
                                        <a href="<?php echo site_url('CategoryMaster/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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

<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
</script>

<script type="text/javascript">
    function check_error() 
    {
        var cat_name = $("#cat_name").val().trim();
        var image = $("#image").val().trim();
        var button = $("#button").val().trim();

        if(cat_name== "") 
        {
            $("#cat_name_err").fadeIn().html("Please enter Category");
            setTimeout(function() 
            {
                $("#cat_name_err").fadeOut();
            }, 3000);
            $("#cat_name").focus();
            return false;
        }
        if(button=='Create')
        {

            if(image=="") 
            {
                $("#image_err").fadeIn().html("Please Select Image");
               setTimeout(function() 
                {
                    $("#image_err").fadeOut();
                }, 3000);
                $("#image").focus();
                return false;
            }

        }



        }
</script>