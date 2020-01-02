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
                <label>Orders List</label>
                <input type="text" name="datepicker" id="datepicker" class="form-control filter_search_data4" placeholder="Select Date" readonly>
                <input type="hidden" name="flag" value="<?= $flag;?>">
              </div>
              <div class="col-md-2">
              <label>&nbsp;&nbsp;</label><br>
              <button class="btn btn-info" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
               <button class="btn btn-success pull-right" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
            </div>

                <!-- <a class="btn btn-primary" title="Download Format" download="region.xls" href="<?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                  <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a> -->
                <!-- <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Affilation</a>  -->
            </div>  
          </div> 
          </form>                
          <div class="box-body">
            <div class="table-responsive" >
              <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                <thead>
                  <tr>
                      <th>Sr No</th>
                      <th>Order No</th>
                      <th>Customer Name</th>
                      <th>Total Product</th>
                      <th>Total Quantity</th>
                      <th>Sub Total</th>
                      <th>Service Charges</th>
                      <th>Final Amount</th>
                      <th>Order Status</th>
                      <th>Payment Status</th>
                      <!-- <th>Payment Type</th> -->
                      <th>Order Process</th>
                      <th>Booking Date</th>     
                      <th>Action</th>
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

<div class="modal fade" id="orderProcess_id" role="dialog" data-backdrop="static" >
  <div class="modal-dialog modal-md">
   <!--  <form id="FormID" method="post" action="<?php echo site_url('ManageCashOrder/save_payment_data');?>" enctype="multipart/form-data"> -->  
      <div class="modal-content">
        <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
          <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
            <h4 class="modal-title">Updated Status</h4> 
        </div>
        <div class="modal-body">                                             
          <div class="col-sm-12">
            <div class="form-group">
               <div class="col-md-10">

                  <label>Order Process <span style="color:red;">*</span> <span style="color:red;" id="order_process_err"></span></label>
                  
                  <select class="form-control" id="order_process" name="order_process">
                    <option value="">Select</option>
                    <option value="Order Placed">Order Placed</option>
                    <option value="Order Packed">Order Packed</option>
                    <option value="Order Dispatch">Order Dispatch</option>
                    <option value="Order Deliver">Order Deliver</option>
                    <option value="Order On Hold">Order On Hold</option>
                    <option value="Order Cancel">Order Cancel</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="hidden" name="customer_id" id="customer_id" value="">
                  <input type="hidden" name="order_id" id="order_id" value="">
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <a type="button" class="btn btn-primary pull-right" onclick="return send_data()">Save</a>
               </div>    
            </div>

            <div>
              <span  id="show_order_log"></span>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer">
            <input type="hidden" id="id_order" name="id_order">
            <!-- <button type="submit" class="btn btn-primary  bg-color-1" id="save_enroll">Update</button> -->
            <!-- <button type="button" class="btn btn-primary  bg-color-1" onclick="return submit_data()">Update</button> -->
             <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
          </div>
        </div>
      <!-- </form> -->
    </div>
  </div>
  </div>

<!--Import from excel-->
<div id="upload_location_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="<?= site_url('Masters/importLocation')?>" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="font-size:25px" data-dismiss="modal">&times;</button>
        <span style="font-size:20px">Upload Sheet</span>
      </div>

      <div class="modal-body">
        <input type="file" name="excel_file" id="image" onclick="imageFile()">
        <span id="errmsg" style="color:red;"></span> 
        <span id="errmsg1" style="color:red;"></span> 
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onclick="return check_error()">Upload</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
   </form>
  </div>
</div>
<div class="modal fade" id="sendmailModal" role="dialog" data-backdrop="static" >
  <div class="modal-dialog modal-md">
    <form id="FormID" method="post" action="<?php echo site_url('ManageCashOrder/save_payment_data');?>" enctype="multipart/form-data">  
      <div class="modal-content">
        <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
          <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
            <h4 class="modal-title">Updated Status</h4> 
        </div>
        <div class="modal-body">                                             
          <div class="col-sm-12">
            <div class="form-group">
              <label for="varchar">Payment Status<span style="color:red;">*</span><span  style="color:red" id="entrollment_id_err" class= "errid"></span>
              </label> 
              <div class="form-line">
                <select class="form-control" id="payment_status" name="payment_status">
                  <option value="Done">Confirm</option>
                  <option value="Pending">In process</option>
                  <option value="Book">Book</option>
                  <option value="Cancel">Cancel</option>
                </select>
              </div>     
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer">
            <input type="hidden" id="id_order" name="id_order">
            <button type="submit" class="btn btn-primary  bg-color-1" id="save_enroll">Update</button>
            <!-- <button type="button" class="btn btn-primary  bg-color-1" onclick="return submit_data()">Update</button> -->
             <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>




<div class="modal fade" id="sendmailModal_orderdata" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <form id="FormID" method="post" action="<?php echo site_url('ManageCashOrder/save_order_data');?>" enctype="multipart/form-data">  
      <div class="modal-content">
        <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
          <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
          <h4 class="modal-title">Updated Order Status</h4> 
        </div>
        <div class="modal-body">                        
          <div class="col-sm-12">
            <div class="form-group">
              <label for="varchar">Order Status<span style="color:red;">*</span><span  style="color:red" id="entrollment_id_err" class= "errid"></span></label> 
              <div class="form-line">
                <select class="form-control" id="order_status_data" name="order_status_data" onchange="return selectresons(this.value);">
                  <option value="Done">Confirm</option>
                  <option value="Pending">In Process</option>
                  <option value="Cancel">Cancel</option>
                </select>
              </div>
              <div>&nbsp;</div>
              <div class="col-md-12" style="display:none;" id="show_reason">
                <div class="form-group">
                  <label>Select Reason <span style="color:red;">*</span><span style="color:red;" id="reason_err"></span></label><br>
                  <div class="row">
                    <div class="col-md-4">
                      <input type="radio" name="reason" id="reason_location"  value="location" onclick="return selectdescription(this.value)">Location Not found
                    </div>
                    <div class="col-md-4">
                      <input type="radio" name="reason" id="reason_product"  value="product" onclick="return selectdescription(this.value)">Product not available
                    </div>
                    <div class="col-md-4">
                      <input type="radio" name="reason" id="reason_other"  value="other" onclick="return selectdescription(this.value)">Other
                    </div>
                  </div>
                </div>  
              </div>
              <div class="col-md-12" style="display:none;" id="show_description">
                <div class="form-group">
                <label>Description <span style="color:red;">*</span><span style="color:red;" id="description_err"></span></label><br>
                <div class="form-line">
                <textarea type="text" name="description" id="description" class="form-control"></textarea>
              </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer">
            <input type="hidden" id="id_order_data" name="id_order_data">
            <input type="hidden" id="customer_id" name="customer_id">
            <button type="submit" class="btn btn-primary  bg-color-1" id="save_enroll" onclick="return saveorder_data();">Update</button>
             <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--End import from excel-->
<script>
    var url = '<?= site_url('ManageCashOrder/ajax_manage_page/'.$flag)?>';
   // alert(url);
    var actioncolumn=12;
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
  $("#id_order").val(id);

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

function show_order_process(id,customer_id)
{
    
  $("#orderProcess_id").modal('show');
  $("#order_id").val(id);
  $("#customer_id").val(customer_id);

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
  $("#customer_id").val(customer_id);


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
</script>












