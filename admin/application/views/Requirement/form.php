  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Cities/index'); ?>">Manage Company</a></li>
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
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Employee </label>
                                    
                                    
                                    <select class="form-control" name="employee" id="employee" disabled>
                                        <option value="" >Select Employee</option>
                                        <?php foreach($employee_name as $row) { ?>
                                        <option value="<?php echo $row->id;?>"  <?php if($row->id==$session_id) { echo 'selected'; }?>  ><?php echo $row->name;?></option>
                                        <?php } ?>
                                    </select>
                               
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Business Name<span style="color:red;">* </span></label>
                                    <span style="color:red" id="business_name_err"> </span>
                                    <input type="text" placeholder="Enter Business Name" class="form-control" id="business_name" name="business_name" value="<?php echo $business_name ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Owner Name</label>
                                    
                                    <input type="text" placeholder="Enter Owner Name" class="form-control" id="owner_name" name="owner_name" value="<?php echo $owner_name; ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    
                                    <textarea name="address" id="address" class="form-control"><?php echo $address; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number</label>
                                    
                                    <input type="text" placeholder="Enter Contact Number" class="form-control" id="contact_info" name="contact_info" value="<?php echo $contact_info;?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alternet Contact Number</label>
                                    
                                    <input type="text" placeholder="Enter Alternet Contact Number" class="form-control" id="alter_info" name="alter_info" value="<?php echo $alter_info; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pan Number</label>
                                    
                                    <input type="text" placeholder="Enter Pan Number" class="form-control" id="pan_number" name="pan_number" value="<?php echo $pan_number ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">GST Number</label>
                                    
                                    <input type="text" placeholder="Enter GST Number" class="form-control" id="gst_number" name="gst_number" value="<?php echo $gst_number; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Logo Designing</label>
                                    
                                    <input type="text" placeholder="Enter Logo Designing" class="form-control" id="logo" name="logo" value="<?php echo $logo; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Domain Name </label>
                                    
                                    <input type="text" placeholder="Enter Domain Name" class="form-control" id="domain_name" name="domain_name" value="<?php echo $domain_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Required Tab </label>
                                   
                                    <input type="text" placeholder="Enter Required Tab" class="form-control" id="required_tab" name="required_tab" value="<?php echo $required_tab; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Content </label>
                                    
                                    <input type="text" placeholder="Enter Content" class="form-control" id="content" name="content" value="<?php echo $content; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Social Media Link </label>
                                    
                                    <textarea name="social_link" id="social_link" class="form-control" placeholder="Enter Social Media Link"><?php echo $social_link; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Admin Panel </label>
                                    
                                    <select class="form-control" name="admin" id="admin">
                                        <option value="">Select Admin Panel Provided</option>
                                        <option value="Yes"<?php if($admin=='Yes'){ echo "selected"; }?>>Yes</option>
                                        <option value="No"<?php if($admin=='No'){ echo "selected"; }?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Order Placing Date </label>
                                   
                                    <input type="text" class="form-control" id="datepicker" name="order_date" value="<?php echo $order_date; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Expected Delivery Date </label>
                                    
                                    <input type="text" class="form-control" id="expected_date" name="expected_date" value="<?php echo $expected_date; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Any Referral Website </label>
                                    
                                    <input type="text" class="form-control" id="referred" name="referred" placeholder="Enter Any Referral Website " value="<?php echo $referred; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Product Name</label>
                                    </span>
                                   <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product name" value="<?php echo $product_name; ?>">
                                    
                                </div>
                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Product Description</label>
                                    </span>
                                    <textarea placeholder="Enter Product Description" class="form-control ckeditor" id="product_desc_number" name="product_desc_number"><?php echo $product_desc_number; ?></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mode Of Payment</label>
                                    
                                    <select class="form-control" name="mode_of_payment">
                                        <option value="">Select Mode Of Payment</option>
                                        <option value="Online" <?php if($mode_of_payment=="Online"){ echo 'selected'; } ?>>Online</option>
                                        <option value="Cheque" <?php if($mode_of_payment=="Cheque"){ echo 'selected'; } ?>>Cheque</option>
                                        <option value="Cash" <?php if($mode_of_payment=="Cash"){ echo 'selected'; } ?>>Cash</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Total Payment </label>
                                    
                                    <input type="text" class="form-control" id="total_payment" name="total_payment" placeholder="Enter Total Payment" value="<?php echo $total_payment; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select GST </label>
                                    
                                    <select class="form-control" name="gstadd" id="gstadd" onchange="gst(this.value)">
                                        <option value="">Select GST</option>
                                        <option value="Yes" <?php if($gstadd=='Yes') { echo 'selected';} ?>>Yes</option>
                                        <option value="No" <?php if($gstadd=='No') { echo 'selected';} ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Total Payment + GST Included  </label>
                                    
                                    <input type="text" class="form-control" id="total_payment_gst" name="total_payment_gst" value="<?php echo $total_payment_gst; ?>" readonly="">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Advance Payment </label>
                                    
                                    <input type="text" class="form-control" id="advance_payment" name="advance_payment" placeholder="Enter Advance Payment " value="<?php echo $advance_payment; ?>" onkeyup="packagecost()">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Balance Payment </label>
                                    
                                    <input type="text" class="form-control" id="balance_payment" name="balance_payment" placeholder="Enter Balance Payment " value="<?php echo $balance_payment; ?>" readonly="">
                                </div>
                            </div>
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Requirement');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                          </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer');?>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( function() {
    $( "#datepicker" ).datepicker();
  } );
    $( function() {
    $( "#expected_date" ).datepicker();
  } );
