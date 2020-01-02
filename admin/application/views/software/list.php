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
                         <button class="btn btn-info btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal" style="float: right">Add Software</button>
                        </div>  
                    </div> 
                
                    
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Title</th>
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

<div id="createModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 500px;">
      <div class="modal-header">
        <h4 class="modal-title">Add Software</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
    
        <label>Title<span style="color:red">*</span><span style="color:red" id="title_err"></span></label>
        <input type="text" class="form-control" name="title" id="title">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="return createsheet()">Submit</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Title</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <input type="hidden" id="id" name="id">
        <label>Title<span style="color:red">*</span><span style="color:red" id="e_title_err"></span></label>
        <input type="text" class="form-control" name="title" id="e_title">
        
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="return update_save()">Update</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- <script src="<?= base_url('assets/custom_js/software.js');?>"></script> -->
<script>
    var url = '<?= site_url('Software/ajax_manage_page')?>';
    var actioncolumn='3';
</script>
 <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script> 
<script>
  function showmodal(id)
  {

    $("#editModal").modal('show');

     $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('Software/update');?>",
        data:{id:id},
        success:function(returndata)
        {
           // alert(returndata); return false;
          var obj = $.parseJSON(returndata);    
          $("#e_title").val(obj.title);
          $("#id").val(obj.id);
        }

      });

  }
  
</script>
<script>
  function createsheet()
  {
   
      var title=$("#title").val().trim();
      var site_url=$("#site_url").val();


      if(title=="")
      {
          $("#title_err").fadeIn().html("Please enter title").css('color','red');
          setTimeout(function(){$("#title_err").html("&nbsp;");},3000);
          $("#title").focus();
          return false;
      }

     
      $.ajax({
        type:'post',
        cache:false,
        url:site_url+"/Software/create_action",
        data:{
          title:title,
        },
        success:function(returndata)
        {
          window.location.href=site_url+"/Software";
        }
      });
  }


   function update_save()
  {
      
      var e_title =$("#e_title").val();
      
      var site_url =$("#site_url").val();
      var id =$("#id").val();

       // alert(id);
      if(e_title=="")
      {
          $("#e_title_err").fadeIn().html("Please enter title").css('color','red');
          setTimeout(function(){$("#e_title_err").html("&nbsp;");},3000);
          $("#e_title").focus();
          return false;
      }
     
      $.ajax({ 
        type:'post', 
       url:"<?php echo site_url('Software/update_action'); ?>",
      data:{e_title:e_title,
        id:id
      }, 
      success:function(returndata) 
      {
           window.location.href=site_url+"/Software";
        }
      });
  }
</script>
<script>
  
   function checkStatus(id)
{
    $("#statusId").val(id);
    $("#deleteId").val(id);
}

function statuss(id)
{ 
  var cnf = confirm('Are you sure to change the status?');

  if(cnf==true)
  {
    var status=$("#status"+id).val();
    var site_url =$("#site_url").val();
    // alert(site_url);return false;
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
        url:site_url+"/Software/create_action",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          alert(returndata);
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
        url:"<?php echo site_url('Software/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
         
        }
      });
  }
}
</script>

