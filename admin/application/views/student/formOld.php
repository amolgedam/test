<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <div>&nbsp;<?php echo $header; ?></div>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="<?php echo site_url('Students/index'); ?>">Add Student</a></li>
        <li class="active"><?= $header;?></li>
        <li class="active">
         
        </li>
      </ol>
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
              <form method="POST" action="<?php echo $action; ?>"  enctype="multipart/form-data" >
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" >Leave Type<span style="color:red;">* </span>
                    </label>
                   <span style="color:red" id="heading_err"> </span>
                    <select id="type" name="leave_type" class="form-control" value="<?php echo $leave_type; ?>">
                      
                      <option>select type</option>
                      <option>Casual Leave</option>
                      <option>Sick Leave</option>

                    </select>
                  </div>
                </div> --> 

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" >Student Name<span style="color:red;">* </span></label>
                   <!--  <span style="color:red" id="heading_err"> </span> -->
                    <input type="text" placeholder="Enter name of student" class="form-control" id="title" name="name" value="<?php echo $name; ?>">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Student Mobile No.<span style="color:red;">* </span></label>
                   <!--  <span style="color:red" id="heading_err"> </span> -->
                    <input type="text" placeholder="Enter student's mobile no." class="form-control" id="from" name="mobno" value="<?php echo $mobno; ?>" maxlenght="10">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Student Alternate No.<span style="color:red;">* </span></label>
                   <!--  <span style="color:red" id="heading_err"> </span> -->
                    <input type="text" placeholder="Enter student's alternate No." class="form-control" id="from" name="altno" value="<?php echo $altno; ?>" maxlenght="10">
                  </div>
                </div>
                <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="control-label">Appointment Date <span style="color:red;">*</span></label> <span style="color:red" id="adate_err"><?php echo form_error('appoint_date') ?></span>
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text"  placeholder="Enter Appointment Date" class="form-control" id="aptdate" name="aptdate" value="<?php echo $aptdate ?>">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                <!--<div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Appointment Date<span style="color:red;">* </span></label>

                    <input type="date" placeholder="Enter student's alternate No." class="form-control" id="from" name="aptdate" value="<?php echo $aptdate; ?>">
                  </div>
                </div>-->

                <div class="col-sm-1">
                  <div class="form-group">
                     &nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                </div> 
                 <div class="col-md-2">
                                        <div class="form-group clockpicker">
                                        <label class="control-label">Appointment Time <span style="color:red;">*</span></label> <span style="color:red" id="appoint_err"><?php echo form_error('appoint_date') ?></span>
                                        <input type="text" placeholder="Enter appointment time" class="form-control  timepicker" id="apttime" name="apttime" value="<?php echo $apttime; ?>">
                                        </div>
                                    </div>
               
                   <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Followup Date <span style="color:red;"></span></label> <span style="color:red" id="fdate_err"><?php echo form_error('follop_date') ?></span>
                                     <div class="input-group date" data-provide="datepicker">
                                    <input type="text" placeholder="Enter follop date" class="form-control" id="follop_date" name="follop_date" value="<?php echo $follop_date; ?>">
                                     <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                </div>
                                </div>
                            </div>
                </div>                 


                
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label" >Student Remark<span style="color:red;">* </span></label>
                   <!--  <span style="color:red" id="heading_err"> </span> -->
                    <textarea type="text" placeholder="Enter the Remark" class="form-control" id="remark" name="remark" value=""><?php echo $remark; ?> </textarea>
                  </div>
                </div>

               
             <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                      <div class="clearfix">&nbsp;</div>
                      <div class="box-footer">
                        <a> <button type="submit" style="width:65px;height:35px;" class="btn btn-primary pull-right" name="Create" onclick="return validation();"><?php echo $button;?></button></a>
                        <a href="<?= site_url('Students');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                      </div>  
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <script type="text/javascript">
          var url = '';
          var actioncolumn=0;
          var  pageLength= '';
        </script>
        <!-- <script type="text/javascript" src="< ?php echo base_url('assets/custom_js/holiday.js');?>"></script> -->
