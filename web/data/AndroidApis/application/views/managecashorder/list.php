<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $heading;?>
      <small><!--advanced tables--></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Welcome/dashboard/'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
     <li class="active"><?= $heading;?></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header">
            <div class="content-header_button"> 
              <form class="form-horizontal filter_data_form" action="<?php  echo site_url('ManageCashOrder/export'); ?>" method="post">
                <div class="col-md-4">
                <label>Employees</label>
                <select class="form-control filter_search_data5" name="emp_id" id="emp_id">
                  <option value="">Select Employees</option>
                  <?php if(!empty($get_employee)) { foreach($get_employee as $emp) { ?>
                  <option value="<?php echo $emp->id?>" <?php if(!empty($flag)) { if($flag==$emp->id){ echo "selected";}}?>><?php echo $emp->name?></option>
                <?php } } ?>
                </select>
                
              </div>
              <div class="col-md-4">
                <label>Days</label>
                <input type="text" name="datepicker" id="datepicker" class="form-control filter_search_data4" placeholder="Select Date" readonly value="<?php if(!empty($flag)) { echo date('Y-m-d');}?>">
                
              </div>
              <!-- <div class="col-md-1">
              <label>&nbsp;&nbsp;</label><br>
              <button class="btn btn-info" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
              </div>
              </form>
               <form class="form-horizontal" action="<?php  echo site_url('ManageCashOrder/GetProductList'); ?>" Method="post">
              <div class="col-md-3">
                 <label>Product List<span style="color:red;">*</span><span id="date_list_err" style="color:red;"></span></label><br>
                <input type="text" name="date_list" id="date_list" class="form-control filter_search_data4" placeholder="Select Date" readonly>
               
                </div>
                <div class="col-md-1">
                  <label>&nbsp;&nbsp;</label><br>
              <button class="btn btn-success" type="submit" onclick="return checkdate_list();"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
               </div>
             </form> -->
               <div class="col-md-1">
                <label>&nbsp;&nbsp;</label><br>
               <a href="<?= site_url('ManageCashOrder');?>" class="btn btn-warning pull-right"><i class="fa fa-refresh" aria-hidden="true"></i></a>
            </div>

                <!-- <a class="btn btn-primary" title="Download Format" download="region.xls" href="<?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                  <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a> -->
                <!-- <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Affilation</a>  -->
            </div>  
          </div> 
                          
          <div class="box-body">
            <div class="table-responsive" >
              <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                <thead>
                  <tr>
                      <th>Sr No</th>
                      <th>Customer Name</th>
                      <th>Employee Name</th>
                      <th>Customer Address</th>
                      <th>Delivery Address</th>
                      <th>Quantity</th>
                      <th>Delivery Date</th> 
                     <!--  <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('common/footer');  ?>
<script>
    var url = '<?= site_url('ManageCashOrder/ajax_manage_page/')?>';
   // alert(url);
    var actioncolumn=6;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); 

function Delete(cid)
{
    //alert("dgdfdhg");return false;
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('ManageCashOrder/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          //alert(returndata);return false;
          table.draw();
         
        }
      });
  }
}
function statuss(id)
{ 
  var cnf = confirm('Are you sure to change the status?');
  if(cnf==true)
  {
    var status=$("#status"+id).val();
    if(status=="Active")
    {
      $("#statusVal"+id).removeClass("btn-success");
      $("#statusVal"+id).addClass("btn-danger");
      $("#statusVal"+id).attr("onclick", "statuss("+id+",'Inactive')").html('Inactive');
      var status ='Inactive';
      $("#status"+id).val('Inactive');
    }
    else
    {
      $("#statusVal"+id).removeClass("btn-danger");
      $("#statusVal"+id).addClass("btn-success");
      $("#statusVal"+id).attr("onclick", "statuss("+id+",'Active')").html('Active');
      var status ='Active';
      $("#status"+id).val('Active');
    } 
    var datastring="id="+id+"&status="+status+"&statusupdate="+'update';
    $.ajax({
        type:"POST",
        url:"<?=  site_url('Affilation_center/change_status')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          //alert(returndata);
          //console.clear();  
        }
      });   
  }
}

function show_modalss(id)
{
    
  $("#sendmailModal").modal('show');
  $("#id_order_id").val(id);

  $.ajax({
          type:"POST",
          url:"<?= site_url('ManageCashOrder/getpaymentstatus') ?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 
            
               $("#payment_status").val(returndata);      
          }
        });



}
</script>
<script type="text/javascript">

