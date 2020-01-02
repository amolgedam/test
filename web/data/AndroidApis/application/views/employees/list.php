<div class="content-wrapper">
    <section class="content-header">
      <h1>
    <?= $heading;?>
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
                          <!-- <a class="btn btn-primary" title="Download Format" download="region.xls" href="<?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a> -->
                           <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Employees</a>
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Image</th>
                                    <th>Full Name</th>
                                    <th>Email id</th>
                                    <th>Mobile no</th>
                                    <!-- <th>Designation</th> -->
                                    <th>Address</th>
                                    <th>Customer Count</th>
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

<div class="modal fade" id="sendmailModalresult" role="dialog" data-backdrop="static" >
        <div class="modal-dialog modal-md">
          <form id="FormID" method="post" action="<?php echo site_url('Users/save_result');?>" " enctype="multipart/form-data">  
                         
                <div class="modal-content">
                    <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
                      <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                      <h4 class="modal-title">Get Result Data</h4> 
                    </div>
                    <div class="modal-body">
                          
                            
                             <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Mark Obtain<span style="color:red;">*</span></label><span  style="color:red" id="marks_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                      <input type="text" class="form-control" name="marks" id="marks" placeholder="Marks"/>
                                      </div>
                                  </div>
                              </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Remark<span style="color:red;">*</span></label><span  style="color:red" id="remark_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                      <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark"/>
                                      </div>
                                  </div>
                              </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer"   >
                      <input type="hidden" id="id_marks" name="id_marks">

                      <button type="submit" class="btn btn-primary  bg-color-1" onclick="return resultsubmit()">Update</button>
                       <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>


<?php $this->load->view('common/footer'); ?>
 <div class="modal fade" id="sendmailModal" role="dialog" data-backdrop="static" >
        <div class="modal-dialog modal-md">
          <form id="FormID" method="post" action="<?php echo site_url('Users/save_enrollment');?>" " enctype="multipart/form-data">  
                         
                <div class="modal-content">
                    <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
                      <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                      <h4 class="modal-title">Genrate Entrollment Id</h4> 
                    </div>
                    <div class="modal-body">
                          
                            
                             <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Entrollment Id<span style="color:red;">*</span></label><span  style="color:red" id="entrollment_id_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                      <input type="text" class="form-control" name="entrollment_id" id="entrollment_id" placeholder="Entrollment Id"/>
                                      </div>
                                  </div>
                              </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer"   >
                      <input type="hidden" id="id_enroll" name="id_enroll">
                      <button type="submit" class="btn btn-primary  bg-color-1" style="display:none" id="save_enroll">save</button>
                      <button type="button" class="btn btn-primary  bg-color-1" onclick="return submit_data()">Update</button>
                       <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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

<script>
    var url = '<?= site_url('Employees/ajax_manage_page')?>';
    var actioncolumn=8;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
/*function checkStatus(id){
    $("#statusId").val(id);
    $("#deleteId").val(id);
}*/





  function Delete(cid)
{
  //alert("delete");return false;
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Employees/delete'); ?>",
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
        url:"<?=  site_url('Employees/change_status')?>",
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
  
function show_modalss(id)
{
    
  $("#sendmailModal").modal('show');
  $("#id_enroll").val(id);

  $.ajax({
          type:"POST",
          url:"<?= site_url('Users/returndata_user') ?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 
            
               $("#entrollment_id").val(returndata);
             
           
          }
        });



}

function show_resultdata(id)
{
 
  $("#sendmailModalresult").modal('show');
  $("#id_marks").val(id);


  $.ajax({
          type:"POST",
          url:"<?= site_url('Users/getdata_result') ?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 
            	//alert(returndata);return false;
           		var json = $.parseJSON(returndata);

           		//alert(returndata);exit;

               $("#marks").val(json.marks);
               $("#remark").val(json.remark);
             
           
          }
        });

}



function submit_data()
{
      
      var entrollment_id = $("#entrollment_id").val().trim();
      var id_enroll = $("#id_enroll").val();

        //alert(id_enroll);return false;

      if(entrollment_id=="")
      {
        $("#entrollment_id_err").fadeIn().html("Please enter Entrollment Id");
        setTimeout(function(){ $("#entrollment_id_err").fadeOut(); }, 3000);
        $("#entrollment_id").focus();
        return false;
      }

       $.ajax({
          type:"POST",
          url:"<?= site_url('Users/chck_enroll') ?>",
          data:{id_enroll:id_enroll,entrollment_id:entrollment_id},
          cache:false,                    
          success:function(returndata)
          { 

            if(returndata==1)
            {
              $("#entrollment_id_err").fadeIn().html("Already exits");
              setTimeout(function(){ $("#entrollment_id_err").fadeOut(); }, 3000);
              $("#entrollment_id").focus();
              return false;
              
            }
            else if(returndata==2)
            {
              $("#save_enroll").click();
            }
                    
          }
        });





}


function resultsubmit()
{
 
  var marks = $("#marks").val().trim();
  var remark = $("#remark").val().trim();

  if(marks=="")
  {
    $("#marks_err").fadeIn().html("Please enter Marks");
    setTimeout(function(){ $("#marks_err").fadeOut(); }, 3000);
    $("#marks").focus();
    return false;
  }
   if(remark=="")
  {
    $("#remark_err").fadeIn().html("Please enter Remark");
    setTimeout(function(){ $("#remark_err").fadeOut(); }, 3000);
    $("#remark").focus();
    return false;
  }

}


</script>



   








 


