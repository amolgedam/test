<div class="content-wrapper">
    <section class="content-header">
      <h1>
          <?php echo $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> <?php echo $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div> 
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Employees');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Employees Name:</label>
                      <p><?php if(!empty($Getcustomerdata->name)) { echo $Getcustomerdata->name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Employees Email:</label>
                      <p><?php if(!empty($Getcustomerdata->email)) { echo $Getcustomerdata->email;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Password:</label>
                      <p><?php if(!empty($Getcustomerdata->show_password)) { echo $Getcustomerdata->show_password;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Designation name:</label>
                      <p><?php if(!empty($Getcustomerdata->designation_name)) { echo $Getcustomerdata->designation_name;}else {echo "N/A";}?></p>
                    </div>
                </div>    
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">State Name :</label>
                      <p><?php if(!empty($Getcustomerdata->state_name)) { echo $Getcustomerdata->state_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">City name:</label>
                      <p><?php if(!empty($Getcustomerdata->city_name)) { echo $Getcustomerdata->city_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Address :</label>
                      <p><?php if(!empty($Getcustomerdata->address)) { echo $Getcustomerdata->address;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>