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
       <li><a href="<?php echo site_url('Countries/index'); ?>">Manage Country</a></li>
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
               <label class="control-label">Country Name <span style="color:red;">*</span></label>  <span  style="color:red" id="errorname" class= "errid"><?php echo form_error('country_name'); ?> </span>
               <div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" placeholder="Country Name" class="form-control" id="name" name="country_name" value="<?php echo $country_name; ?>">
                  </div>

                </div>
               <!--  <span class= "errid">
                  <?php echo form_error('country_name'); ?>
                </span> -->

              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
             <label class="control-label">Country Code <span style="color:red;">*</span></label> <span  style="color:red" id="errorCname" class= "errid"> <?php echo form_error('country_code'); ?> </span>
             <div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" placeholder="Country Code" class="form-control" id="country_code" name="country_code" value="<?php echo $country_code; ?>">
                </div>

              </div>
            </div>
          </div>

        </div> 

                   <div class="col-md-6">
                                <div class="form-group"> 
                                  <label for="Image">Currency Image <span style="color:red;">*</span></label> <span style="color:red;" id="image_err"></span>
                                  <input type="file" name="currency_image" id="image"  class="inputfile form-control" accept="/*" onclick="imageFile();" />&nbsp;<br/>
                                
                                       <?php  if($button=='Update'){  if(!empty($currency_image))
                                        {if(!file_exists("uploads/currency/".$currency_image)) { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                          
                                        <?php } else { ?>
                                              <img src="<?php echo base_url('uploads/currency/'.$currency_image)?>" width="100px" height="100px" id="thumb" alt="No Image">
                                        <?php } } else { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                       <?php }} ?>
                                    </div>        
                           </div>
                           <div class="col-md-6">
          <div class="form-group">
            <label><span style="color:red;"></span>Sort By<!-- <span style="color: red;" >*</span> --></label>  <span style="color: red;" id="sort_err" class= "errid"><?php echo form_error('sort_by'); ?></span>
            <div>
              <div class="row">
                <div class="col-md-12">
                 <input type="text" name="sort_by" id="sort_by" class="form-control" value="<?= $sort_by; ?>" placeholder="Enter sort number">
               </div>

             </div>
          </div>
        </div>

      </div> 

                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group">
                                    <div class="col-md-12">
                                      <div>
                                          <input type="hidden" id="button" value="<?= $button; ?>"/>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                                        <a href = "<?php echo site_url('Countries/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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

                    <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

                    <script type="text/javascript"> 
                    function check_error()
                    {
                      var name = $("#name").val().trim();
                      var code = $("#country_code").val().trim();
                      var name_filter = /^[A-Za-z]{1}[A-Za-z' ]{2,80}$/i;
                      var currency_name = $("#currency_name").val();
                      var image = $('#image').val();
                      var button = $("#button").val();
                     // alrt(image);
                      if(name=="")
                      {
                        $("#errorname").fadeIn().html("Please enter country name");
                        setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
                        $("#name").focus();
                        return false;
                      }

                      if(!name_filter.test(name))
                      {
                        $("#errorname").fadeIn().html("Please enter valid country name");
                        setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
                        $("#name").focus();
                        return false; 
                      } 
                      if(code=="")
                      {
                        $("#errorCname").fadeIn().html("Please enter country code");
                        setTimeout(function(){ $("#errorCname").fadeOut(); }, 3000);
                        $("#country_code").focus();
                        return false;
                      }

                       if(code==0)
                      {
                        $("#errorCname").fadeIn().html("Please enter valid country code");
                        setTimeout(function(){ $("#errorCname").fadeOut(); }, 3000);
                        $("#country_code").focus();
                        return false;
                      }

                      if(currency_name.trim() == "")
                      {
                       $("#currency_err").fadeIn().html("Please enter currency name");
                       setTimeout(function(){$("#currency_err").html("&nbsp;");},3000)
                       $("#currency_name").focus();
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
