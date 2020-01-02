<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Contact Us View
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Contact Us View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          <div>
            <div class="col-lg-12">
              <a href="<?= site_url('Contact_us');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a>
            </div>
            </div>
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View</h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Full Name :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($first_name)) { echo $first_name.' '.$last_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Email :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($email_id)) { echo $email_id;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile no :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($mobile_no)) { echo $mobile_no;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Pin code :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($pin_code)) { echo $pin_code;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <!--<div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Message :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($message)) { echo $message;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">address :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}  ?></p>
                    </div>
                </div>-->
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Country name :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($country_name)) { echo $country_name;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">State name:</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($state_name)) { echo $state_name;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">City Name:</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($city_name)) { echo $city_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Message :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($message)) { echo $message;}else {echo "N/A";}?></p>
                    </div>
                </div>
              </div>
            </div>
            </div>
            </div>
             </section>
                 </div>
               <!--  <div class="box box-primary">
               
                   <div class="box-header">
                       <div class="content-header_button  pull-right"> 
                         <a class="btn btn-primary" title="Download Format" download="region.xls" href="<?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                           <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a>
                        <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Enquiry</a>
                       </div>  
                   </div>
               
                  
               <div class="box-body">
                   <div class="table-responsive" >
                       <table id="table" class="table table-bordered table-striped example_datatable">
                           <thead>
                               <tr>
                                   <th>Sr No</th>
                                   <th>Enquiry Code</th>
                                   <th>Full Name</th>
                                   <th>Mobile</th>
                                   <th>email</th>
                                   <th>Enquiry Date</th>
                                   <th>City</th>
                                   <th>Profession</th>
                                   <th>Joining Plan</th>
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
               </div> -->

<!--Import from excel-->
<!-- <div id="upload_location_modal" class="modal fade" role="dialog">
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
</div> -->
<!--End import from excel-->

<!-- <div class="modal inmodal" id="checkStatus" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">   
            <form method="post" action="<?= $changeAction ?>">       
                <div class="modal-body" style="height: 100px;padding-top: 10%">
                    <center>
                        <input type="hidden" name="id" id="statusId" style="display: none;">
                        <span style="font-size: 16px">Are you sure to change the status?</span>
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

<div class="modal fade" id="deleteData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">   
            <form method="post" action="<?= $deleteAction ?>">       
                <div class="modal-body" style="height: 120px;padding-top: 3%">
                    <center>
                        <input type="hidden" name="id" id="deleteId" style="display: none;">
                        <span style="font-size: 16px">Are you sure want to delete this city ?</span>
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
</div> -->
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










