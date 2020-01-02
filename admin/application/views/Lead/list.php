<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $heading; ?>
      <small><!--advanced tables--></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
      <li class="active"><?php echo $heading; ?></li>
    </ol>
  </section>
  <section class="content"> 
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header">
            <div class="content-header_button  pull-right"> 
              <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Lead</a> 
            </div>  
          </div>
          <div class="box-body">
            <div class="table-responsive" >
              <table id="table" class="table table-bordered table-striped example_datatable">
                <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Created by</th>
                    <th>Assign To</th>
                    <th>Client Name</th>
                    <th>Client Mobile</th>
                    <th>Lead Type</th>
                    <th>Required Product</th>
                    <th>Date</th>
                    <th>Followup Date</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <input type="hidden" id="flag" name="flag" value="<?php echo $flag?>">
        </div>
      </div>
    </div>
  </div>
<!-- assign Modal -->
<div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Add Assign
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h4>
        </div>
        <div class="modal-body">
          <form id="frm_add" method="POST">
            <input type="hidden" name="id" id="id">
            <label>Lead<span style="color:red">*</span><span style="color:red" id="client_name_err"></span></label>
            <input type="text" class="form-control" placeholder="Enter Lead" name="client_name" id="client_name" readonly=""> <br>
            <label>Product<span style="color:red">*</span><span style="color:red" id="product_err"></span></label>
            <input type="text" class="form-control" placeholder="Enter product" name="requred_product" id="requred_product" readonly=""><br>
            <label>Assign To<span style="color:red">*</span><span style="color:red" id="assign_to_err"></span></label>
            <select name="assign_to" id="assign_to" class="form-control" data-placeholder="Select Employee">
            </select><br>
            <label>Description<span style="color:red">*</span><span style="color:red" id="name_err"></span></label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter Message"></textarea>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success waves-effect" id="btn_submit" onclick="return update_manage_lead()">Update</button>
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Assign Modal -->

<!-- Followup date Modal -->
<div id="follow_date" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Add Followup Date
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <input type="hidden" class="form-control" name="manage_lead_id" id="manage_lead_id">
            <label>Date<span style="color:red">*</span><span style="color:red" id="date_err"></span></label>
            <input type="text" class="form-control" name="date" id="date" data-provide="datepicker" placeholder="Select Date"> <br>
            <label>Remark<span style="color:red">*</span><span style="color:red" id="remark_err"></span></label>
            <textarea name="remark" id="remark_new" class="form-control" placeholder="Enter Remark.."></textarea>
          </form>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-success waves-effect" id="btn_submit" onclick="return create_follow_date()">Save</button>
          <button type="button" class="pull-left btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div id="view_message" class="modal fade" id="contacts" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Status  of Order</h4>
      </div>
      <div class="modal-body" id="view_description">
        <div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Select Status<span style="color:red;">*</span></label> <span style="color:red" id="mobile_err"><?php echo form_error('client_mobile') ?></span>
              <Select   class="form-control" id="lead_purchase" name="lead_purchase" value=""  onchange="hello(this.value)" required>
                <option value="">Select Option</option>
                <option value="Complete">Complete</option>
                <option value="Reject">Reject</option>
                <option value="Fake">Fake</option>
                 <option value="Visit_interested">Visit Interested</option>
                <option value="Visit_not_interested">Visit Not Interested</option>
                <option value="Visit_not_mate">Visit Not Mate</option>
              </Select>
              <br/>
              <label>Remark</label>
              <textarea name="type_remark" id="type_remark" class="form-control"></textarea>
              
            </div>
          </div>
           <div class="col-md-12" id="date_new" style="display:none;">
           <div class="col-md-12" id="" style="">
            <input type="hidden" id="lead_id" name="lead_id">
            <div class="form-group">
              <label class="control-label">Order No <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('order_no') ?></span>
              <input type="text"  class="form-control" id="order_no" name="order_no" value="" placeholder="Order No">
            </div>
          </div>
          <div class="col-md-12" id="date1" style=";">
            <div class="form-group">
              <label class="control-label">Delivery date <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('odate') ?></span>
              <input type="Date"  class="form-control" id="o_date" name="o_date" value="">
            </div>
          </div>
            <div class="col-md-12" id="" style="">
            <div class="form-group">
              <label class="control-label">Product <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('requred_product') ?></span>
              <input type="text"  class="form-control" id="requred_product_new" name="requred_product_new" value="" placeholder="Product Name">
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="button" id="button" class="btn btn-success" onclick="return insert_lead()">Submit</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="site_url" value="<?php echo site_url()?>">

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="<?= base_url('assets/custom_js/lead.js');?>"></script>
<script>
    var url = '<?= site_url('Lead/ajax_manage_page/'.$flag)?>';
    var actioncolumn=10;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
function checkStatus(id){
    $("#statusId").val(id);
    $("#deleteId").val(id);
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
        url:"<?=  site_url('Lead/change_status')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          
        }
      });   
  }
}

function Delete(obj,id)
{
  
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $("id"+id).fadeOut();
    var datastring="id="+id;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Lead/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
         
        }
      });
  }
}

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
    minDate:new Date()

});
</script>



       

    </script>

<script type="text/javascript" >
$(document).ready(function() {
$.ajax({ url: '<?= site_url("Lead/assign_to");?>',type: 'GET'  }).done(function(book_type) { var objbook_type= $.parseJSON(book_type); $.each(objbook_type, function (i, objbook_type) {
$('#assign_to').append($('<option>', { value: objbook_type.id, text: objbook_type.name})); }); }).fail(function() { console.log("error"); }).always(function() {  console.log("complete");
}); 
});  
</script>
<script>
  function get_view_description(id,requred_product)
{

    $("#view_message").modal('show');
    $("#lead_id").val(id);
    $("#requred_product").val(requred_product);
   
}
</script>
<script>
function hello(val)
{
    
  
    if(val=='Complete')
    {
        $("#date_new").show(); 
    }
    else if(val=='Reject')
    {
        $("#date_new").hide();
        
    }
    else
    {
      $("#date_new").hide();

    }
}
</script>


