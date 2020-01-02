<!-- <style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link> -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>
          <div>&nbsp;<?php echo $header; ?></div>
        </h1>
        <div>&nbsp;</div>
        
        <ol class="breadcrumb">
                <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo site_url('Taskassign/index'); ?>">Add task</a></li>
                <li class="active">
                    <?php echo $header;?>
                </li>
        </ol>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>View<a href="<?= site_url('Taskassign');?>">
                    <button type="button"  class="btn btn-primary pull-right">Back</button></a></h4>
                </div>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="col-md-4">&nbsp;&nbsp;</div>
                        <div class="col-md-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="box-body">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Employee Name</label>
                                   <p><?php if(!empty($name)){ echo $name; } else { echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                   <p><?php if(!empty($date)){ echo $date; } else { echo "N/A";} ?></p>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tasks</label>
                              
                                   <p><?php if(!empty($tasks)){echo $tasks;} else{ "N/A";} ?></p>
                             
                               </div>
                           </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <h3>Images:</h3>
                             <p>  
                         <?php 
                              if(!empty($image)) 
                              {

                                $allowed =  array('gif','png' ,'jpg' ,'PNG' ,'JPG','jpeg');
                                $file = $image;
                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                if(in_array($ext,$allowed)) 
                                {
                                    if(file_exists('uploads/task_image/'.$image)) 
                                    {  ?>
                                      <img src="<?php echo base_url() ?>uploads/task_image/<?php echo $image; ?>" height="100px" width="200px">

                                 <?php   }
                                    else
                                    { ?>
                                         <img src="<?php echo base_url() ?>uploads/No_Image_Available.jpg" height="100px" width="200px">
                                 <?php   }
                                }
                                else
                                { 

                                    if(file_exists('uploads/task_image/'.$image)) 
                                    {  ?>
                                       <a href="<?php echo base_url() ?>uploads/task_image/<?php echo $image; ?>"><img src="<?php echo base_url() ?>uploads/pdf.png" height="100px" width="100px"></a>
                                 <?php   }
                                    else
                                    { ?>
                                       <img src="<?php echo base_url() ?>uploads/No_Image_Available.png" height="50px" width="50px">
                                 <?php   } 
      
                                }

                              }
                              else
                              { ?>
                                <img src="<?php echo base_url() ?>uploads/No_Image_Available.jpg" height="100px" width="100px">
                            <?php } ?>

                                 </p>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
