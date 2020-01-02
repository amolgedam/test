<link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui.css')?>">
<?php $this->load->view('common/header');
$this->load->view('common/left_panel');
?>
<style>
  .ui-datepicker-calendar{
    display:none;
  }
  div.ex3 {
  width:300px;
  height: 400px;
  overflow: auto;
}
</style>
 
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

          <!-- <div class="col-md-2">
            <label>Select Year And Month:</label>

           <input type="text" id="datepicker" class="form-control" placeholder="Select Year and Month">
          </div> -->
          <!-- <div class="panel-heading"><h4>&nbsp;<a href="<?= site_url('Welcome/dashboard');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div> -->
          <div class="box-body">
            <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 ex3">
              <div class="box-body">
                <div class="table-responsive" >
                  <table id="table" class="table table-striped table-bordered table-hover">
                    <thead style="background-color:#8cb3d9;">
                      <tr>
                        <th>Sr No</th>
                        <th>Employee Name</th>             
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($get_employee_list)) {  $sr=1; foreach($get_employee_list as $emp) 
                        { 
                          $get_des=$this->Crud_model->GetData('designation','',"id='".$emp->designation_id."'",'','','','1');
                          ?>
                          <tr>             
                            <td><?php echo $sr++;?></td>
                          <td><a style="cursor:pointer;" onclick="get_employee(<?php echo $emp->id;?>)"><?php echo ucwords($emp->name).' ('.ucwords($get_des->designation_name).')';?></a></td> 
                          </tr>
                        <?php }}else { ?>
                          <tr>
                            <td colspan="2">No Data Available
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-8" id="emp_id">
                <div class="box-body">

                  <div class="table-responsive" >
                    <table id="table" class="table table-striped table-bordered table-hover">
                      <thead style="background-color:#8cb3d9;">
                        <tr>
                          <th>Sr No</th>
                          <th>Date</th>
                          <th>Login Time</th>
                          <th>Logout Time</th>
                          <th>Late Mark</th>
                          <th>Status</th>             
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                           if(!empty($attendenceHistory)) { 
                        $sr=1;
                        foreach ($attendenceHistory as $key) 
                        {
                          ?>
                          <tr>
                            <td><?php echo $sr++; ?></td>
                            <td style="width:130px;"><?php echo date('d-M-Y',strtotime($key->date)); ?></td>
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
                            <td><?php if($key->status=='Present'){ ?>
                              <b style="color:green;"><?= $key->status;?></b>
                            <?php } else { ?>
                              <b style="color:red;"><?= $key->status;?></b>
                            <?php } ?>
                            </td>
                        </tr>
                      <?php } }else { 
                      ?>
                      <tr>
                        <td colspan="6"> <center>No data available</center>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<?php $this->load->view('common/footer'); ?>

  <script>
   $(function() {
    $("#datepicker").datepicker( {
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    onClose: function(dateText, inst) { 
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
    });
        });
  </script>
<script>
 function get_employee(id)
  { 

    var date = $("#datepicker").val();

    $.ajax({
            type:"post",
            cache:false,
            url:"<?php echo site_url('LoginHistory/get_empdata');?>",
            data:{id:id,date:date},
            success:function(returndata)
            {
              
              $("#emp_id").html(returndata);
            }

    });
  }
</script>

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
<script type="text/javascript">
  function appendMY()
  {
    var monthap1 = $('#monthap1').val();
    var yearap1 = $('#yearap1').val();
    var empId = $('#empId').val();
    //alert(empId);
    if(empId ==undefined)
    {
        alert('Please click on employee whose summary has to see');
        return false;
    }

    var datastring = "monthap1="+monthap1+"&yearap1="+yearap1+"&empId="+empId;
    //alert(datastring);return false;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('LoginHistory/appendPageHistory'); ?>",
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