function show_order_process(id,customer_id,order_status)
{
    
  $("#orderProcess_id").modal('show');
  $("#order_id").val(id);
  $("#customer_id").val(customer_id);
  
  var order_status = order_status;
  
  if(order_status=='1') 
   {
      $("#notshow_status").hide();
      $("#notshow_status_or").show();
   }
   else
   {
      $("#notshow_status").show();
      $("#notshow_status_or").hide();
   }

  $.ajax({
          type:"POST",
          url:"<?= site_url('ManageCashOrder/getOrderLog_data') ?>",
          data:{id:id,customer_id:customer_id},
          cache:false,                    
          success:function(returndata)
          { 
              var json = $.parseJSON(returndata);
            //alert(json.log);return false;
              //alert(returndata);return false;
               $("#show_order_log").html(json.log);      
                
          }

        });



}
</script>



<script>

  
function show_modalss_order(id,customer_id)
{

  $("#sendmailModal_orderdata").modal('show');
  $("#id_order_data").val(id);
  $("#customer_id_new").val(customer_id);
  
  


  $("#description").val('');
  /*$("#reason_location").val('');
  $("#reason_product").val('');
  $("#reason_other").val('');*/
  $("#order_status_data").val(''); 
  $("#show_description").hide();
  $("#show_reason").hide(); 

  $.ajax({
          type:"POST",
          url:"<?= site_url('ManageCashOrder/getorderstatus');?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 

                var json = $.parseJSON(returndata);

                //alert(returndata);return false;

                $("#order_status_data").val(json.order_status);  

               if(json.order_status=='Cancel')
               {

                  var radioValue = json.reason;
                  
                  if(radioValue=='other')
                  {
                      $("#reason_other").prop("checked", true);
                      $("#show_description").show();   
                      $("#description").val(json.description);  
                      $("#show_reason").show();
                  }
                  else if(radioValue=='product')
                  {

                    $("#reason_product"). prop("checked", true);
                    $("#show_reason").show();
                
                  }
                  else if(radioValue=='location')
                  {
                      $("#reason_location"). prop("checked", true);
                      $("#show_reason").show();
                    
                  }

                   
                  

               }

               
          }
        });

}
</script>
<script type="text/javascript">
  function selectresons(val)
  {
      if(val=='Cancel')
      {
        $("#show_reason").show();
      }
      else
      {
        $("#show_reason").hide();
        $("#show_description").hide();
      }
  }

  function selectdescription(val)
  {

    //alert(val);

      if(val=='other')
      {
        $("#show_description").show();
      }
      else
      {
          $("#show_description").hide();
      }
  }

</script>
<script type="text/javascript">
   function saveorder_data()
  {

    var order_status_data = $("#order_status_data").val();
    var reason = $("input[name='reason']:checked"). val();
    var description = $("#description").val().trim();
   
    if(order_status_data=='Cancel')
    {

      if(reason==undefined)
      {
        //alert(reason);return false;
          $("#reason_err").fadeIn().html("Please Select Reason");
          setTimeout(function() 
          {
              $("#reason_err").fadeOut();
          }, 3000);
          $("#reason").focus();
          return false;
      } 

      if(reason=='other')
      {
        if(description=='')
        {
          $("#description_err").fadeIn().html("Please enter Description");
          setTimeout(function() 
          {
              $("#description_err").fadeOut();
          }, 3000);
          $("#description").focus();
          return false;
        }

      }
    }
    //alert("go");
  }


</script>
<script type="text/javascript">
  
  function send_data()
  {
     var order_process = $("#order_process").val()
     var order_id = $("#order_id").val()
     var customer_id = $("#customer_id").val()

     if(order_process=='')
     {
        $("#order_process_err").fadeIn().html("Required");
            setTimeout(function() 
            {
                $("#order_process_err").fadeOut();
            }, 3000);
            $("#order_process").focus();
            return false;

     }

     $.ajax({
              type:"POST",
              cache:false,
              url:"<?= site_url('ManageCashOrder/updatedOrderProcess');?>",
              data:{order_process:order_process,order_id:order_id,customer_id:customer_id},
              success:function(returndata)
              {

               // alert(returndata);return false;

                if(returndata=='1')
                {
                   location.reload();
                }

              }


     })


  }


</script>



  <script>
    $(document).ready(function () {
        $('input[id$=datepicker]').datepicker({
          dateFormat: 'yy-mm-dd'
        });
    });
      $(document).ready(function () {
        $('input[id$=date_list]').datepicker({
          dateFormat: 'yy-mm-dd'
        });
    });
</script>
<script type="text/javascript">
  function checkdate_list()
  {

    var date_list =$("#date_list").val().trim();

    if(date_list=='')
    {
       $("#date_list_err").fadeIn().html("Required");
      setTimeout(function() 
      {
          $("#date_list_err").fadeOut();
      }, 3000);
      $("#date_list").focus();
      return false;
    }
    

  }

</script>












