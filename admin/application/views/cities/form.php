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
        <li><a href="<?php echo site_url('Cities/index'); ?>">Manage City</a></li>
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
               <label class="control-label">Country <span style="color:red;">*</span></label> <span  style="color:red" id="errorcountry_id"> </span>
               <div>
                <div class="row">
                  <div class="col-md-12">
                    <select  name="country_id" id="country_id"  class="form-control" onchange="get_states(this.value)">
                 <option value="">Select Country</option>
                  <?php
                      foreach ($Countries as $row_data) 
                      {
                  ?>
                  <option value="<?php echo $row_data->id; ?>" <?php if($country_id==$row_data->id) { echo "selected"; } ?> ><?php echo $row_data->country_name; ?> </option>
                  <?php } ?>

              </select>
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
             <label class="control-label">State <span style="color:red;">*</span></label> <span  style="color:red" id="errorstate_id"> </span>
             <div>
              <div class="row">
                <div class="col-md-12">
                 <select  name="state_id" id="state_id"  class="form-control">
                                                   <option value="">Select State</option>

                                                    <?php 
                                                        foreach ($States as $row_data) 
                                                        {
                                                    ?>
                                                    <option value="<?php echo $row_data->id; ?>" <?php if($state_id==$row_data->id) { echo "selected"; } ?> ><?php echo $row_data->state_name; ?> </option>
                                                    <?php }?>

                                                </select>
                </div>

              </div>
             <!--  <span class= "errid">
                <?php echo form_error('country_code'); ?>
              </span> -->

            </div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label><span style="color:red;"></span>City Name <span style="color: red;" >*</span></label> <span  style="color:red" id="errorname"><?php echo form_error('city_name')?> </span>
            <div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" placeholder="City Name" class="form-control" id="name" name="city_name" value="<?php echo $city_name; ?>">
                
               </div>

             </div>
            <!--  <span class= "errid">
              <?php echo form_error('country_code'); ?>
            </span> -->

          </div>
        </div>

      </div>  


                              <div class="col-md-6">
                                <div class="form-group"> 
                                  <label for="Image">City Code <span style="color:red;">*</span></label> <span  style="color:red" id="errorCcode"> </span>
                                  <input type="text" placeholder="City Code" class="form-control" id="city_code" name="city_code" value="<?php echo $city_code; ?>">
                                    </div>        
                                  </div>
                                  <div class="col-md-6">
                        <div class="form-group"> 
                          <label for="Image">Sort By<!-- <span style="color:red;">*</span> --></label> <span  style="color:red"><?php echo form_error('sort_by')?> </span>
                          <input type="text" placeholder="Sort by number" class="form-control" id="sort_by" name="sort_by" value="<?php echo $sort_by; ?>">
                            </div>        
                          </div>

             
                      <div class="col-md-6">
                        <div class="form-group"> 
                          <label for="Image">Show on UI</label> <br/>
                       <label class="checkbox-inline">
                                            <input type="checkbox" name="show_on_web" id="show_on_web" value="Yes" 
                                            <?php if($button=='Update'){?>
                                            <?php if($show_on_web_explode=='Yes') 
                                            { echo "checked"; } ?>
                                            <?php }?>/>
                                            Yes
                                        </label>
                                        
                      </div>
                      </div>





                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group">
                                    <div class="col-md-12">
                                      <div>
                                          <input type="hidden" id="button" value="<?= $button; ?>"/>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                                        <a href = "<?php echo site_url('Cities/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
<script type="text/javascript"> 
    function check_error()
    {
        var name = $("#name").val().trim();
        var country_id = $("#country_id").val().trim();
        var state_id = $("#state_id").val().trim();
        var city_code = $("#city_code").val().trim();
       

        var name_filter = /^[A-Za-z]{1}[A-Za-z' ]{2,80}$/i;
        if(country_id=="")
        {
          $("#errorcountry_id").fadeIn().html("Please select country");
          setTimeout(function(){ $("#errorcountry_id").fadeOut(); }, 3000);
          $("#country_id").focus();
          return false;
        }

        if(state_id=="")
        {
          $("#errorstate_id").fadeIn().html("Please select state");
          setTimeout(function(){ $("#errorstate_id").fadeOut(); }, 3000);
          $("#state_id").focus();
          return false;
        }
        if(name=="")
        {
          $("#errorname").fadeIn().html("Please enter city name");
          setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
          $("#name").focus();
          return false;
        }

        if(!name_filter.test(name))
        {
          $("#errorname").fadeIn().html("Please enter valid city name");
          setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
          $("#name").focus();
          return false; 
        } 
         if(city_code=="")
        {
          $("#errorCcode").fadeIn().html("Please enter city code");
          setTimeout(function(){ $("#errorCcode").fadeOut(); }, 3000);
          $("#city_code").focus();
          return false;
        } 

    }

    function get_states(id)
    {
        var id = id;
        $.ajax({
                    type:"post",
                    cache:false,
                    url:"<?php echo site_url(); ?>/Cities/get_states",
                    data:{                    
                        id:id
                    },
                    beforeSend:function(){},
                    success:function(returndata)
                    {   
                      //alert(returndata);
                        $('#state_id').html(returndata);
                    }
        });
    }
</script>   
