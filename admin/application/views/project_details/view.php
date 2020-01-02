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
              <div class="panel-heading"><h4>View<a href="<?= site_url('Demo_details');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Project Name:</label>
                      <p><?php if(!empty($Getcustomerdata->project_name)) { echo $Getcustomerdata->project_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Price:</label>
                      <p><?php if(!empty($Getcustomerdata->price)) { echo $Getcustomerdata->price;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
             <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Link</label>
                      <p><a target="_blank" href="<?php if(!empty($Getcustomerdata->link)) { echo $Getcustomerdata->link;}else {echo "N/A";} ?>"><?php if(!empty($Getcustomerdata->link)) { echo $Getcustomerdata->link;}else {echo "N/A";} ?></a></p>
                    </div>
                </div>

               
                
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">User Id:</label>
                      <p><?php if(!empty($Getcustomerdata->userid)) { echo $Getcustomerdata->userid;}else {echo "N/A";}?></p>
                    </div>
                </div>    
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Password :</label>
                      <p><?php if(!empty($Getcustomerdata->password)) { echo $Getcustomerdata->password;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Description:</label>
                      <p><?php if(!empty($Getcustomerdata->description)) { echo $Getcustomerdata->description;}else {echo "N/A";}?></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>