</script>
<script type="text/javascript">
   

function check_error() 
{
    var business_name = $("#business_name").val().trim();
    var employee = $("#employee").val().trim();
   
    if ($.trim(employee) == "") 
    {
        $("#employee_err").fadeIn().html("Select Employee");
        setTimeout(function() {
            $("#employee_err").fadeOut();
        }, 3000);
        $("#employee").focus();
        return false;
    }
   
    if ($.trim(business_name) == "") 
    {
        $("#business_name_err").fadeIn().html("Please enter Business Name");
        setTimeout(function() {
            $("#business_name_err").fadeOut();
        }, 3000);
        $("#business_name").focus();
        return false;
    }
    
    
    
}

     
</script>
<script>
    function gst(val)
    {
        if(val=='Yes')
        {
             var total_payment = parseFloat($("#total_payment").val());
            
        var total_payment1 =  parseFloat(total_payment) * (18/100);
        var total_payment_gst =  parseFloat(total_payment1) + parseFloat(total_payment);

        $("#total_payment_gst").val(total_payment_gst);
        
        
        var total_payment_gst1 = parseFloat($("#total_payment_gst").val());
        var advance_payment = parseFloat($("#advance_payment").val());
        var balance_payment = parseFloat($("#balance_payment").val());
        var totalpayamount =  parseFloat(total_payment_gst1) - parseFloat(advance_payment);
        $("#balance_payment").val(totalpayamount);
        //alert(total_payment_gst);return false;
        }
        else if(val=='No')
        {
            var total_payment = parseFloat($("#total_payment").val());
            $("#total_payment_gst").val(total_payment);
            var total_payment_gst = parseFloat($("#total_payment_gst").val());
            var advance_payment = parseFloat($("#advance_payment").val());

            var balance_payment = parseFloat($("#balance_payment").val());
            var totalpayamount =  parseFloat(total_payment_gst) - parseFloat(advance_payment);
            $("#balance_payment").val(totalpayamount);
            
        }
    }
</script>
<script>
    function packagecost()
{ 
        
    var total_payment_gst = parseFloat($("#total_payment_gst").val());
    var advance_payment = parseFloat($("#advance_payment").val());

    var balance_payment = parseFloat($("#balance_payment").val());
    var totalpayamount =  parseFloat(total_payment_gst) - parseFloat(advance_payment);
    $("#balance_payment").val(totalpayamount);

}
</script>