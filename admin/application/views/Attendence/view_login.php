<?php $this->load->view('common/header');
  $this->load->view('common/left_panel');
  ?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Attendence History
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Attendence History</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="row">
<br>
                      <span class="col-md-3">
                        <label for="yearap1" style="margin-left: 10px;">Year :</label>
                        
                        <select name="yearap1" id="yearap1" class="form-control" style="margin-left: 10px;">
                          <?php for($i=2019;$i<= date('Y');$i++){ ?>
                          <option value="<?= $i;?>"><?= $i;?></option>
                        <?php } ?>
                        </select>  
                      </span>
                      <span class="col-md-3">
                        <label for="monthap1" style="margin-left: 10px;">Month : </label>
                        
                        <select name="monthap1" id="monthap1" class="form-control" style="margin-left: 10px;" onchange="appendMY();">
                          <option value="1" <?php if(date('m')==1){ echo 'selected';}?>>Jan</option>
                          <option value="2" <?php if(date('m')==2){ echo 'selected';}?>>Feb</option>
                          <option value="3" <?php if(date('m')==3){ echo 'selected';}?>>Mar</option>
                          <option value="4" <?php if(date('m')==4){ echo 'selected';}?>>April</option>
                          <option value="5" <?php if(date('m')==5){ echo 'selected';}?>>May</option>
                          <option value="6" <?php if(date('m')==6){ echo 'selected';}?>>June</option>
                          <option value="7" <?php if(date('m')==7){ echo 'selected';}?>>July</option>
                          <option value="8" <?php if(date('m')==8){ echo 'selected';}?>>Aug</option>
                          <option value="9" <?php if(date('m')==9){ echo 'selected';}?>>Sept</option>
                          <option value="10" <?php if(date('m')==10){ echo 'selected';}?>>Oct</option>
                          <option value="11" <?php if(date('m')==11){ echo 'selected';}?>>Nov</option>
                          <option value="12" <?php if(date('m')==12){ echo 'selected';}?>>Dec</option>
                        </select>  
                      </span>
                      
                    </div><br>
                    <span id="appendPageHistoryData">
                    <div class="box-header">
                        <div class="content-header_button"> 
                         <div class="row">
                           <span class="col-md-3"><b>Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $totalDaysInMonth;?></b></span>
                           <span class="col-md-3"><b>Holidays</b> &nbsp;- &nbsp;<b style="color:green"><?= count($holidays);?></b></span>
                           <span class="col-md-3"><b>Sundays</b> &nbsp;- &nbsp;<b style="color:green"><?= $totalSundays;?></b></span>
                           <span class="col-md-3"><b>Allotted Holidays</b>&nbsp;- &nbsp;<b style="color:green">
                             <?php if($allotedHolidays->alloted_status=='Yes') { echo "1";} else { echo '0';} ?>
                           </b></span>
                         </div>
                         <br>
                         <div class="row">
                           <span class="col-md-3"><b>Working Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $workingDays;?></b></span>
                           <span class="col-md-3"><b>Present Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $monthly_attendence;?></b></span>
                           <span class="col-md-3"><b>Absent Days </b>&nbsp;- &nbsp;<b style="color:green"><?= count($AbsentAttendence);?></b></span>
                           <span class="col-md-3"><b>Latemarks </b>&nbsp;- &nbsp;<b style="color:green"><?= $monthly_latemarks;?></b></span>
                         </div>
                         <br>
                         <div class="row">
                           <span class="col-md-3"><b>Latemark Half Days </b>&nbsp;- &nbsp;<b style="color:green"><?= $latemarkhalfday;?></b></span>
                           <span class="col-md-3"><b>Latemark Absent</b> &nbsp;- &nbsp;<b style="color:green"><?= $latemark_Abs;?></b></span>
                           <span class="col-md-3"><b>Half Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $halfday;?></b></span>
                           <span class="col-md-3"><b>Actual Present Days </b>&nbsp;- &nbsp;<b style="color:green"><?= $actual_PresentDays;?></b></span>
                         </div>

                        </div>  
                    </div>
                
                   
                 <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Date</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Late Mark</th>
                                    <th>Half Day</th>
                                    <th>Latemark Absent</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                           $sr=0;
                           foreach ($attendenceHistory as $key) {
                           
                           $sr=$sr+1;
                           ?>
                        <tr>
                           <td><?php echo $sr; ?></td>
                           <td><?php echo $key->date; ?></td>
                           <td><?php echo date("g:i a", strtotime($key->in_time)); ?></td>
                           <?php if(!empty($key->out_time)){
                            $outTime=date("g:i a", strtotime($key->out_time));
                             }
                             else{
                              $outTime='';
                             }
                             ?>
                           <td><?php if($outTime){ echo $outTime;} else { echo '-';} ?></td>
                           <td><?php echo  $key->late_time?></td>
                           <?php 
                           if(!empty($key->halfday))
                           {
                               $halfday=$key->halfday;
                           } else
                           {
                               $halfday='0';
                           } 
                           if(!empty($key->latemark_halfday))
                           {
                               $latemark_halfday=$key->latemark_halfday;
                           } else
                           {
                               $latemark_halfday='0';
                           }
                           $halfday= ($halfday)+($latemark_halfday);?>
                           <td><?php echo  $halfday;?></td>
                           <td><?php if($key->latemark_absent){ echo $key->latemark_absent;}else{ echo "-";}?></td>
                  
                           </td>
                        </tr>
                        <?php }
                           ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </span> 
              </div>
            </div>
          </div>
        </section>
    
</div>
   <?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
  function appendMY()
  {
    var monthap1 = $('#monthap1').val();
    var yearap1 = $('#yearap1').val();
    var datastring = "monthap1="+monthap1+"&yearap1="+yearap1;
    
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Attendence/appendPageHistory'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          //alert(returndata);//return false;
          $("#appendPageHistoryData").html(returndata);

        }
      });
  }
</script>


