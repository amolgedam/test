<?php $this->load->view('common/header');?>
<?php $this->load->view('common/left_panel');?>
<style type="text/css">


table.scroll tbody {
    height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
}
table.scroll tbody,
table.scroll thead { display: block; }

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Welcome/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?php echo site_url('Users/index');?>"> <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Customers</span>
              <span class="info-box-number"><?php echo $GetCustomers;?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
           <a href="<?php echo site_url('Employees/index');?>"><div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Employees</span>
              <span class="info-box-number"><?php echo $GetEmployees;?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo site_url('ManageCashOrder/index/Cash');?>"><div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Orders</span>
              <span class="info-box-number"><?php echo $GetOrders;?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo site_url('Subcategory/index');?>"><div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Products</span>
              <span class="info-box-number"><?php echo $GetProducts;?></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
         
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Payments</span>
              <span class="info-box-number" style="color:green;"><?php echo 'Rs. '.number_format(round($GettotalPayments),2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Earn Payments</span>
              <span class="info-box-number" style="color:green;"><?php echo 'Rs. '.number_format(round($GettotalTodayPayments),2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending Payments</span>
              <span class="info-box-number" style="color:red;"><?php echo 'Rs. '.number_format(round($PendingPayments),2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Cancel Orders</span>
              <span class="info-box-number" style="color:orange;"><?php echo $GetCancelOrders;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo site_url('ManageCashOrder/index/Cash/'.date('Y-m-d'));?>"><div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Todays Orders</span>
              <span class="info-box-number"><?php echo $GetTodaysOrders;?></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
       
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Payments</span>
              <span class="info-box-number" style="color:green;"><?php echo 'Rs. '.number_format(round($GetTodaypayment),2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Earn Payments</span>
              <span class="info-box-number" style="color:green;"><?php echo 'Rs. '.number_format(round($GetTodayEarn),2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="col-md-12">
      	<div class="row">
      		<div class="col-md-8">
      			  <div class="panel panel-primary">
			      <div class="panel-heading">
                <h4>Today Assign Milk To Employees <a href="<?php echo site_url('ManageDayWise');?>" class="btn btn-success pull-right">View All</a></h4>
			      	
			      </div>
			      <div class="panel-body">
			      	<table class="scroll table table-bordered">
			    <thead style="background-color:#66ccff;">
			      <tr>
			        <th style="width:10%!important">Sr No</th>
			        <th style="width:20%!important">Employee Name</th>
			        <th style="width:20%!important">Milk Quantity Required</th>
			        <th style="width:20%!important">Milk Assign</th>
			        <th style="width:20%!important">Milk Deliverd</th>
			        <th style="width:10%!important">Balance Quantity</th>
			      </tr>
			    </thead>
			    <tbody style="background-color:#e6f7ff;">
			    	<?php if(!empty($emp_data)) 
			    	{  

			    		/* $sr_no=1;

				  foreach ($emp_data as $emp_data) 
				  {

				    $ids[] = $orderdata->id;
				    $imp_id = implode(",", $ids);

				  }

				    $getorder_Details = $this->Crud_model->GetData('service_orders_details','product_id,sum(quantity) as sum',"service_orders_id IN (".$imp_id.")","product_id");*/


				    /*$a='4'; $sr_no=1; foreach ($getorder_Details as $data) 
				  {

				    $getorder_data = $this->Crud_model->GetData('subcategories','subcat_name,quantity_in_kg',"id='".$data->product_id."'",'','','','1');
				    $product_name = $getorder_data->subcat_name;
				    $available_quantity = $getorder_data->quantity_in_kg;
				    $required_quantity = $data->sum;

				    if($required_quantity > $available_quantity)
				    {
				        $purchase = $required_quantity - $available_quantity;

				        $final_stock = "0";
				    }
				    else
				    {
				        $purchase ="0";
				        $final_stock = $available_quantity - $required_quantity;

				    }*/


			    		//
                $sr_no=1; foreach ($emp_data as $emp)
                {

                  $cond_new ="(executive_id='".$emp->id."' || empnew_id='".$emp->id."') and status='Active' and is_delete='No'"; 
                  $get_lister = $this->Crud_model->GetData('users','sum(pliter) as total_liter',$cond_new,'','','','1');  

                  $total_milk ="<span class='badge' style='background-color:#3973ac;'>".number_format($get_lister->total_liter,1)."</span>";

                  $get_quantity = $this->Crud_model->GetData('milk_day_wise_assign_emp','',"emp_id='".$emp->id."' and date='".date('Y-m-d')."'",'','','','1');

                  if(!empty($get_quantity)){ $m_qua =  number_format($get_quantity->quantity,1);}else{ $m_qua =  "0";}

                  $milk_assign ='<a onclick="get_employee_day_work('.$emp->id.')" class="badge" style="background-color:#ac7339;">'.$m_qua.'</a>';

                  $get_deliver_today = $this->Crud_model->GetData('days_wise_deliverys','sum(quantity) as total_quantity',"emp_id='".$emp->id."' and date='".date('Y-m-d')."'",'','','','1'); 

                  $deliverd_milk ="<span class='badge' style='background-color:#009900;'>".number_format($get_deliver_today->total_quantity,1)."</span>";

                  $a = number_format($get_deliver_today->total_quantity,1);

                  $b_milk = $m_qua - $a;

                  $balance_milk ="<span class='badge' style='background-color:#ac3939;'>".number_format($b_milk,1)."</span>";

            ?>
			    	
			      <tr>
			        <td style="width:10%!important"><center><?php echo $sr_no++;?></center></td>
			       <td style="width:10%!important"><center><a href="<?php echo site_url('ManageCashOrder/index/'.$emp->id)?>"><?php echo ucfirst($emp->name);?></a></center></td>
			        <td style="width:10%!important"><center><?= $total_milk;?></center></td>
			        <td style="width:10%!important"><center><?= $milk_assign;?></center></td>
			        <td style="width:10%!important"><center><?= $deliverd_milk;?></center></td>
			        <td style="width:10%!important"><center><?= $balance_milk;?></center></td>
			      </tr>	 
			  <?php } }else{?>
			  <tr>
			  	<td><center> No Products available</center>
			  	</td>
			  </tr>
			<?php }?>
			    </tbody>
			  </table></div>
			    </div>
      		</div>		
      	</div>
      </div>
    </section>   
  </div>
<?php $this->load->view('common/footer');?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form method="post" action="<?php echo site_url('Welcome/assign_today_milk');?>">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#9fbfdf;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assign Milk Quantity To Employee</h4>
      </div>
      <div class="modal-body">
       <label>Milk Quantity<span style="color:red;">*</span></label><span id="milk_qua_err" style="color:red;"></span>
       <input type="text" name="milk_qua" id="milk_qua" class="form-control" placeholder="Milk Quantity" onkeypress="only_number(event)">
       <input type="hidden" name="emp_id" id="emp_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" onclick="return check_error()">Save</button>
      </div>
    </div>
  </form>
  </div>
</div>

<script type="text/javascript">
	// Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler

</script>
<script>
  function get_employee_day_work(id)
  {
      $("#emp_id").val(id)
      $("#myModal").modal('show');
  }


</script>

<script>
  function check_error()
  {
    var milk_qua = $("#milk_qua").val();

    if(milk_qua=='')
    {
         $("#milk_qua_err").fadeIn().html("Please enter quantity");
          setTimeout(function(){ $("#milk_qua_err").fadeOut(); }, 3000);
          $("#milk_qua").focus();
          return false;
    }

    //alert("go");return false;
     
  }
</script>