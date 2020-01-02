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
        <div>&nbsp;</div>
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
             
                  <div class="pull-left">
                    <!-- <label>Select Month</label>&nbsp;
                    <select>
                      <option>dkflk</option>
                      <option>dkflk</option>
                      <option>dkflk</option>
                    </select> -->
                  </div>
                 
               <h4>&nbsp;<a href="<?= site_url('Welcome/dashboard');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4>
              </div>
              </div>
              <div class="box-body">
                <div>
                 <div class="col-lg-12" style="margin-left: 10px;">
                  <div class="col-md-2">
                    <label>Days</label><br/>
                    <span style="color: green;"><?= date('t');?></span>
                  </div>
                  <div class="col-md-2">
                     <label>Holidays</label><br/>
                     <!--<?php $sun_first = strtotime('1970-01-04');

                      $t1 = date('Y-m-d') - $sun_first - 86400;

                      $t2 = date('Y-m-t') - $sun_first;

                      $sun_count = floor($t2 / 604800) - floor($t1 / 604800); // total Sunday from 2018-10-01 to 2018-10-31
                      if($sun_count==0)
                      {
                        $totSundays='4';
                      }
                      else
                      {
                        $totSundays=$sun_count;
                      }

                      $totDays=date('t');
                      $WorkingDays= $totDays-$totSundays;
                      ?>-->
                   <!-- <span style="color: green"><?= $totSundays?></span>-->
                  </div>
                <!--   <div class="col-md-2"> <label>Working Days</label><br/>
                  <span style="color: green"><?= $WorkingDays;?></span></div> -->
                  <div class="col-md-2"> <label>Present Working Days</label><br/>
                    <span style="color: green"><?= $monthly_attendence;?></span></div>

                  <div class="col-md-2"> <label>Actual Present Days</label><br/>

                    <span style="color: red;"><?= $actual_PresentDays;?></span></div>
                 </div>
                 <div class="col-lg-12" style="margin-left: 10px;">
                  <div class="col-md-2">
                    <label>Latemarks</label><br/>
                    <span style="color: red;"><?= $monthly_latemarks;?></span>
                  </div>
                  <div class="col-md-2">
                    <label>Half Day</label><br/>
                  <span  style="color: red;"><?= $halfday;?></span>
                  </div>
                    <div class="col-md-2">
                     <label>Latemark Half Day</label><br/>
                      <span  style="color: red;"><?= $latemarkhalfday;?></span>
                  </div> 
                  <div class="col-md-2">
                     <label>Latemark Absent</label><br/>
                      <span  style="color: red;"><?= $latemark_Abs;?></span>
                  </div>
                  <div class="col-md-2">
                    &nbsp;
                    <!--  <label>Half Day Leaves</label><br/>
                                        <span  style="color: red;">31</span> -->
                  </div>
                 <div class="col-md-2"> &nbsp; <!-- <label>Approved Leaves</label><br/>
                   <span  style="color: red;">31</span> --></div>
                  <!-- <div class="col-md-2"> <label>Present Working Days</label><br/>
                   <span>31</span></div>
                 <div class="col-md-2"> <label>Actual Present Days</label><br/>
                   <span>31</span></div> -->
                 </div>
                  </div>
                </div>
                <div class="table-responsive" >
                <table id="table" class="table table-striped table-bordered table-hover">
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
                           <td><?php echo $outTime ?></td>
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
                           <td><?php echo  $key->latemark_absent?></td>
                          
                           
                  
                           </td>
                        </tr>
                        <?php }
                           ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
  </section>
</div>
   <?php $this->load->view('common/footer'); ?>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
  var url="";
  var actioncolumn="";
  function myFunction(obj,cid) {
    var site_url = $("#site_url").val();
    var ask = confirm("Are You sure to want delete this image?");
    if (ask==true) 
    {
      $(".id"+cid).fadeOut();
      var datastring="cid="+cid;
      $.ajax({
          type:"POST",
          url:site_url+"/Industries_Detail/img_delete",
          data:datastring,
          cache:false,        
          success:function(returndata)
          { 
              location.reload();
          }
        });
    }
}
</script>
