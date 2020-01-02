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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                   <p><?php if(!empty($date)){ echo $date; } else { echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tasks</label>
                                <?php if(!empty($view_multiple_task)){ foreach($view_multiple_task as $row){?>
                                   <p><?php echo $row->tasks; ?></p>
                               <?php } }?>
                                </div>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
