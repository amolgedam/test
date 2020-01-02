<style>
    textarea {
        resize: none;
    }
</style>
<style type="text/css">
    .multiselect {
  width: 500px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<style type="text/css">
    .multiselects {
  width: 500px;
}

.selectBoxs {
  position: relative;
}

.selectBoxs select {
  width: 100%;
  font-weight: bold;
}

.overSelects {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxess {
  display: none;
  border: 1px #dadada solid;
}

#checkboxess label {
  display: block;
}

#checkboxess label:hover {
  background-color: #1e90ff;
}
</style>
<style>
table, th, td {
  border: 3px solid black;
}
th, td {
  padding: 13px;
}
table {
  border-spacing: 15px;
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
            <li><a href="<?php echo site_url('Certificates/index'); ?>">Manage Certificates</a></li>
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
                                <div class="form-group">
                                    <label class="control-label">Certificates Name <span style="color:red;">* </span></label>
                                    <span style="color:red" id="certificate_type_id_err"> </span>
                                     <select name="certificate_type_id" id="certificate_type_id" class="form-control"  >
                                             <option value="0">Select</option>
                                            <?php if(!empty($type)){ foreach ($type as $key) {?>
                                                
                                                <option value="<?= $key->id; ?>" <?php if ($certificate_type_id==$key->id) { echo "selected";
                                                }?>><?= $key->title; ?></option>
                                            <?php }} ?>
                                             </select>
                                </div>
                            </div>
                           
                            
                           <div class="col-md-12">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea type="text" placeholder="Enter description" class="form-control ckeditor" id="description" name="description" ><?php if (!empty($description)){echo $description;}else{ echo "";} ?></textarea>
                                </div>
                            </div>
                             <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea type="text" placeholder="Enter description" class="form-control ckeditor" id="description1" name="description1" ><?php if (!empty($description1)){echo $description1;}else{ echo "";} ?></textarea>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea type="text" placeholder="Enter description" class="form-control ckeditor" id="description2" name="description2" ><?php if (!empty($description2)){echo $description2;}else{ echo "";} ?></textarea>
                                </div>
                            </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea type="text" placeholder="Enter description" class="form-control ckeditor" id="description3" name="description3" ><?php if (!empty($description3)){echo $description3;}else{ echo "";} ?></textarea>
                                </div>
                            </div>
                          </div>   <!--col-md-12-->
                            <input type="hidden" name="id" id="id" class="form-control" value=<?php echo $id; ?>>
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Certificates');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                           
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
<script type="text/javascript">
   function check_error() 
{
    var certificate_type_id = $("#certificate_type_id").val().trim();
   
    if ($.trim(certificate_type_id) == "0") 
    {
        $("#certificate_type_id_err").fadeIn().html("Please Select Certificate Type");
        setTimeout(function() {
            $("#certificate_type_id_err").fadeOut();
        }, 3000);
        $("#certificate_type_id").focus();
        return false;
    }
   
}
</script>
<script>
function routewisecustomer(route_id)
{ 
    alert(1);return false;
  var site_url = $("#site_url").val();
  var url = site_url+"/Routewise_distribution/routewisecuatomer";
  $.ajax({
    type:'post',
    url:url,
    data: {route_id:route_id},
    cache:false,
    success:function(returndata){
      //$("#append_data_test").html(returndata);
            if(returndata==1)
            {
                $('#append_customer_table').val(0);    
                
            }
    }
  });
}

    
</script>
<script type="text/javascript">
    

function getbalance(employee_id)
{ 
   
    var vehicle_id= $("#employee_id").val();
     var mobile_no= $("#mobile_no").val();
     var designation_id= $("#designation_id").val();
     var salary= $("#salary").val();
     var joining_date= $("#joining_date").val();

        $.ajax({
        type:"post",    
        cache:false,
        url:"<?php echo site_url('Certificates/get_balance');?>",
        data:{employee_id:employee_id},
        success:function(returndata)
        {   
            if(returndata==1)
            {
                $('#mobile_no').val(0);    
                $('#designation_id').val(0);    
                $('#salary').val(0);    
                $('#joining_date').val(0);    
                
            }
            else if(returndata==2)
            {

                $('#mobile_no').val(0);    
                $('#designation_id').val(0);    
                $('#salary').val(0);    
                $('#joining_date').val(0);    
               
            } 
            else
            {
                var obj = JSON.parse(returndata);
                $('#mobile_no').val(obj.mobile_no);    
                $('#designation_id').val(obj.designation_id);    
                $('#salary').val(obj.salary);    
                $('#joining_date').val(obj.joining_date);    
               
            }  
        }
    });
}
    
</script>
<script>
    function totalkm()
    {
        var start_meter=$('#start_meter').val();
        var end_meter=$('#end_meter').val();
        var total_km=$('#total_km').val();
        var total_km_amt=$('#total_km_amt').val();
        var total_km =  parseFloat(end_meter) - parseFloat(start_meter);
        $("#total_km").val(total_km);
        var diesel_rate=$('#diesel_rate').val();
        var average=$('#average').val();
         var total_km_amt =  (parseFloat(total_km) * parseFloat(diesel_rate))/parseFloat(average) ;
          $("#total_km_amt").val(total_km_amt);
    }

</script>
<script>
    function driverbalance()
    {
         
      
       if(parseFloat($("#advance").val()) > parseFloat($("#total_km_amt").val()))
            $("#advance").val(parseFloat($("#total_km_amt").val()));
        
            var total_km_amt = parseFloat($("#total_km_amt").val());
            //alert(total_km_amt);return false;
            var advance = parseFloat($("#advance").val());
          var driver_balance = parseFloat($("#driver_balance").val());
           
           var balance =  parseFloat(total_km_amt) - parseFloat(advance);
            $("#driver_balance").val(balance);
    }

</script>
<script>
function filledjar_event()
{ 
    
    var delivered_jar=$('#delivered_jar').val();
    //alert(delivered_jar);return false;
  var jar_limit=$('#jar_limit').val();
  var balance_jar=$('#balance_jar').val(); 
 if((parseInt(jar_limit)-parseInt(balance_jar)) <parseInt(delivered_jar))
 {
 alert("Delivered jar  should not greater than the Jar Limit");
 $('#delivered_jar').val(0);


 }
}
</script>
<script>
        function updatenewbalance()
    { 
            var newbalance_jar = parseFloat($("#newbalance_jar").val());
            var jar_limit = parseFloat($("#jar_limit").val());
          
            var return_jar = parseFloat($("#return_jar").val());
            var damage_jar = parseFloat($("#damage_jar").val());
           var totalpayamount =  parseFloat(jar_limit) - (parseFloat(return_jar)+parseFloat(damage_jar));
            $("#newbalance_jar").val(totalpayamount);
        }
</script>
