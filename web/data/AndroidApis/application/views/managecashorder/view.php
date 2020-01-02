<div class="content-wrapper">
    <section class="content-header">
      <h1>
          <?php echo $heading;?>
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"><?php echo $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          <div>
            <div class="col-lg-12">
              <a href="<?= site_url('ManageCashOrder/index/'.$payment_type);?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a>
            </div>
            </div>
            <div>&nbsp;</div>
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-default">

              <div class="panel-heading">
                <div class="row">
                <div class="col-md-4">
                <h4>View</h4>
              </div>
              <div class="col-md-4">
                &nbsp;
              </div>
                <!-- <div class="col-md-3">

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
                <div class="col-md-1">
                  <input type="hidden" name="customer_id" id="customer_id" value="<?= $customer_id; ?>">
                  <input type="hidden" name="order_id" id="order_id" value="<?= $order_id; ?>">
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <a type="button" class="btn btn-primary pull-right" onclick="return send_data()">Save</a>
               </div> -->
                </div>
                </div>
              
              <div class="panel-body">
                <div class="col-md-8">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Customer Name :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($username)) { echo $username;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Total Product :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($total_product)) { echo $total_product;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Total Quantity :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($total_quantity)) { echo $total_quantity;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Sub Total :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($sub_total)) { echo 'Rs. '.$sub_total;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Extra Charges :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($extra_charges)) { echo 'Rs. '.$extra_charges;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Final Amount :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($final_amount)) { echo 'Rs. '.number_format($final_amount,2);}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Discount :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($discount)) { echo $discount;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Payment Status :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($payment_status)) { echo $payment_status;}else {echo "N/A";}  ?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Booking date :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($booking_date)) { echo date('j M Y',strtotime($booking_date));}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Payment Type :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($payment_type)) { echo $payment_type;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Name :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($name)) { echo $name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Email :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($mobile)) { echo $mobile;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Cancel Reason :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($reason)) { echo $reason;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Cancel Description :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Address :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
              </div>
              <div class="col-md-4">

                 <div class="panel panel-info">
      <div class="panel-heading">Order Log</div>
      <div class="panel-body">
         <table class="table table-bordered">
  <tr>
    <th>Sr.no</th>
    <th>Order Status</th>
    <th>Request From</th>
    <th>Date</th>
    
  </tr>
  <?php if(!empty($get_orderlog)) { 
      $sr=1; foreach ($get_orderlog as $orderlog) 
      {     
    ?>
  <tr>
    <td><?= $sr++;?></td>
    <td><?= $orderlog->order_status;?></td>
    <td><?= $orderlog->request_from;?></td>
    <td><?= date('jS M Y H:i',strtotime($orderlog->order_date));?></td>
  </tr>
<?php } }else { ?>
  <tr>
    <td colspan="3">No order logs</td>
  </tr>

<?php } ?>
 </table>


      </div>
    </div>
                 
              </div>
              </div>
            
             <div class="container">
              <h3>Product List</h3>           
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($getorderdetails as $details)  { ?>
                  <tr>
                    <td>
                      <?php if(file_exists('uploads/subcategory/'.$details->image)) 
                      {
                          if(!empty($details->image))
                          {
                        ?>
                      <img src="<?= base_url('uploads/subcategory/'.$details->image)?>" style="height:100px;width:150px;">
                    <?php }else { ?>
                      <img src="<?= base_url('uploads/subcategory/9627_index.jpg')?>" style="height:100px;width:150px;">
                    <?php } }else {?>
                      <img src="<?= base_url('uploads/subcategory/9627_index.jpg')?>" style="height:100px;width:150px;">
                    <?php } ?>
                    </td>
                    <td><?php if(!empty($details->subcat_name)) { echo $details->subcat_name;}else{ echo "N/A";}?></td>
                    <td><?= 'Rs. '.number_format($details->price,2);?></td>
                    <td><span class="badge"><?= $details->quantity;?></span></td>
                    <td><?= 'Rs. '.number_format($details->total,2);?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            </div>
            </div>
            </div>
             </section>
                 </div>

            
<script>
    var url = '<?= site_url('EnquiryForm/ajax_manage_page')?>';
    var actioncolumn=10;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
/*function checkStatus(id){
    $("#statusId").val(id);
    $("#deleteId").val(id);
}*/



function Delete(obj,cid)
{
  
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('EnquiryForm/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
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
        url:"<?=  site_url('EnquiryForm/change_status')?>",
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











