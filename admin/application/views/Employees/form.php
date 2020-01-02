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
                             <div class="col-md-6" style="display: block" id="Designation">
                                <div class="form-group">
                                    <label for="Image">Designation<span style="color:red;">*</span></label><span style="color:red" id="errordesignation_id"><?php echo form_error('designation_id')?> </span>
                                        <select name="designation_id" id="designation_id" class="form-control" >
                                            <option value="">Select Designation</option>
                                            <?php if(!empty($designation)){ foreach ($designation as $desg) {?>
                                               <option value="<?= $desg->id; ?>" <?php if ($desg_id==$desg->id) { echo "selected";
                                               }?>><?= ucfirst($desg->designation_name); ?></option>
                                           <?php }} ?> 
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name <span style="color:red;">*</span></label> <span style="color:red" id="ename"><?php echo form_error('Employee_name')?> </span>
                                    <input type="text" placeholder="Employee Name" class="form-control" id="name" name="name" value="<?= $name?>" onkeypress="only_alphabets(event)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email ID </label> <span style="color:red" id="erroremail_id"><?php echo form_error('email_id')?> </span>
                                    <input type="text" placeholder="Email" class="form-control" id="email_id" name="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Personal Email ID <span style="color:red;">*</span></label> <span style="color:red" id="personal_email_error"><?php echo form_error('personal_email')?> </span>
                                    <input type="email" placeholder="Personal Email" class="form-control" id="personal_email" name="personal_email" value="<?php echo $personal_email; ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password </label> <span style="color:red" id="errorpassword_id"><?php echo form_error('password')?> </span>
                                   
                                    <input type="text" placeholder="Password" class="form-control" id="password" name="password" value="<?= $password?>" maxlenght="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Mobile No<span style="color:red;">*</span></label> <span style="color:red" id="errorcontact1"> </span><span style="color:red"><?php echo form_error('contact1')?> </span>
                                    <input type="text" placeholder="Mobile No" class="form-control" id="contact1" name="mobile_no" value="<?php echo $mobile_no; ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                          

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">State<span style="color:red;">*</span></label> <span style="color:red" id="estate_id"> </span>
                                        <select name="state_id" id="state_id" class="form-control" onchange="return getcity(this.value)">
                                            <option value="">Select State</option>
                                            <?php if(!empty($states)){ foreach ($states as $key) {?>
                                                <option value="<?= $key->id; ?>" <?php if ($state_id==$key->id) { echo "selected";
                                                }?>><?= $key->state_name; ?></option>
                                            <?php }} ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">City<span style="color:red;">*</span></label> <span style="color:red" id="ecity_id"> </span>
                                        <select name="city_id" id="city_id" class="form-control" >
                                            <option value="">Select City</option>
                                           <?php if($button=='Update') if(!empty($cities)){ foreach ($cities as $key) {?>
                                              <option value="<?= $key->id; ?>" <?php if ($city_id==$key->id) { echo "selected";
                                              }?>><?= $key->city_name; ?></option>
                                          <?php }} ?>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Pin Code<span style="color:red;">*</span></label> <span style="color:red" id="epin_code"> </span>
                                    <input type="text" placeholder="Pin Code" class="form-control" id="pin_code" name="pin_code" value="<?php echo $pincode; ?>" onkeypress="only_number(event)" maxlength="6">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">salary<span style="color:red;">*</span></label> <span style="color:red" id="errorsalary"> </span><span style="color:red"><?php echo form_error('salary')?> </span>
                                    <input type="text" placeholder="Salary" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Address<span style="color:red;">*</span></label> <span style="color:red" id="errorEmployees_address"> </span>
                                    <textarea class="form-control" placeholder="Employees Address" id="address" name="address" placeholder="Employees Address"><?php echo $address; ?></textarea>
                                 
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
    function getcity(val)
{   
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/Employees/get_city');?>",
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata)
        {   
            $('#city_id').html(returndata);
        }
    });
}

function check_error() 
{
    var personal_email = $("#personal_email").val().trim();
    if($.trim(personal_email)=='')
    {   
        $("#personal_email_error").fadeIn().html("Required");
        $("#personal_email").css("border-color", "red");
        setTimeout(function(){$("#personal_email_error").fadeOut();$("#personal_email").css("border-color", "#ccc");},3000);
        $("#personal_email").focus();
        return false;
    }
}
</script>