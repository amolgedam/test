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
                <li><a href="<?php echo site_url('Students/index'); ?>">Add Student</a></li>
                <li class="active">
                    <?php echo $header;?>
                </li>
        </ol>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>View<a href="<?= site_url('Students');?>">
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
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" >Student Name</label>
                                   <p><?php if(!empty($name)) {echo $name;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Student Mobile No.</label>
                                   <p><?php if(!empty($mobno)) {echo $mobno;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" >Student Alternate No.</label>
                                   <p><?php if(!empty($altno)) {echo $altno;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" >Appointment Date</label>
                                   <p><?php if(!empty($aptdate)) {echo $aptdate;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                   <!--  <label class="control-label" >Prescription</label>
                                   <p><?php echo $image; ?></p> -->
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" >Appointment Time</label>
                                   <p><?php if(!empty($apttime)) {echo $apttime;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" >Follow Updatye</label>
                                   <p><?php if(!empty($follop_date)) {echo $follop_date;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" >Student Remark</label>
                                   <p><?php if(!empty($remark)) {echo $remark;} else{ echo "N/A";} ?></p>
                                </div>
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
