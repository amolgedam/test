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
                         <?php if($getSal <> 00) { ?>
                         <br>
                         <div class="row">
                            <span class="col-md-6"><b>Salary of Month(Rs) </b>&nbsp;- &nbsp;<b style="color:green"><?= 'Rs. '.number_format(round($getSal),2);?></b></span> 
                         </div>
                       <?php } ?>
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
                           if(count($totAttendence) > 0)
                           {
                              foreach ($totAttendence as $key) {
                           
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
                           
                           }
                           else
                           { ?>
                            <tr>
                              <td colspan="7"><center>No Record Found</center></td>
                            </tr>
                           <?php } ?>
                           
                            </tbody>
                        </table>
                    </div>
                </div> 