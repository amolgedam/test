<div class="content-wrapper">
    <section class="content-header">
      <h1>
     
          Product View
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Product View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View  <a href="<?= site_url('Slider_image');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Image:</label>&nbsp;<span id="enq_code_err" ></span>
                    <p> <?php if(!empty($slider_image)) {?>
                                        <?php foreach($slider_image as $img){ ?>
                          <img src="<?= base_url('uploads/Client_image/'.$img->image); ?>" width="100px" height="100px"></p>
                    </div>
                      <?php } } ?>
                </div>
               
              
              
                
               
             
                </div>
              
              </div>
            </div>
            </div>
             </section>
        </div>
        <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>