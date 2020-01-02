<?php 
 // $this->load->view('common/header'); 
  //$this->load->view('common/left_menu');
?>
<link href="<?= base_url() ?>assets/dist/css/bootstrapValidator.min.css" rel="stylesheet">

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $heading; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li><a href="<?= site_url('States/index'); ?>">Manage States</a></li>
      <li class="active"><?= $heading; ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <div class="col-md-3">
              <!-- <h3 class="box-title"><?= $heading; ?></h3> -->
            </div>
            <div class="col-md-6"></div>
          <!--   <div class="col-md-3">
              <span style="color:red; float:right" >* Fields required </span>
            </div>   -->
          </div>
          <form  method="POST" action="<?= $action;?>" id="category">
            <div class="box-body">
            <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Name">Country <span style="color:red;">*</span> </label> <span  style="color:red" id="errorcountry_id"> </span> <?= form_error('country_id') ?></span>
                      <select  name="country_id" id="country_id"  class="form-control">
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

              <div class="col-md-6">
                <div class="form-group">
                  <label for="Name">State Name <span style="color:red;">*</span> </label>  <span  style="color:red" id="errorname"> <?php echo form_error('state_name'); ?></span>
                 <input type="text" placeholder="State Name" class="form-control" id="name" name="state_name" value="<?php echo $state_name; ?>">
                  <span class="text-danger"></span>
                </div>
              </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label for="Name">State Code <span style="color:red;"></span> </label> <span  style="color:red" id="errorScode"> </span><?php echo form_error('state_code'); ?>
                 <input type="text" placeholder="State code" class="form-control" id="state_code" name="state_code" value="<?php echo $state_code; ?>">
                  <span class="text-danger"> <?php echo form_error('state_code'); ?></span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="box-footer"> 
              <input type="hidden" value="<?= $id ?>" name="id"/>         
                  <button type="submit" onclick="return check_error()" class="btn btn-primary"><?= $button;?></button>
                  <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>


<script type="text/javascript">

   var url = '';
   var actioncolumn=0;
   var  pageLength= '';
</script>

<script type="text/javascript">
   function check_error()
    {
        var name = $("#name").val().trim();
        var state_code = $("#state_code").val().trim();
        var country_id = $("#country_id").val().trim();
       

        var name_filter = /^[A-Za-z]{1}[A-Za-z' ]{2,80}$/i;
        if(country_id=="")
        {
          $("#errorcountry_id").fadeIn().html("Please select country");
          setTimeout(function(){ $("#errorcountry_id").fadeOut(); }, 3000);
          $("#country_id").focus();
          return false;
        }

        if(name=="")
        {
          $("#errorname").fadeIn().html("Please enter state name");
          setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
          $("#name").focus();
          return false;
        }

        if(!name_filter.test(name))
        {
          $("#errorname").fadeIn().html("Please enter valid state name");
          setTimeout(function(){ $("#errorname").fadeOut(); }, 3000);
          $("#name").focus();
          return false; 
        }  
        /*if(state_code=="")
        {
          $("#errorScode").fadeIn().html("Please enter state code");
          setTimeout(function(){ $("#errorScode").fadeOut(); }, 3000);
          $("#state_code").focus();
          return false;
        }*/

    }
</script>

<?php
 // $this->load->view('common/footer'); 
?>   