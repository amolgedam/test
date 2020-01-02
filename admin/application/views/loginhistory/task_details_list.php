<?php $this->load->view('common/header');
  $this->load->view('common/left_panel');
  ?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
         Employee Task Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Employee Task Details</li>
      </ol>
    </section>
     <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>&nbsp;<a href="<?= site_url('Welcome/dashboard');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
                          <div class="box-body">
                          	  <?php
                          	   foreach ($attendenceHistory as $key) {
                          	   ?> 
                   			<div><label>DATE : </label><span> <?php echo $key->date; ?></span></div>
                   			<div><label>Description</label> <p><?php echo $key->remark; ?></p></div>
                   			<hr>
                   			 <?php }
                                 ?>
                </div>
                      </div>
      </div>
    </div>
  </section>
</div>

   <?php $this->load->view('common/footer'); ?>