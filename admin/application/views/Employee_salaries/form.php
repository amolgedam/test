<style>
    textarea {
        resize: none;
    }
</style>

<div class="content-wrapper"> 
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Employees'); ?>">Manage Employees</a></li>
            <li class="active">
                <?= $heading;?>
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
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" onsubmit="return check_error()">
                            <!--  <div class="col-md-12">
                               <div class="form-group">
                                   <label for="Image">Type<span style="color:red;">*</span>&nbsp;&nbsp;</label>
                                       <input type="radio" name="type" id="admin" value="admin" <?php if($type=='admin') echo "checked='checked'"; ?> onclick="removedesignation()">Admin &nbsp;
                                       <input type="radio" name="type" id="user" value="user"  <?php if($type=='user') echo "checked='checked'"; ?> onclick="getdesignation()">User
                               </div>
                                                        </div> -->
                                 <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Year<span style="color:red;">*</span></label> <span style="color:red" id="estate_id"> </span>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">Select Year</option>
                                            <?php if($button=='Create') { $currentYear = date('Y');
                                        foreach (range($currentYear, 1950) as $value) {?>
                                        
                                         <option value="<?php echo $value; ?>" <?php if($value==$currentYear){ echo "selected"; } ?>><?php echo $value; ?></option>
                                        
                                   
                                  <?php } } else { $currentYear = date('Y');
                                        foreach (range($currentYear, 1950) as $value){ ?>
                                         <option value="<?php echo $value; ?>" <?php if($value==$year){ echo "selected"; } ?>><?php echo $value; ?></option>
                                  <?php } }?>
                                        </select>
                                  
                                </div> 
                                    <div class="form-group">
                                    <label for="Image">Employee<span style="color:red;">*</span></label> <span style="color:red" id="estate_id"> </span>
                                        <select name="emp_id" id="emp_id" class="form-control" onchange=" getsalary(this.value);getworkingdays(this.value)">
                                            <option value="">Select Employee</option>
                                            <?php if(!empty($employee)){ foreach ($employee as $key) {?>
                                                <option value="<?= $key->id; ?>" <?php if ($emp_id==$key->id) { echo "selected";
                                                }?>><?= $key->name; ?></option>
                                            <?php }} ?>
                                        </select>
                                </div>
                                
                            </div>                       
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Month<span style="color:red;">*</span></label> <span style="color:red" id="estate_id"> </span>
                                        <select name="month" id="month" class="form-control">
                                            <option value="">Select Month</option>
                                            <?php
                                   $currentmonth= date('m'); 
                                   for ($m=01; $m<=12; $m++) {
                                   $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                                   ?>
                                   <?php if($button=='Update'){?> 
                                   <option value="<?php echo $m; ?>" <?php if($m==$months){ echo "selected"; } ?>><?php echo $month;?></option>
                                   <?php } else{ ?>
                                   <option value="<?php echo $m; ?>" <?php if($m==$currentmonth){ echo "selected"; } ?>><?php echo $month;?></option>
                                   <?php } }?>
                                   
                                   
                                        </select>
                                    </div>
                                </div>
                             <div class="col-md-6" style="display: block" id="Designation">
                                <div class="form-group">
                                    <label for="Image">Salary<span style="color:red;">*</span></label><span style="color:red" id="errordesignation_id"><?php echo form_error('designation_id')?> </span>
                                    <input type="text" name="acual_salary" id="salary" placeholder="Salary" value="<?= $acual_salary;?>" class="form-control" readonly>
                                      
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Working Days </label> <span style="color:red" id="erroremail_id"><?php echo form_error('email_id')?> </span>
                                    <input type="text" placeholder="Working days" class="form-control" id="worikingdays" name="working_Days" value="<?= $working_days;?>" readonly>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Paid Leaves </label> <span style="color:red" id="errorpassword_id"><?php echo form_error('password')?> </span>
                                   
                                    <input type="text" placeholder="Paid Leaves" class="form-control" id="paid_salary" name="paid_leaves" value="<?= $paid_leaves;?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                          
                        
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Employees/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url();?>assets/custom_js/employees.js"></script>
<?php $this->load->view('common/footer');?>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>

<script type="text/javascript">
function getsalary(id)
{   
    //var id = val;
    //alert(id); return false;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/Employee_salaries/get_empsalary');?>",
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata)
        {   
            $('#salary').val(returndata);
        }
    });
}
function getworkingdays(id)
{   
    var month= $("#month").val();
    var year= $("#year").val();
    //alert(year); return false;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/Employee_salaries/get_workingdays');?>",
        data:{id:id,month:month,year:year},
        beforeSend:function(){},
        success:function(returndata)
        {  
            $('#worikingdays').val(returndata);
        }
    });
}
</script>