<?php $this->load->view('common/header'); 
  $this->load->view('common/left_panel'); ?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Manage Categories
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Manage Sub-Categories</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
                         
                          <a class="btn btn-primary" data-toggle="modal" data-target="#createModal" title="Create" href="">Add Sub-Category</a> 
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Category Name</th>
                                    <th>Sub-Category Name</th>
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



<!--Add Modal -->
<div id="createModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Sub-Category</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">  
            <label>Category Name <span style="color:red">*</span><span style="color:red" id="catname_err"></span></label>
            <!-- <input type="text" class="form-control" name="category_name" id="category_name"> -->
            <select class="form-control" name="category_id" id="category_id">
              <option value="">select category</option>
              <?php foreach ($category as $key) {?>
                <option value="<?= $key->id;?>"><?= $key->category_name;?></option>
             <?php } ?>
            </select>
          </div>
          <div class="col-md-6">  
            <label>Sub-Category Name <span style="color:red">*</span><span style="color:red" id="subcatname_err"></span></label>
            <input type="text" class="form-control" name="subCategory_name" id="subCategory_name" placeholder="Enter Sub Category Name">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="return createsubCat()">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--Edit Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Sub-Category</h4><span id="aaa">tyutyu</span>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">  
            <label>Category Name <span style="color:red">*</span><span style="color:red" id="catname_err"></span></label>
            <!-- <input type="text" class="form-control" name="category_name" id="category_name"> -->
            <select class="form-control" name="edit_category_id" id="edit_category_id">
              <option value="">select category</option>
              <?php foreach ($category as $key) {?>
                <option value="<?= $key->id;?>"><?= $key->category_name;?></option>
             <?php } ?>
            </select>
          </div>
          <div class="col-md-6">  
            <label>Sub-Category Name <span style="color:red">*</span><span style="color:red" id="update_subcatname_err"></span></label>
            <input type="text" class="form-control" name="editsubCategory_name" id="editsubCategory_name" placeholder="Enter Sub Category Name">
            <input type="hidden" class="form-control" id="edit_subcategory_id123" value="">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="return updatesubCat()">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <div class="modal-body" style="height: 100px;padding-top: 10%">
                    <center>
                        <input type="hidden" name="id" id="deleteId" style="display: none;">
                        <span style="font-size: 16px">Do you want want to delete ?</span>
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
<?php 
  $this->load->view('common/footer'); 
?>
<script>
    var url = '<?= site_url('Sub_Category/ajax_manage_page')?>';
    var actioncolumn=4;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script>
  function createsubCat()
  {
      var category_id=$("#category_id").val();
      var subcat_name=$("#subCategory_name").val().trim();
      if(category_id=="")
      {
          $("#catname_err").fadeIn().html("Please select").css('color','red');
          setTimeout(function(){$("#catname_err").html("&nbsp;");},3000);
          $("#category_id").focus();
          return false;
      }
      if(subcat_name=="")
      {
          $("#subcatname_err").fadeIn().html("Please enter name").css('color','red');
          setTimeout(function(){$("#subcatname_err").html("&nbsp;");},3000);
          $("#subCategory_name").focus();
          return false;
      }

      $.ajax({
        type:'post',
        cache:false,
        url:'<?php echo site_url('Sub_Category/create_subcategory');?>',
        data:{
          subcat_name:subcat_name,category_id:category_id,
        },
        success:function(returndata)
        {
          if(returndata==1)
          {
            window.location.href="<?php echo site_url('Sub_Category');?>"
          }
          else
          {
            $("#subcatname_err").fadeIn().html("This sub-category already exists").css('color','red');
            setTimeout(function(){$("#subcatname_err").html("&nbsp;");},3000);
            $("#subCategory_name").focus();
            return false;
          }
        }
      })
  }
</script>

<script type="text/javascript">
 function getValue(id)
 {
        $("#edit_subcategory_id123").val(id);
        $.ajax({
        type:'post',
        cache:false,
        url:'<?php echo site_url('Sub_Category/get_subcategory') ?>',
        data:{
          id:id,
        },
        success:function(returndata)
        {
          obj=$.parseJSON(returndata);
          $("#editsubCategory_name").val(obj.subcat_name);
          $("#edit_category_id").val(obj.cat_id).selectpicker('refresh');
        }
      })
 }

 function updatesubCat()
  {
      var subcat_name=$("#editsubCategory_name").val().trim();
      var subcat_id=$("#edit_subcategory_id123").val();
      var category_id=$("#edit_category_id").val();
      if(subcat_name=="")
      {
          $("#subcatname_err").fadeIn().html("Please enter sub-category name").css('color','red');
          setTimeout(function(){$("#subcatname_err").html("&nbsp;");},3000);
          $("#edit_category").focus();
          return false;
      }

      $.ajax({
        type:'post',
        cache:false,
        url:'<?php echo site_url('Sub_Category/update_subcategory');?>',
        data:{
          subcat_name:subcat_name,
          subcat_id:subcat_id,
          category_id:category_id,
        },
        success:function(returndata)
        {
          if(returndata==1)
          {
            window.location.href="<?php echo site_url('Sub_Category');?>"
          }
          else
          {
            $("#update_subcatname_err").fadeIn().html("This sub-category already exists").css('color','red');
            setTimeout(function(){$("#update_subcatname_err").html("&nbsp;");},3000);
            $("#edit_subcategory").focus();
            return false;
          }
        }
      })
  }
</script>

<script type="text/javascript">
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
        url:"<?=  site_url('Sub_Category/change_status')?>",
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

function Delete(obj,cid)
{
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('Sub_Category/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          //alert(returndata);
          table.draw();
          //$(obj).closest('tr').remove();   
        }
      });
  }
}
</script>











