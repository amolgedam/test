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
            <li><a href="<?php echo site_url('Service_work/index'); ?>">Manage Service Work</a></li>
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
                                    <label class="control-label">Services Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                    <?php echo form_error('heading')?>
                                    <select class="form-control" id="page_heading" name="page_heading">
                                        <option value="">Select Services Heading</option>
                                        <?php foreach($pageHeading as $row) {?>
                                        
                                        <option value="<?php echo $row->id ?>"<?php if($row->id==$page_heading_id) echo 'selected' ?>><?php echo $row->heading; ?></option>
                                    <?php }?>
                                
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Service Heading <span style="color:red;">*</span></label>
                                    <span style="color:red" id="heading_err"> </span>
                                    <?php echo form_error('heading')?>
                                    <input type="text" placeholder="Enter Heading" class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">*</span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Description"><?php echo $description;?></textarea>
                                </div>
                            </div>

                            <div class="clearfix">&nbsp;</div>
                            <input type="hidden" name="button" id="button" value="<?php echo $button; ?>">
                          <div class="box-footer">
                            
                           <a href="<?= site_url('Service_work');?>"><button type="button"  class="btn btn-danger pull-right">Cancel</button></a>
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
    var heading= $('#heading').val();
    var description= CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
    var button=$("#button").val().trim();
    var id = $('#id').val();
    
    
    if ($.trim(heading) == "") 
    {
        $("#heading_err").fadeIn().html("Enter Heading");
        setTimeout(function() {
            $("#heading_err").fadeOut();
        }, 3000);
        $("#heading").focus();
        return false;
    }
    
    if ($.trim(description) == 0) 
    {
        $("#description_err").fadeIn().html("Enter Description");
        setTimeout(function() {
            $("#description_err").fadeOut();
        }, 3000);
        $("#description").focus();
        return false;
    }
    
    
} 
function get_type(id)
    {
        //alert(id);return false;
        var id = id;

        $.ajax({
                    type:"post",
                    cache:false,
                    url:"<?php echo site_url(); ?>/service_detail/get_type",
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