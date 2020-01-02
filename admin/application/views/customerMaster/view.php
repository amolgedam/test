<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Customer Master View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Customer View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('CustomerMaster');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Customer Name :</label>
                      <p><?php if(!empty($customer_name)) { echo $customer_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Customer Address :</label>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">City :</label>
                      <p><?php if(!empty($city_id)) { echo $city_id;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile No :</label>
                      <p><?php if(!empty($mobile_no)) { echo $mobile_no;}else {echo "N/A";} ?></p>
                    </div>
                </div>      
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Email ID :</label>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Pin Code :</label>
                      <p><?php if(!empty($pin_code)) { echo $pin_code;}else {echo "N/A";}?></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>