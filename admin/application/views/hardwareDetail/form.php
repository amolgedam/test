<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $headingg ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Cities/index'); ?>">Manage Company</a></li>
            <li class="active">
                <?php echo $subheading ?>
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
                                    <label class="control-label">Title <span style="color:red;">* </span></label>
                                    <span style="color:red" id="title_err"> </span>
                                    <select class="form-control" id="title" name="title">
                                        <option value="">SELECT TITLE</option>
                                        <?php if(!empty($titleData)){ ?>
                                        <?php foreach($titleData as $row) {?>
                                        <option value="<?php echo $row->id; ?>"<?php if($hardware_id==$row->id){ echo "selected";}?>><?php echo $row->title; ?> </option>
                                    <?php }?>
                                <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                    <?php echo form_error('heading')?>
                                    <input type="text" placeholder="Enter Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label ckeditor">Description <span style="color:red;">*</span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea class="form-control" id="description" name="description"><?php echo $description;?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Select Image <span style="color:red;">*</span></label>
                                    <span style="color:red" id="image_err"> </span>
                                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                                    <p>Note:Please select jpg and png images</p>
                                    <?php if(!empty($image)) {?>
                                        <div><label>Image :</label></div>
                                     <?php foreach ($image as $row) { ?>
                                      <div class="col-md-3">
                                          <p><img src="<?php echo base_url()?>uploads/hardware/<?php echo $row->image;?>" width="230px" height="200px" style="margin-top: 20px;">&nbsp;<center>
                                            <a href="" class="btn btn-danger"  onclick="myFunction(this,<?php echo $row->id;?>)">Remove</a></center></p>
                                          &nbsp;&nbsp;&nbsp;&nbsp;
                                      </div>
                                      <?php } ?>
                                  <?php } ?>

                                </div>
                            </div>

                            
                            
                            <div class="clearfix">&nbsp;</div>
                            <input type="hidden" name="button" id="button" value="<?php echo $button; ?>">
                          <div class="box-footer">
                            
                           <a href="<?= site_url('HardwareDetail');?>"><button type="button"  class="btn btn-danger pull-right">Cancel</button></a>
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
    var title = $("#title").val().trim();;
    var heading= $('#heading').val();
    var image= $('#image').val();
    var description= $('#description').val();
    var button=$("#button").val().trim();
    var id = $('#id').val();
    
    
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
                    url:"<?php echo site_url(); ?>/Industries_Detail/get_type",
                    data:{                    
                        id:id
                    },
                    beforeSend:function(){},
                    success:function(returndata)
                    {   
                      //alert(returndata);return false;
                        $('#title').html(returndata);
                    }
        });
    }
</script>

<script type="text/javascript">
  var url="";
  var actioncolumn="";
  function myFunction(obj,cid) {
    var site_url = $("#site_url").val();
    var ask = confirm("Are You sure to want delete this image?");
    if (ask==true) 
    {
      $(".id"+cid).fadeOut();
      var datastring="cid="+cid;
      $.ajax({
          type:"POST",
          url:site_url+"/Industries_Detail/img_delete",
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