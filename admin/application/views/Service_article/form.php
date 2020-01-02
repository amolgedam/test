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
            <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Service_article/index'); ?>">Manage Service-Article</a></li>
            <li class="active"><?= $heading;?></li>
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
                    <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" >
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_heading_id">Service Heading<span style="color:red;">*</span></label><span style="color:red" id="ser_err"><?php echo form_error('service_heading_id') ?></span>
                                    <select name="service_heading_id" id="service_heading_id" class="form-control">
                                        <option value="">--Select heading--</option>
                                        <?php foreach ($serviceheading as $ser) { ?>
                                            <option value="<?php echo $ser->id ?>"<?php if($ser->id==$service_heading_id) echo 'selected'; ?>><?php echo $ser->heading; ?></option>
                                       <?php } ?> 
                                    </select>   
                                </div>
                        </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Article Heading<span style="color:red;">*</span></label>  <span  style="color:red" id="head_err" class= "head_err"><?php echo form_error('heading'); ?> </span>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                    </div>

                                </div>

                            </div>
                        </div> 
                    </div>

                <div class="col-md-4">
                    <div class="form-group"> 
                                <label for="Image">Image <span style="color:red;">*</span></label> <span style="color:red;" id="image_err"></span>
                                <input type="file" name="image" id="image"  class="inputfile form-control"/>   
                                <?php if($image!=''){ ?>
                                  <img src="<?php echo base_url() ?>uploads/ourservice/<?php echo $image; ?>" height="80px" width="80px">
                                  <input type="hidden" name="old_image"  value="<?php echo $image ?>">
                                <?php } ?>
                    </div>
                </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Description<span style="color:red;">*</span></label> <span  style="color:red" id="des_err" class= "des_err"> <?php echo form_error('description'); ?> </span>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea type="text" placeholder="Description" class="form-control ckeditor" id="description" name="description"><?php echo $description; ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-md-12">
            <div style="text-align: right;">
                <input type="hidden" id="button" value="<?= $button; ?>"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                 <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                <a href = "<?php echo site_url('Service_article/index') ?>" class="btn btn-danger" type="button">Cancel</a>
            </div>
        </div>
    </div>
</form>

</div>
</div>
</div>
</section>
</div>
<?php  $this->load->view('common/footer'); ?>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>





<script type="text/javascript"> 

    var url="";  
    var actioncolumn ="";

    function check_error()
    {
        var service_heading_id = $("#service_heading_id").val().trim();
        var heading = $("#heading").val().trim();
        var description= CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
        var image = $('#image').val();
        var button = $("#button").val();

         if(service_heading_id=="")
        {
            $("#ser_err").fadeIn().html("Please select service heading");
            setTimeout(function(){ $("#ser_err").fadeOut(); }, 3000);
            $("#service_heading_id").focus();
            return false;
        }

        if(heading=="")
        {
            $("#head_err").fadeIn().html("Please enter Article heading");
            setTimeout(function(){ $("#head_err").fadeOut(); }, 3000);
            $("#heading").focus();
            return false;
        }

        if(button=='Create')
        {

            if(image.trim() == "")
            {
                $("#image_err").fadeIn().html("Please upload image");
                setTimeout(function(){$("#image_err").html("&nbsp;");},3000)
                $("#image").focus();
                return false;
            } 
        }

         if(description== 0)
        {
            $("#des_err").fadeIn().html("Please enter Description");
            setTimeout(function(){ $("#des_err").fadeOut(); }, 3000);
            $("#description").focus();
            return false;
        }

    }

</script> 
<script type="text/javascript">

    function get_title(val)
    {
        var type = val;
        $.ajax({ type:"post",
            cache:false,
            url:"<?php echo site_url('Service_detail/get_service')?>",
            data:{type:type},
            success:function(returndata)
            {   
//alert(returndata);return false;
$("#title").html(returndata);
}
});
    }

</script> 
<script type="text/javascript">  
    var url="";
    var actioncolumn="";
    function deleteItem(obj,cid) 
    {
        var site_url = $("#site_url").val();
        var ask = confirm("Are You sure to want delete this image?");
        if (ask==true) 
        {
            $(".id"+cid).fadeOut();
            var datastring="cid="+cid;
            $.ajax({
                type:"POST",
                url:site_url+"/Service_article/delete",
                data:datastring,
                cache:false,        
                success:function(returndata)
                { 
                    location.reload();
                }
            });
        }

    } 

</script> 