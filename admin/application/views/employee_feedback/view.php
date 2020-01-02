<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employee Feedback View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">About View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Employee_feedback');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Name :</label>
                      <p><?php if(!empty($name)) { echo $name;}else {echo "N/A";}?></p>
                    </div>
                </div>
            <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Date :</label>
                      <p><?php if(!empty($date)) { echo $date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Status :</label>
                      <p><?php if(!empty($status)) { echo $status;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">In Time :</label>
                      <p><?php if(!empty($in_time)) { echo $in_time;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Out Time :</label>
                      <p><?php if(!empty($out_time)) { echo $out_time;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Description :</label>
                     <p><?php if(!empty($remark)) { echo $remark;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
               
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>