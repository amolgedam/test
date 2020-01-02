<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Manage Designation View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Designation View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div> 
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Designation');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Title :</label>
                      <p><?php if(!empty($title)) { echo $title;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">IP Address :</label>
                      <p><?php if(!empty($ip_add)) { echo $ip_add;}else {echo "N/A";}?></p>
                    </div>
                </div>  
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>