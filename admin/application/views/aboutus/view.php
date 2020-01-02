<div class="content-wrapper">
    <section class="content-header">
      <h1>
         About us View
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
              <div class="panel-heading"><h4>View<a href="<?= site_url('Aboutus');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Heading :</label>
                      <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">image:</label>
                     
                   <p>   
                          <?php

                            if(!empty($image))
                            {
                                if(file_exists('uploads/cms/'.$image))
                                {
                                  echo '<img src="'.base_url('uploads/cms/'.$image).'">';
                                }
                                else
                                {
                                  echo '<img src="'.base_url('uploads/cms/no_img.png').'">';
                                }
                            }
                            else
                            {
                                echo '<img src="'.base_url('uploads/cms/no_img.png').'">';
                            }
                          ?></p>

                    </div>
                </div> -->
                
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Description :</label>
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