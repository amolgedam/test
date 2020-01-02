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
        <?php 
     $assign_marketing=$this->Crud_model->GetData('admin','',"designation_id='3' and status='Active'");
     
        ?>
         <?php 
                       if($_SESSION['SESSION_NAME']['designation']=='admin')
                    {  ?>
                <div class="col-md-4">
                            <label>Select Assign <span id="assign_id_err" style="color:red;"></span></label>
                            <select name="assign_id" id="assign_id" class="form-control" onchange="return getdata(this.value)">
                            <option value="0">--Assign Execuative--</option>
                    <?php if(!empty($assign_marketing)) { foreach($assign_marketing as $assign){?>
                            <option value="<?php echo $assign->id;?>"><?php echo ucfirst($assign->name);?>     </option>
                                
                       <?php }} ?>
                            </select>
                          </div> 
                <div class="col-md-2"><br>
         <input type="hidden" id="val" name="val">
        <input type="hidden" name="id" id="id">
     <button type="submit" name="submit" class="btn btn-info" onclick="return assign_data();">Assign</button>
                </div>
              <?php } ?>
                        <div class="content-header_button  pull-right"> 
         <a data-target="#uploadData" title="Upload Excel" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-primary"><span class="fa fa-file-excel-o"></span>&nbsp; Import Excel</a>   
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                              <input type="hidden" name="selected_client" id="selected_client" class="filter_search_data1" >
                                <tr>
                                    <th>Sr No</th>
                <th>  <input type="checkbox" name="checkbox" id="select_all" class="select_all"> </th>
                                    <th>Assign By</th>
                                    <th>Email ID</th>
                                    <th>Company Name</th>
                                    <th>Lead Type</th>
                                    <th>State</th>
                                    <th>District</th> 
                                    <th>Address</th> 
                                    <th>Follow Date</th> 
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

<!--IMport strart-->
<div class="modal inmodal" id="uploadData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">   
            <form method="post" action="<?= site_url('LLP_company_data/import_excel')?>" method="post" enctype="multipart/form-data" onsubmit="return checkXcel()">  
                <div class="modal-header">
                    <span style="font-size:20px">Upload Sheet</span>
                </div>     
                <div class="modal-body" style="padding-top: 3%">

                    <a download class="pull-right" href="<?php echo base_url('uploads/LLP_company_data/LLP.xlsx'); ?>" style="font-size:10px">Download Sample Format</a> 
                    <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls">
                        &nbsp;<span style="color:red" id="errorexcel_file"></span>&nbsp;
                </div>
                <div class="modal-footer">
                    <button type="button" id="dis_btn" class="btn btn-success" onclick="return checkXcel();">Ok</button>
                    <button type="submit" id="btn_click" style="display:none" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end import modal -->

<!-- Followup date Modal -->
<div id="follow_date" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Add Followup Date
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h4>
        </div>
        <div class="modal-body">
          <form id="frm_add" method="POST">
            <input type="hidden" class="form-control" name="LLP_id" id="company_data_id">
            <label>Date<span style="color:red">*</span><span style="color:red" id="date_err"></span></label>
            <input type="text" class="form-control" name="follop_date" id="follo_date" placeholder="Select Date"> <br>
            <label>Remark<span style="color:red">*</span><span style="color:red" id="name_err"></span></label>
            <textarea name="remark" id="remark_data" class="form-control" placeholder="Enter Remark.."></textarea>
          </form>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-success waves-effect" id="btn_submit" onclick="return create_follow_date()">Save</button>
          <button type="button" class="pull-left btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Followup Model -->

<div class="modal fade" id="deleteData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">   
            <form method="post" action="<?= $deleteAction ?>">       
                <div class="modal-body" style="height: 120px;padding-top: 3%">
                    <center>
                        <input type="hidden" name="id" id="deleteId" style="display: none;">
                        <span style="font-size: 16px">Are you sure want to delete?</span>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Onprocess model -->
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
              <Select   class="form-control" id="lead_type" name="lead_type" value="" onchange="hello(this.value)" required>
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
              <textarea name="lead_remark" id="lead_remark" class="form-control"></textarea>
              <input type="hidden" id="lead_id" name="lead_id">
            </div>
          </div>
           <div class="col-md-12" id="report_data" style="display:none;">
          <!-- <div class="col-md-12" id="" style="">
            
            <div class="form-group">
              <label class="control-label">Order No <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('order_no') ?></span>
              <input type="text"  class="form-control" id="order_no" name="order_no" value="" >
            </div>
          </div>-->
           <div class="col-md-12" id="date1" style=";">
            <div class="form-group">
              <label class="control-label">Delivery date <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('odate') ?></span>
              <input type="text"  class="form-control" id="o_date" name="delivery_date" value="" >
            </div>
          </div>
            <div class="col-md-12" id="" style="">
            <div class="form-group">
              <label class="control-label">Product <span style="color:red;">*</span></label> <span style="color:red" id="email_err"><?php echo form_error('requred_product') ?></span>
              <input type="text"  class="form-control" id="requred_product" name="required_product" value="" >
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="button" id="submit" name="submit" class="btn btn-success" onclick="return insert_lead()">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- End Onprocess Model -->

