<div class="col-md-12">
  <div class="box-body">
    <span id="appendPageHistoryData">
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
                                <div class="row">
                           <span class="col-md-3">
                            <form method="POST" action="<?php echo site_url('LoginHistory/task_details_list')?>">
                              <input type="hidden" id="empId" name="empId" value="<?= $empId;?>">
                            <button type="submit" class="btn btn-info" value="<?= $empId;?>"> See Task Details</i>
                            </button>
                          </form>
                          </span>
                          
                         </div>
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
              <th>View</th>    
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
              <td><?php echo date('d-M-Y',strtotime($key->date)); ?></td>
              <td><?php echo date('l',strtotime($key->date)); ?></td>
              <td><?php echo date("g:i a", strtotime($key->in_time)); ?></td>
              <?php if(!empty($key->out_time))
              {
                $outTime=date("g:i a", strtotime($key->out_time));
              }
              else
              {
                $outTime='';
              }
              ?>
              <td><?php echo $outTime;?></td>
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
                                  <td>
                           <button type="button" class="btn btn-info" onclick="get_remark('<?= $key->id;?>')" data-toggle="modal" data-target="#Status"><i class="fa fa-eye"></i></button>
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
</span>
</div>
</div>
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
<script>
  function get_remark(id)
  {
     var id = id; 
         $.ajax({
        type: "post",
        cache:false,
        url:"<?php echo site_url('LoginHistory/getRemark')?>",
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
