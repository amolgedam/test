<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employees Master
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Manage Employees</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary"> 

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
                          <a class="btn btn-warning" title="Create" href="<?= site_url('Employees') ?>">Back</a> 
                          <a class="btn btn-primary" title="Create" href="<?= $create_certificate.'/'.$id ?>">Add Certificate</a> 
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                   <!--  <th>Employees Name</th> -->
                                    <th>Certificate Type</th>
                             <th>description</th>
                                  
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
 <!-- Modal -->
  <div class="modal fade" id="mail" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <!--  <h4 class="modal-title">Send Mail</h4> -->
        </div> 
        <form  method="post" action="<?php echo site_url('Employees/send_mail')?>" enctype="multipart/form-data">
        <div class="modal-body">
        <div class="row">
         <!--  <div class="col-md-12"> -->
            <div class="col-md-6">
            
              <input type="hidden" class="form-control" name="personal_email" id="personal_email">
       <input type="hidden" name="id" id="id" value="">
            </div>
               <div class="col-md-12">
                   <label>From</label>
             <select name="from_mail" id="from_mail" class="form-control">
             
              <option value="account@worldplanetesolution.com">account@worldplanetesolution.com</option>
              <option value="hrd@worldplanetesolution.com">hrd@worldplanetesolution.com</option>
              <option value="info@worldplanetesolution.com">info@worldplanetesolution.com</option>
              <option value="marketing@worldplanetesolution.com">marketing@worldplanetesolution.com</option>
          </select>
            </div> </br> </br> </br>
             <div class="col-md-12">
               <label>Subject</label>
             <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="">
            </div>

             <div class="col-md-12">
               <label>Description</label>
             <textarea name="description" id="description" class="form-control " placeholder="Content"></textarea>
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

<!-- <div class="modal fade" id="deleteData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
    var url = '<?= site_url('Employees/ajax_certificate_list/'.$id)?>';
    var actioncolumn=4;
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">

function Delete(obj,id)
{
  
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+id).fadeOut();
    var datastring="id="+id;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Employees/delete_certi'); ?>",
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
        url:"<?=  site_url('Employees/change_status_certi')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
           
        }
      });   
  }
}

// mail function
function mail(id)
{
  $('#mail').show();
  $('#id').val(id);

   
}


//End mail function


</script>