<!--mail-->
   <!-- Modal -->
  <div class="modal fade" id="mail" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <!--  <h4 class="modal-title">Send Mail</h4> -->
        </div>
        <div class="modal-body">
        <form  method="post" action="<?php echo site_url('Manage_company_data/send_mail')?>" enctype="multipart/form-data">
        
        <div class="row">
         <!--  <div class="col-md-12"> -->
            <div class="col-md-6">
           
              <input type="hidden" class="form-control" name="email" id="email_email">
       <input type="hidden" name="id" id="email_id" value="">
            </div>
               <div class="col-md-12">
                   <label>From</label>
          <select name="from_mail" id="from_mail" class="form-control">
             
              <option value="account@worldplanetesolution.com">account@worldplanetesolution.com</option>
              <option value="hrd@worldplanetesolution.com">hrd@worldplanetesolution.com</option>
              <option value="info@worldplanetesolution.com">info@worldplanetesolution.com</option>
              <option value="marketing@worldplanetesolution.com">marketing@worldplanetesolution.com</option>
          </select>
            </div> 
    
             <div class="col-md-12">
               <label>Subject</label>
             <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="">
            </div>

             <div class="col-md-12">
               <label>Description</label>
             <textarea name="description" id="description" class="ckeditor form-control " placeholder="Content"></textarea>
            </div>
            <!-- </div> -->
          </div>
            
          </div>
       
        <div class="modal-footer">
           <button type="submit" class="btn btn-success" name="submit">Send</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  
  <!--End Mail-->
<script>
    var url = '<?= site_url('LLP_company_data/ajax_manage_page/'.$flag)?>';
    var actioncolumn=10;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script src="<?= base_url(); ?>assets/custom_js/LLP_data.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( function() {
     $("#follo_date").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1900:+0',
  defaultDate: '01 JAN 1900',
  dateFormat: 'dd/mm/yy',
    });
      } );
      
       $("#o_date").datepicker({
      changeMonth: true,
      changeYear: true,
    });
</script>

<script type="text/javascript">
  function get_view_description(id,required_product)
{
   $("#view_message").modal('show');
    $("#lead_id").val(id);
   $("#requred_product").val(required_product); 
   
}
function mail(id,email)
{
  $('#mail').show();
  $("#email_id").val(id);
    // console.log(id);

  $("#email_email").val(email);
   
 } 
 
 function hello(val)
{
    if(val=='Complete')
    {
        $("#report_data").show(); 
    }
    else if(val=='Reject')
    {
        $("#report_data").hide();
        
    }
    else
    {
      $("#report_data").hide();

    }
}
</script>

<script type="text/javascript">
  function getdata(val)
  {

    var selected_client = $("#selected_client").val();
      var val = val;

      if(selected_client=='')
      {
        alert('Please select at least one checkbox');
        return false;
      }

     // $("#sendmailModalresult").modal('show');

     $("#val").val(val);
     $("#id").val(selected_client);
  }

</script>

<script type="text/javascript">
    setInterval(function(){ 
        uni_array(); 
    }, 3000);
   
    function uni_array(){

      var chk_all = $(".select_all").is(":checked");
      // console.log(chk_all);

      if(chk_all == true)
      {
        var ids = $(".append_ids").val();
        $("#selected_client").val(ids);
      }
        var strVale = $("#selected_client").val();
        var arr = strVale.split(',');
        var arr1 = Array.from(new Set(arr));
        // console.log(arr1);
        $("#selected_client").val(arr1);
    }

    function remove_data(remove_val){
    var array_val1 = $("#selected_client").val();
    
    var difference = [];
    var array_val = array_val1.split(",");
   
    for( var i = 0; i < array_val.length; i++ ) { //console.log(remove_val);
        // if( $.inArray( array_val[i], remove_val ) == -1 ) {
        if(array_val[i] != remove_val) {
            // console.log(array_val[i]);
                difference.push(array_val[i]);
        }
    }
    return difference;
}  
function checkbox_all(id) 
{
    var myarray = new Array();
    myarray.push($("#selected_client").val());
    var checkbox_all = $("#client_id_"+id).is(":checked");
    //alert(checkbox_all); return false;
    if(checkbox_all==true)
    {
        if(myarray=='')
        {
            myarray[0]=($("#client_id_"+id).val());
        }else
        {
           myarray.push($("#client_id_"+id).val());
        }
        $("#client_id_"+id).attr('name', 'clients[]');        
    }
    else
    {$("#select_all").attr('checked',false);
        var remove_val = $("#client_id_"+id).val();
        //removeA(myarray, $("#lead_ids"+id).val()); 
        var new_arr = remove_data(remove_val);
        myarray = new_arr;
        $("#client_id_"+id).attr('name', 'YeNhiJayega');  
        $("#client_id_"+id).attr('name', 'YeNhiJayega');  
    }
    // console.log(myarray);
    $("#selected_client").val(myarray);
   
}

$('#select_all').click(function(){
 
     var checkbox_all = $(this).is(":checked");
     if(checkbox_all==true)
        { 
            table.draw();
        }else{
            $('#selected_client').val('');
             table.draw();
        }
});
</script>
