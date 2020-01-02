<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Cities/index'); ?>">Manage Company</a></li>
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
                                    <label class="control-label">Product Type <span style="color:red;">* </span></label>
                                    <span style="color:red" id="type_err"> </span>
                                    <select class="form-control" id="product_type" name="product_type" onclick="get_type(this.value)">
                                        <option value="">Select Product Type</option>
                                        <option value="Retail_Management"<?php if ($product_type == 'Retail_Management') echo ' selected="selected"'; ?>>Retail Management</option>
                                        <option value="Markets"<?php if ($product_type == 'Markets') echo ' selected="selected"'; ?>>Markets</option>
                                        <option value="Investment"<?php if ($product_type == 'Investment') echo ' selected="selected"'; ?>>Investment</option>
                                        <option value="Financial"<?php if ($product_type == 'Financial') echo ' selected="selected"'; ?>>Financial</option>
                                    </select>
                                </div>
                            </div>
                           
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"> Product Title <span style="color:red;">* </span></label>
                                    <span style="color:red" id="title_err"> </span>
                                    <select class="form-control" id="product_title" name="product_title">
                                        <option value="">Select Product Title</option>
                                        <?php if(!empty($product)) { foreach($product as $p) { ?>
                        <option value="<?php echo $p->id;?>" <?php if($product_title==$p->id){ echo "selected";}?>><?php echo $p->product_title?></option>
                                     <?php }}?>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                    <input type="text" placeholder="Enter Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                </div>
                            </div>

                           

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">*</span></label>
                                    <span style="color:red" id="description_err"> </span>
                                  <textarea rows="6" class="form-control ckeditor" id="description" name="description"><?php echo $description;?></textarea>
                                   
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Select Image <span style="color:red;">*</span></label>
                                    <span style="color:red" id="image_err"> </span>
                                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                                    <p>Note:Please select jpg and png images</p>
                                    <?php if(!empty($product_img)) {?>
                                        <?php foreach($product_img as $img){ ?>
                                    <div class="col-md-3">
                                  <p>  <img src="<?= base_url('uploads/products/'.$img->image); ?>" width="200px" height="200px" style="margin-top:5px;">&nbsp;<center>
<a href=" "class="btn btn-danger"  onclick="myFunction(<?php echo $img->id;?>)">Remove</a> </center></p>
                                          &nbsp;&nbsp;&nbsp;&nbsp;
                                     </div>
                                     
                                  <?php } } ?>

                                </div>
                            </div>
                            
                            <div class="clearfix">&nbsp;</div>
                            <input type="hidden" name="button" id="button" value="<?php echo $button; ?>">
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Products_Details');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
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
    var product_title = $("#product_title").val().trim();
    var product_type= $('#product_type').val();
    var heading= $('#heading').val();
    var image= $('#image').val();
    var description= $('#description').val();
    var button=$("#button").val().trim();
    
    if ($.trim(type) == "") 
    {
        $("#type_err").fadeIn().html("Select Type");
        setTimeout(function() {
            $("#type_err").fadeOut();
        }, 3000);
        $("#type").focus();
        return false;
    }
    if ($.trim(title) == "") 
    {
        $("#title_err").fadeIn().html("Select Title");
        setTimeout(function() {
            $("#title_err").fadeOut();
        }, 3000);
        $("#title").focus();
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
    
    if ($.trim(description) == "") 
    {
        $("#description_err").fadeIn().html("Enter Description");
        setTimeout(function() {
            $("#description_err").fadeOut();
        }, 3000);
        $("#description").focus();
        return false;
    }
    if (button=="Create") {
        if ($.trim(image) == "") 
        {
            $("#image_err").fadeIn().html("Select Image");
            setTimeout(function() {
                $("#image_err").fadeOut();
            }, 3000);
            $("#image").focus();
            return false;
        }
    }
}
function get_type(id)
    {
        //alert(id);return false;
        var id = id;

        $.ajax({
                    type:"post",
                    cache:false,
                    url:"<?php echo site_url(); ?>/Products_Details/get_type",
                    data:{                    
                        id:id
                    },
                    beforeSend:function(){},
                    success:function(returndata)
                    {   
                      //alert(returndata);return false;
                        $('#product_title').html(returndata);
                    }
        });
    }

    function myFunction(id)
{
    //alert(id);return false;
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
   
    var datastring="id="+id;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Products_Details/delete_img'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}
</script>