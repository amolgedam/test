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
               <a href="<?= site_url('ManageDayWise');?>" class="btn btn-warning pull-right"><i class="fa fa-refresh" aria-hidden="true"></i></a>
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
                      <th>Employee Name</th>
                      <th>Date</th>
                      <th>Milk Required</th>
                      <th>Milk Assign</th>
                      <th>Milk Deliverd</th>
                      <th>Balance Quantity</th>
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
    var url = '<?= site_url('ManageDayWise/ajax_manage_page/')?>';
   // alert(url);
    var actioncolumn=6;
</script>
<script>
$(document).ready(function () {
$('input[id$=datepicker]').datepicker({
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
});
});
$(document).ready(function () {
$('input[id$=date_list]').datepicker({
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
});
});
</script>

