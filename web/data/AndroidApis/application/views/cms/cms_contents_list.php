<?php 
  $this->load->view('common/header'); 
  $this->load->view('common/left_panel');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
    </h1>
    <?php echo $breadcrum; ?>
  </section>

   <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                  <div class="box-header">
                    <div class="content-header_button  pull-right"> 
                     <!--  <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Create</a>  -->
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                            <thead>
                                <tr>
                                   <th class="col-md-1">Sr No.</th>
                            <th class="col-md-1">Title</th>
                            <th class="col-md-1">CMS Type</th>
                            <th class="col-md-1">Image</th>
                            <th class="col-md-1">Description</th>
                            <th class="col-md-1">Status</th>
                            <th class="col-md-1">Action</th>
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
<div class="modal inmodal" id="checkStatus" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content animated bounceInRight">
         <form method="post" action="<?= $changeAction ?>">
            <div class="modal-body" style="height: 100px;padding-top: 10%">
               <center>
                  <input type="hidden" name="id" id="statusId">
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

<script>
  var url= "<?= site_url('CMS/ajax_list')?>";
  var actioncolumn=6;
  var pageLength='';
</script>
<script>
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
        url:"<?=  site_url('CMS/change_status')?>",
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
   function checkStatus(id){
    
       $("#statusId").val(id);
       
   }
</script>
<?php
  $this->load->view('common/footer'); 
?>   


