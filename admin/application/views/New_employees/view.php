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
              <div class="panel-heading"><h4>View<a href="<?= site_url('New_employee');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">First Name:</label>
                      <p><?php if(!empty($Getcustomerdata->first_name)) { echo $Getcustomerdata->first_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Middle Name:</label>
                      <p><?php if(!empty($Getcustomerdata->middle_name)) { echo $Getcustomerdata->middle_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Last Name:</label>
                      <p><?php if(!empty($Getcustomerdata->last_name)) { echo $Getcustomerdata->last_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Date Of Birth:</label>
                      <p><?php if(!empty($Getcustomerdata->birthday_date)) { echo $Getcustomerdata->birthday_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                    
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Guardian Name:</label>
                      <p><?php if(!empty($Getcustomerdata->guardian)) { echo $Getcustomerdata->guardian;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                      
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">caste:</label>
                      <p><?php if(!empty($Getcustomerdata->caste)) { echo $Getcustomerdata->caste;}else {echo "N/A";}?></p>
                    </div>
                </div>       
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Home State:</label>
                      <p><?php if(!empty($Getcustomerdata->state_name)) { echo $Getcustomerdata->state_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Home City:</label>
                      <p><?php if(!empty($Getcustomerdata->city_name)) { echo $Getcustomerdata->city_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile No:</label>
                      <p><?php if(!empty($Getcustomerdata->mobile_no)) { echo $Getcustomerdata->mobile_no;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Guardian Mobile No:</label>
                      <p><?php echo($Getcustomerdata->guardian_type.' No '.$Getcustomerdata->gmobile_no)?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Past office name:</label>
                      <p><?php if(!empty($Getcustomerdata->office_name)) { echo $Getcustomerdata->office_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Initial Desination:</label>
                      <p><?php if(!empty($Getcustomerdata->initial_deg)) { echo $Getcustomerdata->initial_deg;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Blood Group:</label>
                      <p><?php if(!empty($Getcustomerdata->blood_group)) { echo $Getcustomerdata->blood_group;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Present Address:</label>
                      <p><?php if(!empty($Getcustomerdata->present_address)) { echo $Getcustomerdata->present_address;}else {echo "N/A";}?></p>
                    </div>
                </div>  
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Appointment Date:</label>
                      <p><?php if(!empty($Getcustomerdata->appointment)) { echo $Getcustomerdata->appointment;}else {echo "N/A";}?></p>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Joining Date:</label>
                      <p><?php if(!empty($Getcustomerdata->office_join)) { echo $Getcustomerdata->office_join;}else {echo "N/A";}?></p>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Initial Desination:</label>
                      <p><?php if(!empty($Getcustomerdata->initial_deg)) { echo $Getcustomerdata->initial_deg;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
               
                
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Designation name:</label>
                      <p><?php if(!empty($Getcustomerdata->designation_name)) { echo $Getcustomerdata->designation_name;}else {echo "N/A";}?></p>
                    </div>
                </div>    
             
                 <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Salary</label>
                      <p><?php if(!empty($Getcustomerdata->basic_salary)) { echo $Getcustomerdata->basic_salary;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>