<div class="content-wrapper">
    <section class="content-header">
      <h1>
     
         Products Services List View
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Products Services List View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View  <a href="<?= site_url('Products_Service_List');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="title">Service Heading List:</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($service_heading_list)) { echo $service_heading_list;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Description:</label>&nbsp;<span id="enq_code_err" ></span>
                    <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
              
              
                
               
             
                </div>
              
              </div>
            </div>
            </div>
             </section>
        </div>
        <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>