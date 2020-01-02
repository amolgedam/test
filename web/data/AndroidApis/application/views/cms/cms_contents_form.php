<?php 
  $this->load->view('common/header'); 
  $this->load->view('common/left_panel');
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title1; ?>
          </h1>
          <?php echo $breadcrum; ?>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
      <div class="col-md-12">
            <form role="form" method="POST" enctype="multipart/form-data" action="<?php echo $action; ?>">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                <!--   <h3 class="box-title"><?php echo $sub_title ?></h3> -->
                  <?php if(isset($_SESSION['ERROR'])){?>
                  <div class="required" id="session-message"><?php echo $_SESSION['ERROR']; unset($_SESSION['ERROR']); ?></div>
                  <?php } ?>
                  <div class="required" id="error_msg">&nbsp;</div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    
                    <!-- <div class="form-group">
                      <label for="cms_type">CMS Type <span class="required"> *</span> <span class="errid"><?php echo form_error('cms_type') ?></span></label>
                        <select id="cms_type" name="cms_type" class="form-control">
                        
                        <option value="AboutUs" <?php if($cms_type=='AboutUs'){ echo 'selected'; } ?>>About Us</option>
                        <option value="Career" <?php if($cms_type=='Career'){ echo 'selected'; } ?>>Career
                        </option>
                        <option value="PrivacyPolicy" <?php if($cms_type=='PrivacyPolicy'){ echo 'selected'; } ?>>Privacy Policy</option>           
                        <option value="TermofUse" <?php if($cms_type=='TermofUse'){ echo 'selected'; } ?>>Term of Use</option>
                        </select>
                    </div> -->
                     <div class="col-md-12">
                  
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="cms_type">CMS Type <span class="required" style="color:red">*</span><span class="errid"> <?php echo form_error('cms_type') ?></span><span id="type_err" class="required"></span></label></label>
                      <select id="cms_type" name="cms_type" class="form-control">
                      <?php
                      foreach ($cms_types as $row) {
                      ?>
                      <option value="<?= $row->id; ?>" <?php if($cms_type==$row->id)echo "selected"; ?>><?= $row->display_name; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Title <span class="required" style="color:red"> *</span><span class="errid"> <?php echo form_error('title') ?></span></label>&nbsp;<span id="title_err" class="required"></span>
                      <input type="text" id="title" name="title" placeholder="Title" class="form-control" value="<?php  echo $title; ?>" readonly>
                    </div>
                  </div>
</div>

                    <div class="col-md-12">
                   
                   <div class="col-md-6">
                    <div class="form-group">
                      <label for="image">Image <span class="required"></span></label>
                      <input type="file" id="image" name="image"  class="form-control" accept="image/*" onclick="Getimage();">
                    <input type="hidden" name="old_image" value="<?php echo $image; ?>" />
                     <br/>
                    <span id="show_img3">
                     <!--  <?php if($button=='Update'){ 
                      if(empty($image)) {  ?>
                     
                        <img src="<?php echo base_url('/uploads/no_image.jpg')?>" width="100px" height="100px" id="thumb" alt="No Image">
                        <?php } else { ?>
                        
                        <img src="<?php echo base_url('/uploads/cms_images/'.$image)?>" width="100px" height="100px" id="thumb" alt="image">
                         <?php } } ?> -->
                          <?php  if($button=='Update'){  if(!empty($image))
                                        {if(!file_exists("uploads/cms_images/".$image)) { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                          
                                        <?php } else { ?>
                                              <img src="<?php echo base_url('uploads/cms_images/'.$image)?>" width="100px" height="100px" id="thumb" alt="No Image">
                                        <?php } } else { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                       <?php }} ?>

                         </span>
                    </div>
                  </div>
                
                     <div class="col-md-6">
                      <div class="form-group">
                      <label for="description">Description <span class="required" style="color:red"> *</span> <span class="errid"><?php echo form_error('description') ?></span></label>&nbsp;<span id="editor1_err" class="required"></span>
                     
                       <textarea id="editor1" name="description" placeholder="Description" class="form-control ckeditor description"><?php  echo $description; ?></textarea>
                    </div>
                  </div>
             

                  </div>  <!-- /.box-body -->
                <div class="col-md-12">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit" onclick="return getvalidation(); "><?php echo $button ?></button>
                    <button type="button" onclick="window.history.back()" class="btn btn-danger">Cancel</button>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />          
                  </div>
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->
            </form>  
          </div>
         </div>     <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script>
var url='';
var actioncolumn='';
$(function () {
  CKEDITOR.replace('description');
}
</script>
<?php
  $this->load->view('common/footer'); 
?>   
<script type="text/javascript">
 function getvalidation()
   {
    //alert("hii");
   var fors = $("#fors").val();
  var title = $("#title").val();
  var editor1 = CKEDITOR.instances.editor1.getData();

    if(fors.trim()=="")
       {
           $("#for_err").fadeIn().html("Please select for").css('color','red');
           setTimeout(function(){$("#for_err").html("&nbsp;");},5000);
           $("#fors").focus();
           return false;
       }

 if(title.trim()=="")
       {
           $("#title_err").fadeIn().html("Please enter title").css('color','red');
           setTimeout(function(){$("#title_err").html("&nbsp;");},5000);
           $("#title").focus();
           return false;
       }

       if(editor1.trim()=="")
         {
             $("#editor1_err").fadeIn().html("Please enter description").css('color','red');
             setTimeout(function(){$("#editor1_err").html("&nbsp;");},5000);
             $("#editor1").focus();
             return false;
         }
    
      
   }
</script>