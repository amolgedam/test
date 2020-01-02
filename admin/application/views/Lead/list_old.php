


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
                                    <th>Client Name</th>
                                    <th>Client Mobile</th>
                                   
                                    <th>Requred Product</th>
                                    <th>Date</th>
                                    <th>Follop Date</th>
                                    <th>Appoint Date</th>
                                  
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
</div>

<!-- assign Modal -->

  <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel"> Add Assign
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h4>
</div>
<!-- Modal Body -->
 <div class="modal-body">
  <form id="frm_add" method="POST">
    <input type="hidden" name="id" id="id">
        <label>Lead<span style="color:red">*</span><span style="color:red" id="client_name_err"></span></label>
        <input type="text" class="form-control" placeholder="Enter Lead" name="client_name" id="client_name" readonly=""> <br>
      <label>Product<span style="color:red">*</span><span style="color:red" id="product_err"></span></label>
        <input type="text" class="form-control" placeholder="Enter product" name="requred_product" id="requred_product" readonly=""><br>
         <label>Assign To<span style="color:red">*</span><span style="color:red" id="assign_to_err"></span></label>
        <select name="assign_to" id="assign_to" class="form-control">
          <option value="">--Select Role--</option>
         
        </select><br>
       
          <label>Description<span style="color:red">*</span><span style="color:red" id="name_err"></span></label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter Message"></textarea>
 </form>
      </div>  <!-- End Modal Body -->

                                
                       <div class="modal-footer">
                   <button type="button" class="btn btn-success waves-effect" id="btn_submit" onclick="return update_manage_lead()">Update</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                 </div>
                                 </div>
                                <!-- /.modal-content -->
                                         </div>
                              <!-- /.modal-dialog -->                                           <!-- Add  Popup Model -->
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
<!-- Modal Body -->
 <div class="modal-body">
  <form id="frm_add" method="POST">
   <input type="hidden" class="form-control" name="manage_lead_id" id="manage_lead_id">
        <label>Date<span style="color:red">*</span><span style="color:red" id="date_err"></span></label>
        <input type="date" class="form-control" name="date" id="date"> <br>
  
          <label>Remark<span style="color:red">*</span><span style="color:red" id="name_err"></span></label>
        <textarea name="remark" id="remark" class="form-control" placeholder="Enter Remark.."></textarea>
 </form>
      </div>  <!-- End Modal Body -->

                                
                       <div class="modal-footer">
                   <button type="button" class="btn btn-success waves-effect" id="btn_submit" onclick="return create_follow_date()">Add</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                 </div>
                                 </div>
                                <!-- /.modal-content -->
                                         </div>
                              <!-- /.modal-dialog -->                                           <!-- Add  Popup Model -->
     </div>

<?php $this->load->view('common/footer'); ?>
<!-- End Folloup Date modal -->
<script type="text/javascript" src="<?= base_url()?>assets/custom_js/assign.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/custom_js/followup_date.js"></script>

<script>
    var url = '<?= site_url('Lead/ajax_manage_page/'.$flag)?>';
    var actioncolumn=9;
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
          //alert(returndata);
          //console.clear();  
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





/*function update(id)
 {   
    
       var site_url = $("#site_url").val();
        $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/get_manage_lead',
        data:{
          id:id,
        },
        success:function(returndata)
        {
            //alert(returndata); return false;
          obj=$.parseJSON(returndata);
          $("#client_name").val(obj.client_name);
          $("#id").val(obj.id);
          $("#requred_product").val(obj.requred_product);
          $("#assign_to").val(obj.assign_to);
        
          $("#description").val(obj.description);

        }
      })
 }*/
</script>



       

    </script>

<script type="text/javascript" >
  $(document).ready(function() {
    
  
  $.ajax({ url: '<?= site_url("Lead/assign_to");?>',type: 'GET'  }).done(function(book_type) { var objbook_type= $.parseJSON(book_type); $.each(objbook_type, function (i, objbook_type) {
                                    $('#assign_to').append($('<option>', { value: objbook_type.id, text: objbook_type.name})); }); }).fail(function() { console.log("error"); }).always(function() {  console.log("complete");
                                        }); 
                  });  
</script>
