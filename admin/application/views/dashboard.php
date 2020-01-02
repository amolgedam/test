
<?php $this->load->view('common/header');?>
<?php $this->load->view('common/left_panel');?>
<style type="text/css">
  
  .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
     
      <div class="row">
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
         <?php  if($_SESSION['SESSION_NAME']['designation']=='telecaller') { ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('Demo_details')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Demo Project Details</span>
              <a href="<?php echo site_url('Demo_details')?>"><span class="info-box-number"><?php echo $project_demo; ?></span></a>
            </div>
          </div>
          </a>
        </div>

            <?php } ?>
         <?php  if($_SESSION['SESSION_NAME']['designation']=='admin') { ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('Employees')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Employees</span>
              <a href=""><span class="info-box-number"><?php echo $count_emp; ?></span></a>
            </div>
          </div>
          </a>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('Expence')?>" >
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money" aria-hidden="true" style="margin-top: 22px;"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Expenses</span>
            <!--   <a href=""><span class="info-box-number"><?php echo $total_expenses; ?></span></a> -->
            <a href=""><span class="info-box-number" style="font-weight: 800; font-size: 20px;"><i class="fa fa-inr"></i>&nbsp;<?php echo $total_expenses_sum->total_amount; ?></span></a>
            </div>
          </div>
          </a>
        </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('LoginHistory')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Login History</span>
              <a href="<?php echo site_url('LoginHistory')?>"><span class="info-box-number">See Details</span></a>
            </div>
          </div>
          </a>
        </div>
      
         <div class="col-md-3 col-sm-6 col-xs-12">
             <a href="<?= site_url('Designation')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-analytics"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Developer</span>
              <a href=""><span class="info-box-number"><?php echo $count_dev; ?></span></a>
            </div>
          </div>
          </a>
        </div>
    <!--    suresh Code-->
     <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('Demo_details')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Demo Project Details</span>
              <a href="<?php echo site_url('Demo_details')?>"><span class="info-box-number"><?php echo $project_demo; ?></span></a>
            </div>
          </div>
          </a>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-analytics"></i></span>

            <div class="info-box-content">
              <span class="info-box-text ">New Joining</span>
              <a href="<?= site_url('New_employee/index'); ?>"><span class="info-box-number"><?php echo $employee_data; ?></span></a>
           
            </div>
          </div>
        </div>
      <!--  Suresh Code End here-->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('Designation')?>" target="_blank">
          <div class="info-box" >
            <span class="info-box-icon" style="color:white;background-color:#cc3300;"><i class="ion ion-beer"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Marketing</span>
              <a href=""><span class="info-box-number"><?php echo $count_mar; ?></span></a>
            </div>
          </div>
          </a>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
             <a href="<?= site_url('Designation')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#993333;"><i class="ion ion-bowtie"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Telecaller</span>
              <a href=""><span class="info-box-number"><?php echo $count_tel; ?></span></a>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#996633;"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Clients</span>
              <a href=""><span class="info-box-number"><?php echo $count_req; ?></span></a>
            </div>
          </div>
        </div>
          <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_std)){ echo "blink_me";}?>">
          <div class="info-box"> 
            <span class="info-box-icon" style="color:white;background-color:#ff80d5;"><i class="ion ion-android-person-add"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Students/index/today');?>"> 
              <span class="info-box-text">Today Student Followup</span>
             <span class="info-box-number"><?php echo $count_std; ?></span></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('Quotation')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#cc99ff;"><i class="ion ion-podium"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Quotation</span>
              <a href=""><span class="info-box-number"><?php echo $count_quo; ?></span></a>
            </div>
          </div>
          </a>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('Employee_feedback')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#99cc00;padding:20px;"><i class="fa fa-comment"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Marketing Feedback</span>
              <span class="info-box-number"><?php echo $count_mar; ?></span>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($task_assign)){ echo "blink_me";}?>">
          <div class="info-box"> 
            <span class="info-box-icon" style="color:white;background-color:#e68a00;"><i class="ion ion-help-buoy"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Taskassign/index/today_task');?>"> 
              <span class="info-box-text">Today Task Assign</span>
             <span class="info-box-number"><?php echo $task_assign; ?></span></a>
            </div>
          </div>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
             <a href="<?= site_url('LoginHistory')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#669999;"><i class="ion ion-leaf"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Today Attendance</span>
              <a href=""><span class="info-box-number"><?php echo $count_attend; ?></span></a>
            </div>
          </div>
          </a>
        </div>
        <?php } ?>
         <?php  if($_SESSION['SESSION_NAME']['designation']=='admin' || $_SESSION['SESSION_NAME']['designation']=='marketing') { ?>
        <?php if(!empty($total_lead)) { ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('Lead')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Leads</span>
              <a href=""><span class="info-box-number"><?php echo $count_lead; ?></span></a>
            </div>
          </div>
          </a>
        </div>
        <?php }?>
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_daylead)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#884dff;"><i class="ion ion-filing"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Lead/index/today');?>"> 
              <span class="info-box-text">Today Leads</span>
              <a href=""><span class="info-box-number"><?php echo $count_daylead; ?></span></a> </div>
          </div>
        </div> 
         <?php  if($_SESSION['SESSION_NAME']['designation']=='marketing') { ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('Demo_details')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Demo Project Details</span>
              <a href="<?php echo site_url('Demo_details')?>"><span class="info-box-number"><?php echo $project_demo; ?></span></a>
            </div>
          </div>
          </a>
        </div>
         <?php }?>
        <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?= site_url('Requirement')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#ff9999;"><i class="ion ion-images"></i></span>
            <div class="info-box-content">
          <span class="info-box-text">Total Requirement</span>
             <span class="info-box-number"><?php echo $count_req; ?></span>
            </div>
          </div>
        </div>  
        
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_foll)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#e68a00;"><i class="ion ion-help-buoy"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Lead/index/today_followup');?>"> 
              <span class="info-box-text">Today Followup</span>
             <span class="info-box-number"><?php echo $count_foll; ?></span></a>
            </div>
          </div>
        </div>
             <!-- LLP Lead or PVT. Leads -->
     <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_pvt)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#000080;padding:20px"><i class="fa fa-industry"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Manage_company_data/index/Pvt.Ltd.today_followup');?>"> 
              <span class="info-box-text">PVT. LTD.Today Followup Leads</span>
             <span class="info-box-number"><?php echo $count_pvt; ?></span></a>
            </div>
          </div>
        </div>
          <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_LLP)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#ff99ff;padding:20px"><i class="fa fa-handshake-o"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('LLP_company_data/index/LLP_today_followup');?>"> 
              <span class="info-box-text">LLP Today Followup Leads</span>
             <span class="info-box-number"><?php echo $count_LLP; ?></span></a>
            </div>
          </div>
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('Manage_company_data/index/total_assign_data')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total PVT. LTD. Leads</span>
              <a href=""><span class="info-box-number"><?php echo $total_pvt; ?></span></a>
            </div>
          </div>
          </a>
        </div>
   
         <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('LLP_company_data/index/total_assign_data')?>" target="_blank">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#00e6e6;"><i class="ion ion-grid"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total LLP Leads</span>
              <a href=""><span class="info-box-number"><?php echo $total_LLP_count; ?></span></a>
            </div>
          </div>
          </a>
        </div>

   <!-- End LLP Lead or PVT. Leads -->
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_app)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#ff9999;"><i class="ion ion-images"></i></span>
            <div class="info-box-content">
          <a href="<?php echo site_url('Lead/index/today_appointment');?>"> 
          <span class="info-box-text">Today Appointment</span>
             <span class="info-box-number"><?php echo $count_app; ?></span></a>
            </div>
          </div>
        </div>
      <?php } ?>
       <?php  if($_SESSION['SESSION_NAME']['designation']=='HR Recruiter') { ?>
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($count_std)){ echo "blink_me";}?>">
          <div class="info-box"> 
            <span class="info-box-icon" style="color:white;background-color:#ff80d5;"><i class="ion ion-android-person-add"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Students/index/today');?>"> 
              <span class="info-box-text">Today Student Followup</span>
             <span class="info-box-number"><?php echo $count_std; ?></span></a>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php  if($_SESSION['SESSION_NAME']['designation']=='PHP DEVELOPER') { ?>
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($task_assign)){ echo "blink_me";}?>">
          <div class="info-box"> 
            <span class="info-box-icon" style="color:white;background-color:#e68a00;"><i class="ion ion-help-buoy"></i></span>
            <div class="info-box-content">
                 <a href="<?php echo site_url('Taskassign/index/today_task');?>"> 
              <span class="info-box-text">Today Task Assign</span>
             <span class="info-box-number"><?php echo $task_assign; ?></span></a>
            </div>
          </div>
        </div>
      <?php } ?>
        <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($getdob)){ echo "blink_me";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#666633;"><i class="ion ion-heart"></i></span>
           <a href="" onclick="birthday()"  data-toggle="modal" data-target="#birthday">
            <div class="info-box-content">
              <span class="info-box-text">Todays Birthdays</span>
             <span class="info-box-number"><?php echo $getdob; ?></span>
            </div></a>
          </div>
        </div>
        <!--Holiday-->
         <div class="col-md-3 col-sm-6 col-xs-12 <?php if(!empty($get_holiday)){ echo "";}?>">
          <div class="info-box">
            <span class="info-box-icon" style="color:white; padding:20px;background-color:red;"><i class="fa fa-calendar"></i></span>
            <?php if(!empty($get_holiday)){?>
           <a href="" onclick="holiday()"  data-toggle="modal" data-target="#holiday">  <div class="info-box-content">
               <?php } ?>
              <span class="info-box-text"> Holidays</span>
             <span class="info-box-number"><?php echo $get_holiday; ?></span>
            </div>
            <?php if(!empty($get_holiday)){?>
            </a>
            <?php } ?>
          </div>
        </div>
        
        <!--End Holiday-->
    </section>
    
    <?php if($get_empName->designation_name =='admin' || $get_empName->designation_name =='Sub Admin') {?>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>  
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>&nbsp;<a href="<?= site_url('Welcome/dashboard');?>"></a></h4>
                <center><b><h3 style="color: gray;">Today's Employees List</h3></b></center></div>
                  <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <form method="post" action="<?php echo site_url('Welcome/dashboard');?>">
                                <div class="col-md-4">
                                  <div class="form-group">
                                  <select class="form-control" id="name" name="name_id">
                                    <option value="">select employee name</option>
                                    <?php foreach($get_name as $row) {?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                  <?php } ?>
                                  </select>
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="input-group date">
                                   <input type='text' class="form-control" data-provide="datepicker" name="date">
                                   <div class="input-group-addon">
                                 <span class="glyphicon glyphicon-th"></span>
                                </div>
                                </div>
                                </div>
                                <!-- refresh search button -->
                                <div class="col-md-4">
                                  <a href="<?php echo site_url('Welcome/dashboard');?>"><button type="button" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true" ></i></button></a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>
                                  </button>
                                </div>
                                 
                                </tr>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody> 
                             <?php 
                                 $sr=1;
                                 foreach ($get_empData as $emp) {
            
                                 ?>
                              <tr>
                                 <td><?php echo $sr++; ?></td>
                                 <td><?php echo $emp->name; ?></td>
                                 <td><?php echo $emp->date; ?></td>
                                 <td><?php echo date("g:i a", strtotime($emp->in_time)); ?></td>
                                 <?php if(!empty($emp->out_time)){
                                  $outTime=date("g:i a", strtotime($emp->out_time));
                                   }
                                   else{
                                    $outTime='';
                                   }
                                   ?>
                                   <td><?php echo $outTime;?></td>
                                 <td><button type="button" class="btn btn-info" onclick="get_remark('<?= $emp->id;?>')" data-toggle="modal" data-target="#Status"><i class="fa fa-eye"></i></button></td>
                              </tr>
                              <?php } ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?> 
  </div>
  <!-- /.content-wrapper -->
  
  <div class="modal" id="Status" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight" style="padding: 20px;"> 
            <center><h3><b>TODAY's &nbsp; WORK</b></h3></center>
            <form method="post" action="<?= site_url("Welcome/dashboard");?>">       
                <div class="modal-body" style="border:1px solid;padding: 20px;">
             
                    <input type="hidden" name="id" id="statusId" style="display: none;"> 
                    <span style="color:red" id="err_remark"><?php echo form_error('remark')?> </span>
                    <div id="show_remark"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$birthday=$this->Crud_model->Getdata('admin',"","status='Active' and RIGHT(birthday,'5')='".date('m-d')."'","","","",""); 
?>
<div class="modal fade" id="birthday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header header">
        <h1 class="title"><i class="fa fa-birthday-cake" aria-hidden="true" style="color: #fff;"></i>
Wish You Very Happy Birthday!</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <!--Body-->
      <div class="modal-body mb-0 text-center">
       <img src="<?php echo base_url('uploads/dob/Happy.gif')?>" width='500px' height="300px">
      </div>
  <div class="container">
          <table  cellspacing="5px" border="1px solid black" width="550px">
               <thead  style="background-color: #009999">
                 <tr >
                   <th style="padding:6px;"><center>Name</center></th>
                   <th style="padding:6px;"><center>Birthday</center></th>
                 </tr>
               </thead>
               <tbody>
                <?php if(!empty($birthday)) {
                    foreach ($birthday as $bod) {

                    ?>
                 <tr>
                   <td style="padding:2px;"><center><?php echo $bod->name;?></center></td>
                   <td style="padding:2px;"><center><?php echo date('d-m-Y',strtotime($bod->birthday));?></center></td> 
                 </tr>
               <?php } } ?>
               </tbody>
             </table>
      </div>
      <br><br>
    </div>
    <!--/.Content-->

  </div>
</div>

<?php
$holiday=$this->Crud_model->Getdata('holidays',"","status='Active' and date >='".date('Y-m-d')."'","","","",""); 
?>
 <div class="modal" id="holiday" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight" style="padding: 20px;"> 
            <center><h3><b style="color:#ff3333">Holidays</b></h3></center>
                
                <div class="modal-body">
             <table  cellspacing="5px" border="1px solid black" width="550px">
               <thead  style="background-color: #009999">
                 <tr >
                   <th style="padding:6px;"><center>Title</center></th>
                   <th style="padding:6px;"><center>Date</center></th>
                 </tr>
               </thead>
               <tbody>
                <?php if(!empty($holiday)){ foreach($holiday as $row){
            
                ?>
                 <tr>
                   <td style="padding:2px;"><center><?php echo ucfirst($row->title);?></center></td>
                   <td style="padding:2px;"><center><?php echo date('d-m-Y',strtotime($row->date));?></center></td>
                 </tr>
               <?php } } ?>
               </tbody>
             </table>
                  
                </div>
                <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
           
        </div>
    </div>
</div>


<?php $this->load->view('common/footer');?>

<script>
  function get_remark(id)
  {
     var id = id; 
         $.ajax({
        type: "post",
        cache:false,
        url:"<?php echo site_url('Welcome/getRemark')?>",
        data:{id:id},
        success:function(returndata)
       {              
          var obj = JSON.parse(returndata);
          $("#show_remark").html(obj.remark);  

          $("#show").modal('show');    
       }
      });

    }

</script>
<script>
  $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
    minDate:new Date()

});


function holiday()
{
  ('#holiday').show();
}
</script>
