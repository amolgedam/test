<div class="row">
                    <span class="col-md-3">
                      <b>Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $totalDaysInMonth;?></b>
                    </span>
                    <span class="col-md-3"><b>Holidays</b> &nbsp;- &nbsp;<b style="color:green"><?= count($holidays);?> </b></span>
                    <span class="col-md-3"><b>Sundays</b> &nbsp;- &nbsp;<b style="color:green"><?= $totalSundays;?></b></span>
                    <span class="col-md-3"><b>Allotted Holidays</b>&nbsp;- &nbsp;<b style="color:green">
                             <?php if($allotedHolidays->alloted_status=='Yes') { echo "1";} else { echo '0';} ?> 
                           </b></span>
                  </div>
                  <br>
                         <div class="row">
                           <span class="col-md-3"><b>Working Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $workingDays;?></b></span>
                           <span class="col-md-3"><b>Present Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $monthly_attendence;?></b></span>
                           <span class="col-md-3"><b>Absent Days </b>&nbsp;- &nbsp;<b style="color:green"><?= count($AbsentAttendence);?> </b></span>
                           <span class="col-md-3"><b>Latemarks </b>&nbsp;- &nbsp;<b style="color:green"><?= $monthly_latemarks;?></b></span>
                         </div>
                         <br>
                         <div class="row">
                           <span class="col-md-3"><b>Latemark Half Days </b>&nbsp;- &nbsp;<b style="color:green"> <?= $latemarkhalfday;?></b></span>
                           <span class="col-md-3"><b>Latemark Absent</b> &nbsp;- &nbsp;<b style="color:green"><?= $latemark_Abs;?></b></span>
                           <span class="col-md-3"><b>Half Days</b> &nbsp;- &nbsp;<b style="color:green"><?= $halfday;?></b></span>
                           <span class="col-md-3"><b>Actual Present Days </b>&nbsp;- &nbsp;<b style="color:green"> <?= $actual_PresentDays;?></b></span>
                         </div>
                         <input type="hidden" id="empId" value="<?= $empId;?>">
                          <?php if($getSal <> 00) { ?>
                         <br>
                         <div class="row">
                            <span class="col-md-6"><b>Salary of Month(Rs) </b>&nbsp;- &nbsp;<b style="color:green"><?= number_format(round($getSal),2);?></b></span> 
                         </div>
                        <?php } ?>
                         <br>
    <div class="table-responsive" >
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead style="background-color:#8cb3d9;">
          <tr>
            <th>Sr No</th>
            <th>Date</th>
            <th>Day</th>
            <th>Login Time</th>
            <th>Logout Time</th>
            <th>Late Mark</th>
            <th>Half Day</th>
            <th>Status</th>
            <th>Latemark Absent</th>             
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($attendenceHistory)) {
          $sr=1; foreach ($attendenceHistory as $key) 
          {
            ?>
            <tr>
              <td><?php echo $sr++; ?></td>
              <td style="width:130px;"><?php echo date('d-M-Y',strtotime($key->date)); ?></td>
              <td style="width:130px;"><?php echo date('d-l-Y',strtotime($key->date)); ?></td>
              <td style="width:70px;"><?php echo date("g:i a", strtotime($key->in_time)); ?></td>
              <?php if(!empty($key->out_time))
              {
                $outTime=date("g:i a", strtotime($key->out_time));
              }
              else
              {
                $outTime='';
              }
              ?>
              <td style="width:70px;"><?php echo $outTime;?></td>
              <td><?php echo  $key->late_time;?></td>
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
            <td><?php if($key->status=='Present'){ ?>
                              <b style="color:green;"><?= $key->status;?></b>
                            <?php } else { ?>
                              <b style="color:red;"><?= $key->status;?></b>
                            <?php } ?>
                            </td>
                            <td><?php if($key->latemark_absent){ echo $key->latemark_absent;}else{ echo "-";}?></td>
                  
                           </td>
          </tr>
        <?php }}else {
        ?>
        <tr>
          <td colspan="5">
            <center>No Data available</center>
          </td>
        </tr>

      <?php } ?>
      </tbody>
    </table>
  </div>