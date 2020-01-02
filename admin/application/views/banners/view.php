<div class="content-wrapper">
    <section class="content-header">
      <h1>
     
          Banner View
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Banner View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View  <a href="<?= site_url('Banner');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                
              <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Image :</label>
                      <img src="<?php echo base_url();?>uploads/banners/<?php echo $image; ?>" width="200px" height="200px;">
                    </div>
                </div>
               
              
              
                
               
             
                </div>
              
              </div>
            </div>
            </div>
             </section>
        </div>
        <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>