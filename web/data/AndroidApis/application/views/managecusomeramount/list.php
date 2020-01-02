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
                <div class="col-md-4">
                <label>Customer Name</label>
                <select class="select2 form-control filter_search_data5" name="cust_name" id="cust_name">
                  <option value="">Select Customer</option>
                  <?php if(!empty($get_customer)) {  foreach($get_customer as $cust) { ?>
                  <option value="<?php echo $cust->id;?>"><?php echo $cust->name?></option>
                <?php } } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label>Days</label>
                <input type="text" name="datepicker" id="datepicker" class="form-control filter_search_data4" placeholder="Select Date" readonly> 
              </div>
            <div class="col-md-1">
                <label>&nbsp;&nbsp;</label><br>
               <a href="<?= site_url('ManageCusomerAmount');?>" class="btn btn-warning pull-right"><i class="fa fa-refresh" aria-hidden="true"></i></a>
            </div>
            </div>  
          </div> 
                          
          <div class="box-body">
            <div class="table-responsive" >
              <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                <thead>
                  <tr>
                      <th>Sr No</th>
                      <th>Customer Name</th>
                      <th>Month</th>
                      <th>Total Days</th>
                      <th>Total Liter</th>
                      <th>Amount</th>
                      <th>Status</th>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Get Customer Amount</h4>
      </div>
      <div class="modal-body">
          <div class="row">
        <div class="col-md-12">
          <label>Amount</label><span style="color:red;">*</span><span style="color:red;" id="amount_err"></span>
          <input type="text" class="form-control" name="amount" id="amount" placeholder="amount">
          <input type="hidden" id="customer_id">
        <input type="hidden" id="month">
        </div>
        </div>
        
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-success" onclick="save_data()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php $this->load->view('common/footer');  ?>
<script>
    var url = '<?= site_url('ManageCusomerAmount/ajax_manage_page/'.$date)?>';
    var actioncolumn=7;
</script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
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
</script>
<script type="text/javascript">
  
function payment(customer_id,month)
{
  //alert(customer_id);
  //alert(month);

  $("#myModal").modal('show');
  $("#customer_id").val(customer_id);
  $("#month").val(month);

}

function save_data()
{
  var amount = $("#amount").val();
  var customer_id = $("#customer_id").val();
  var month = $("#month").val();

    if(amount=='')
    {
        $("#amount_err").fadeIn().html("Please enter Amount").css("color","red");
        setTimeout(function(){$("#amount_err").fadeOut("&nbsp;");},2000)
        $("#amount").focus();
        return false;
    }

    $.ajax({

            type:"post",
            cache:false,
            url:"<?php echo site_url('ManageCusomerAmount/save_payment')?>",
            data:{amount:amount,month:month,customer_id:customer_id},
            success:function(returndata)
            {
               if(returndata==1)
               {
                   window.location.href= "ManageCusomerAmount";
               }
               else
               {
                  window.location.href= "ManageCusomerAmount";
               }
            }
    });
}

</script>