
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <div>&nbsp;<?php echo $heading; ?></div>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('CategoryMaster/index'); ?>"><?= $heading;?></a></li>
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
                            
                                <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="control-label">Select Customer Type<span style="color:red;">*</span></label> <span style="color:red" id="customer_type_err"> </span><?php echo form_error('errempfrom')?>
                                                <!-- <select name="empfrom" id="empfrom_id" class="form-control" onchange="get_customerlist(this.value)">
                                                <option value="0">Select Option</option>
                                                <?php foreach ($emp as $key => $value) { ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select> -->
                                            <select name="customer_type" id="customer_type" class="form-control" onchange="customer_hold(this.value)">
                                                <option value="">Select Customer Type</option>
                                                <option value="Customer_Hold">Customer On Hold</option>
                                                <option value="Assign_Employee">Assign To Employee</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="control-label">Employee From<span style="color:red;">*</span></label> <span style="color:red" id="empfrom_id_err"> </span><?php echo form_error('errempfrom')?>
                                                <select name="empfrom" id="empfrom_id" class="form-control" onchange="get_customerlist(this.value)">
                                                <option value="0">Select Option</option>
                                                <?php foreach ($emp as $key => $value) { ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-6 show_cust" style="display: none">
                                              <div class="form-group">
                                            <label class="control-label">Employee To<span style="color:red;">*</span></label> <span style="color:red" id="errempto_id_err"> </span><?php echo form_error('errempto')?>
                                            <select name="empto" id="errempto_id" class="form-control">
                                                <option value="0">Select Option</option>
                                                <?php foreach ($emp as $key => $value) { ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-6 show_cust" style="display: none">
                                              <div class="form-group">
                                            <label class="control-label">Assign Status<span style="color:red;">*</span></label> <span style="color:red" id="assignstatus_err"> </span><?php echo form_error('errassignstatus')?>
                                            <select name="assignstatus" id="assignstatus" class="form-control">
                                                <option value="0">Select Option</option>
                                                <option value="tmp">Temporary</option>
                                                <option value="per">Parmanent</option>
                                            </select>
                                        </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-4 statusDate" style="display: none">
                                             <div class="form-group">
                                            <label class="control-label">Date From<span style="color:red;">*</span></label> <span style="color:red" id="datefrom_err"> </span><?php echo form_error('errdatefrom')?>
                                            <input type="input" name="datefrom" id="datefrom" class="form-control datepicker" placeholder="Date From">
                                        </div>
                                        </div>
                                        <div class="col-md-4 statusDate" style="display: none">
                                            <div class="form-group">
                                            <label class="control-label">Date To<span style="color:red;">*</span></label> <span style="color:red" id="dateto_err"> </span><?php echo form_error('errdateto')?>
                                            <input type="input" name="dateto" id="dateto" class="form-control datepicker" placeholder="Date To">
                                        </div>                                        
                                        </div>                                        
                                        <!-- <div class="col-md-12" style="display: none" id="custList">
                                            <h5>Customer List</h5>
                                            <span style="color:red;">*</span><span style="color:red" id="selectUsers"> </span><?php echo form_error('selectUsers')?>
                                            <div id="cust_data">
                                               <table width="50%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>
                                                                <input type="checkbox" name="allusers" id="allusers" value="all"> Select All
                                                            </th>
                                                            <th>Customer Name</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody id="customerList">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div lass="col-md-12">
                                    &nbsp; &nbsp;
                                </div>
                                    <div class="col-md-12" >
                                    <div class="col-md-2"> 
                                    &nbsp; 
                                    </div>
                                    <div class="col-md-8">  
                                    <div class="form-group">  
                                        <div id="cust_data">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-2">  
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div>
                                            <br>
                                            <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                                <?php echo $button; ?>
                                            </button>
                                            <a href="<?php echo site_url('Usersassign') ?>" class="btn btn-danger" type="button">Cancel</a>
                                        </div>
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
<script type="text/javascript">
    var url="";
    var actioncolumn ="";
    function check_error() 
    { 

        var customer_type = $("#customer_type").val();
        var empfrom_id = $("#empfrom_id").val();
        var errempto_id = $("#errempto_id").val();
        var assignstatus = $("#assignstatus").val();
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();

        if(customer_type=="") 
        {
            $("#customer_type_err").fadeIn().html("Select Customer Type");
            setTimeout(function() 
            {
                $("#customer_type_err").fadeOut();
            }, 3000);
            $("#customer_type").focus();
            return false;
        }

        if(empfrom_id=="0") 
        {
            $("#empfrom_id_err").fadeIn().html("Select Employee From");
            setTimeout(function() 
            {
                $("#empfrom_id_err").fadeOut();
            }, 3000);
            $("#empfrom_id").focus();
            return false;
        }

        if(customer_type=="Assign_Employee") 
        {

            if(errempto_id=="0") 
            {
                $("#errempto_id_err").fadeIn().html("Select Employee To");
                setTimeout(function() 
                {
                    $("#errempto_id_err").fadeOut();
                }, 3000);
                $("#errempto_id").focus();
                return false;
            }
            if(assignstatus=="0") 
            {
                $("#assignstatus_err").fadeIn().html("Select Assign Status");
                setTimeout(function() 
                {
                    $("#assignstatus_err").fadeOut();
                }, 3000);
                $("#assignstatus").focus();
                return false;
            }

            var check = $("input[name*='cust_id']:checked").length;

            if(check=="0") 
            {
                $("#selectUsers").fadeIn().html("Select Assign Customer");
                setTimeout(function() 
                {
                    $("#selectUsers").fadeOut();
                }, 3000);
                return false;
            }

             if(assignstatus=="tmp") 
            {

                if(datefrom=="") 
                {     
                          $("#datefrom_err").fadeIn().html("Select From Date");
                    setTimeout(function() 
                    {
                        $("#datefrom_err").fadeOut();
                    }, 3000);
                    $("#datefrom").focus();
                    return false;
                }

                if(dateto=="") 
                {
                       $("#dateto_err").fadeIn().html("Select To Date");
                        setTimeout(function() 
                        {
                            $("#dateto_err").fadeOut();
                        }, 3000);
                        $("#dateto").focus();
                        return false;
                }

            }
        }
        else
        {

                if(datefrom=="") 
                {     
                          $("#datefrom_err").fadeIn().html("Select From Date");
                    setTimeout(function() 
                    {
                        $("#datefrom_err").fadeOut();
                    }, 3000);
                    $("#datefrom").focus();
                    return false;
                }

                if(dateto=="") 
                {
                       $("#dateto_err").fadeIn().html("Select To Date");
                        setTimeout(function() 
                        {
                            $("#dateto_err").fadeOut();
                        }, 3000);
                        $("#dateto").focus();
                        return false;
                }

            var check = $("input[name*='cust_id']:checked").length;

            if(check=="0") 
            {
                $("#selectUsers").fadeIn().html("Select Assign Customer");
                setTimeout(function() 
                {
                    $("#selectUsers").fadeOut();
                }, 3000);
                return false;
            }
        }

        
    }
</script>
<script>
    function get_customerlist(val)
    {
        $.ajax({
            type:"post",
            cache:false,
            url:"<?php echo site_url('Usersassign/get_list')?>",
            data:{val:val},
            success:function(returndata)
            { 
                $("#cust_data").html(returndata);
            }
        });
    }
</script>
<script>
      
$( function() {
$( ".datepicker" ).datepicker({
  changeMonth: true,
  changeYear: true,
   minDate: 0,
dateFormat: 'yy-m-d'
});
} );
  
</script>

<script>
   function customer_hold(val)
   {
        if(val=='Customer_Hold')
        {
            $(".show_cust").hide();
            $(".statusDate").show();
        }
        else
        {
            $(".show_cust").show();
            $(".statusDate").hide();
        }
   }
</script>



