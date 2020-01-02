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
            <li><a href="<?php echo site_url('Service_detail/index'); ?>">Manage Service-Detail</a></li>
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
                                    <label for="type">Services Type <span style="color:red;">*</span></label><span style="color:red" id="type_err"><?php echo form_error('type') ?></span>
                                    <select name="type" id="type" class="form-control" onchange="return get_title(this.value)">
                                        <option>--Select service type--</option>
                                        <option value="Application_Development" <?php if ($service_type=='Application_Development') echo 'selected="selected"' ?> >Application Development</option>
                                        <option value="Digital_Marketing" <?php if($service_type=='Digital_Marketing') echo 'selected="selected"' ?> >Digital Marketing</option>
                                        <option value="Infrastructure" <?php if($service_type=='Infrastructure') echo 'selected="selected"' ?>>Infrastructure</option>
                                        <option value="Business_Services" <?php if ($service_type=='Business_Services') echo 'selected="selected"' ?>>Business Services</option>
                                        <option value="Mobile_App" <?php if ($service_type=='Mobile App') echo 'selected="selected"' ?>>Mobile App</option>

                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Service Title<span style="color:red;">*</span></label><span style="color:red" id="title_err"><?php echo form_error('title') ?></span>
                                    <select name="title" id="title" class="form-control">
                                        <option value="">--Select title--</option>
                                        <option value="<?php echo $service_id ?>" <?php if ($service_id==$getid) echo "selected"; ?> ><?php echo $gettitle; ?> </option> 

                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Heading<span style="color:red;">*</span></label>  <span  style="color:red" id="head_err" class= "head_err"><?php echo form_error('heading'); ?> </span>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                            </div>

                                        </div>

                                    </div>
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
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <label for="Image">Service Image <span style="color:red;">*</span></label> <span style="color:red;" id="image_err"></span>
                                    <input type="file" name="image[]" id="image"  class="inputfile form-control" multiple />
                                    <?php if(!empty($image)) { ?>
                                        <?php foreach ($image as $img) { ?>
                                <div class="col-md-3">    
                                   <p><img src="<?php echo base_url("uploads/service/".$img->image) ?>" style="height:200px;width:200px;padding: 10px;"><center><a class="btn btn-danger" value="submit" onclick="deleteItem(this,<?php echo $img->id; ?>)">remove</center></a> </p>
                               </div>
                                 <?php } ?>
                                    <?php } ?>
                                </div>        
                            </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div style="text-align: right;">
                                    <input type="hidden" id="button" value="<?= $button; ?>"/>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                    <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                                    <a href = "<?php echo site_url('Service_detail/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
<?php  $this->load->view('common/footer'); ?>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>





<script type="text/javascript"> 

    var url="";  
    var actioncolumn ="";

    function check_error()
    {
        var type = $("#type").val().trim();
        var title = $("#title").val().trim();
        var heading = $("#heading").val().trim();
        var description= CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
        var image = $('#image').val();
        var button = $("#button").val();

        if(type=="")
        {
            $("#type_err").fadeIn().html("Please select service type");
            setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
            $("#type").focus();
            return false;
        }
        if(title=="")
        {
            $("#title_err").fadeIn().html("Please select service title");
            setTimeout(function(){ $("#title_err").fadeOut(); }, 3000);
            $("#title").focus();
            return false;
        }

        if(heading=="")
        {
            $("#head_err").fadeIn().html("Please enter Header");
            setTimeout(function(){ $("#head_err").fadeOut(); }, 3000);
            $("#heading").focus();
            return false;
        }

        if(description== 0)
        {
            $("#des_err").fadeIn().html("Please enter Description");
            setTimeout(function(){ $("#des_err").fadeOut(); }, 3000);
            $("#description").focus();
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
          url:site_url+"/Service_detail/img_delete",
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