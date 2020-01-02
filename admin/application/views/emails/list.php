<?php 
  $this->load->view('common/header'); 
  $this->load->view('common/left_panel');
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1><?php echo $title; ?></h1>
          <?php echo $breadcrum; ?>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
        				<div class="box-header">
        					<div class="col-md-4">
                    <!-- <h3 class="box-title"><?php echo $sub_title; ?></h3> -->
                  </div>
        					<div class="col-md-4 text-center">
        					
        					</div>
        					<div class="col-md-4 text-right">
        						<a class="btn btn-primary" href="<?= site_url('Email/create')?>">Add Email</a>
        					</div>
        				</div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered table-striped example_datatable" style="width: 1009px">
          					<thead>
          						<tr>
                        <th class="col-md-1">Sr.No</th>
                        <th class="col-md-1">Title</th>
                        <th class="col-md-1">Subject</th>
                       <!--  <th class="col-md-1">Description</th> -->
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
        </section>
      </div>

<script>
var pageLength = ''; 
var url= "<?= site_url('Email/ajax_list')?>";
var actioncolumn = 4;

function Delete(obj,cid)
{
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Email/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {//alert(returndata);
          table.draw();
          //$(obj).closest('tr').remove();   
        }
      });
  }
}
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
        url:"<?=  site_url('Email/change_status')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          //console.clear();  
        }
      });   
  }
}
</script>
<?php  $this->load->view('common/footer'); ?>  
<style type="text/css">
table{
width:100% !important;
}
</style>