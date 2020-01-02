<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Manage Country
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Manage Country</li>
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
                          <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Country</a> 
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Country Name</th>
                                    <th>Country Code</th>
                                    <th>Country Image</th>
                                    <th>Sort By</th>
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
<!--End import from excel-->


<script>
    var url = '<?= site_url('Countries/ajax_manage_page')?>';
   // alert(url);
    var actioncolumn=6;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); 

function Delete(obj,cid)
{
  
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Countries/delete'); ?>",
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
        url:"<?=  site_url('Countries/change_status')?>",
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













