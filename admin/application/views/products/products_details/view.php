<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Products Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">  Products Details</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Products_Details');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Type :</label>
                      <p><?php if(!empty($product_type)) { echo $product_type;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Title :</label>
                      <p><?php if(!empty($product_title)) { echo $product_title;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Heading :</label>
                      <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
               <div class="col-md-6">
                    <div class="form-group">
                      <label>Image :</label>
                      <p> <?php if(!empty($product_img)) {?>
                                        <?php foreach($product_img as $img){ ?>
                          <img src="<?= base_url('uploads/products/'.$img->image); ?>" width="100px" height="100px"></p>
                    </div>
                     <?php } } ?>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Description :</label>

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