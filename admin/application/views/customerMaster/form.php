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
            <li><a href="<?php echo site_url('CustomerMaster'); ?>">Manage Customer</a></li>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Customer Name <span style="color:red;">*</span></label> <span style="color:red" id="errorcustomer_name"><?php echo form_error('customer_name')?> </span>
                                    <input type="text" placeholder="Customer Name" class="form-control" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" onkeypress="only_alphabets(event)">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Customer Gst No. <span style="color:red;"></span></label> <span style="color:red" id="errorgst_no"><?php echo form_error('customer_name')?> </span>
                                    <input type="text" placeholder="Customer GST Number" class="form-control" id="customer_gst_no" name="customer_gst_no" value="<?php echo $gst_no; ?>">
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
                                    <label for="Image">Mobile No<span style="color:red;">*</span></label> <span style="color:red" id="errorcontact1"> </span><span style="color:red"><?php echo form_error('contact1')?> </span>
                                    <input type="text" placeholder="Mobile No" class="form-control" id="contact1" name="mobile_no" value="<?php echo $mobile_no; ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Customer Address<span style="color:red;">*</span></label> <span style="color:red" id="errorcustomer_address"> </span>
                                    <input type="text" placeholder="Customer Address" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">State</label>
                                        <select name="state_id" id="state_id" class="form-control" onchange="return getcity(this.value)">
                                            <option value="7">Maharashtra</option>
                                            <?php if(!empty($states)){ foreach ($states as $key) {?>
                                                <option value="<?= $key->id; ?>" <?php if ($state_id==$key->id) { echo "selected";
                                                }?>><?= $key->state_name; ?></option>
                                            <?php }} ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">City</label>
                                        <select name="city_id" id="city_id" class="form-control" >
                                            <option value="3229">Nagpur</option>
                                            <?php if(!empty($cities)){ foreach ($cities as $key) {?>
                                                <option value="<?= $key->id; ?>" <?php if ($city_id==$key->id) { echo "selected";
                                                }?>><?= $key->city_name; ?></option>
                                            <?php }} ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Pin Code</label>
                                    <input type="text" placeholder="Pin Code" class="form-control" id="pin_code" name="pin_code" value="<?php echo $pin_code; ?>" onkeypress="only_number(event)" maxlength="6">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary" type="submit">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('CustomerMaster/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
<?php $this->load->view('common/footer');?>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>

<script type="text/javascript">
    function only_number(event)
      {
        var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
        {
          return;
        }else{
          event.preventDefault();
        }    
      }
        function only_alphabets(event)
      {
        var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ) ||(x==32))
        {
          return;
        }else{
          event.preventDefault();
        }    
      }
    function check_error() 
    {
        var customer_name = $("#customer_name").val().trim();
        // var customer_gst_no = $("#customer_gst_no").val().trim();
        // var email_id = $("#email_id").val().trim();
        var contact1 = $("#contact1").val().trim();
        var address = $("#address").val().trim();
        // var validateEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if(customer_name=='')
        {
            $("#errorcustomer_name").fadeIn().html("Please enter Customer Name").css("color","red");
            setTimeout(function(){$("#errorcustomer_name").fadeOut("&nbsp;");},2000)
            $("#customer_name").focus();
            return false;
        }
        
        // if(customer_gst_no=='')
        // {
        //     $("#errorgst_no").fadeIn().html("Please enter Customer GST Number").css("color","red");
        //     setTimeout(function(){$("#errorgst_no").fadeOut("&nbsp;");},2000)
        //     $("#customer_gst_no").focus();
        //     return false;
        // }
        
       /* if (email_id =='')
        {
             $("#erroremail_id").fadeIn().html("Please enter Email ID").css("color","red");
            setTimeout(function(){$("#erroremail_id").fadeOut("&nbsp;");},2000)
            $("#email_id").focus();
            return false;
        }
        else if(!validateEmail.test(email_id))
        {
            $("#erroremail_id").fadeIn().html("Invalid email").css("color","red");
            setTimeout(function(){$("#erroremail_id").fadeOut("&nbsp;");},2000)
            $("#email_id").focus();
            return false;       
        } */    
        if (contact1 == "")
        {
            $("#errorcontact1").fadeIn().html("Please enter mobile no").css("color","red");
            setTimeout(function(){$("#errorcontact1").fadeOut("&nbsp;");},2000)
            $("#contact1").focus();
            return false;
        }

        if (address == "") 
        {
            $("#errorcustomer_address").fadeIn().html("Please enter Address").css("color","red");
            setTimeout(function(){$("#errorcustomer_address").fadeOut("&nbsp;");},2000)
            $("#address").focus();
            return false;
        }
    }
</script>
<script type="text/javascript">

function getcity(val)
{
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/CustomerMaster/get_city');?>",
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata)
        {   
            $('#city_id').html(returndata);
        }
    });
}
</script>