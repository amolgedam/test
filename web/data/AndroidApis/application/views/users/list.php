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
                     

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-4">
                          </div>
                           <?php 
                       if($_SESSION['admin']['admin_type']=='admin_1')
                    {  ?>
                          <div class="col-md-4">
                            <label>Select msg</label>
                            <select name="select_type" id="select_type" class="form-control" onchange="return getdata(this.value)">
                            <option value="">Select Msg</option>
                            <option value="Msg">Msg</option>
                            <option value="Mail">Mail</option>
                            </select>
                          </div>
                             <?php }else { ?>
                             <div class="col-md-4">
                                 </div>
                             
                             <?php }?>
                          <div class="col-md-4">
                            <div class="content-header_button  pull-right"> 
                          <!-- <a class="btn btn-primary" title="Download Format" download="region.xls" href="< ?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a> -->
                         <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Customer</a>
                        </div>  
                          </div>
                        </div>
                      </div>
                     
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                              <input type="hidden" name="selected_client" id="selected_client" class="filter_search_data1" >
                                <tr>
                                    <th>Sr No</th>
                                     <?php 
                                      if($_SESSION['admin']['admin_type']=='admin_1')
                                    {  ?>
                                    <th>                                    
                                      <input type="checkbox" name="checkbox" id="select_all" class="select_all">           
                                    </th>
                                    <?php } ?>
                                    <th>Image</th>
                                    <th>Emp. Name</th>
                                    <th>Full Name</th>
                                    <th>Email Id</th>
                                    <th>Mobile No</th>
                                    <!-- <th>Business</th> -->
                                    <!-- <th>Type</th> -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                              <th colspan="2">
                                <input type="hidden" class="append_ids">
                              </th>

                            </tr>
                          </tfoot>
                            
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendmailModalresult" role="dialog" data-backdrop="static" >
        <div class="modal-dialog modal-md">
          <form id="FormID" method="post" action="<?php echo site_url('Users/sendMailSms');?>" enctype="multipart/form-data">  
                         
                <div class="modal-content">
                    <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
                      <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                      <h4 class="modal-title">Message</h4> 
                    </div>
                    <div class="modal-body">                          
                             <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Title<span style="color:red;">*</span></label><span  style="color:red" id="title_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title"/>
                                      </div>
                                  </div>
                              </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Description<span style="color:red;">*</span></label><span  style="color:red" id="description_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                      <textarea class="form-control" name="description" id="description"></textarea>
                                      </div>
                                  </div>
                              </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer"   >
                      <input type="hidden" id="val" name="val">
                      <input type="hidden" id="customer_id" name="customer_id">
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
          <form id="FormID" method="post" action="<?php echo site_url('Users/save_logintype');?>" " enctype="multipart/form-data">  
                         
                <div class="modal-content">
                    <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
                      <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                      <h4 class="modal-title">Customer Type</h4> 
                    </div>
                    <div class="modal-body">
                          
                            
                             <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Type<span style="color:red;">*</span></label><span  style="color:red" id="entrollment_id_err" class= "errid"></span></label> 
                                        <div class="form-line">
                                      <!-- <input type="text" class="form-control" name="entrollment_id" id="entrollment_id" placeholder="Entrollment Id"/> -->
                                      <select id="login_type" name="login_type" class="form-control">
                                        <option value="Customer">Customer</option>
                                        <option value="Guest">Guest</option>
                                      </select>
                                      </div>
                                  </div>
                              </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer"   >
                      <input type="hidden" id="id_enroll" name="id_enroll">
                     <!--  <button type="submit" class="btn btn-primary  bg-color-1" style="display:none" id="save_enroll">save</button> -->
                      <button type="submit" class="btn btn-primary  bg-color-1">Update</button>
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
<?php
 if($_SESSION['admin']['admin_type']=='admin_1')
                                    {  ?>
<script>
    var url = '<?= site_url('Users/ajax_manage_page')?>';
    // var actioncolumn=10;
    var actioncolumn=8;
</script>
<?php }else { ?>
<script>
    var url = '<?= site_url('Users/ajax_manage_page')?>';
    // var actioncolumn=9;
    var actioncolumn=7;
</script>

  <?php } ?>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

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

      $("#sendmailModalresult").modal('show');

     $("#val").val(val);
     $("#customer_id").val(selected_client);

     /* $.ajax({
                type:"POST",
                cache:false,
                url:"< ?php echo site_url('Users/sendMailSms');?>",
                data:{val:val,selected_client:selected_client},
                success:function(returndata)
                {
                  alert(returndata);
                }
      }    



        );*/


  }



</script>

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
        url:"<?php echo site_url('Users/delete'); ?>",
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
        url:"<?=  site_url('Users/change_status')?>",
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
    
    //alert(id);
  $("#sendmailModal").modal('show');
  $("#id_enroll").val(id);

  $.ajax({
          type:"POST",
          url:"<?= site_url('Users/returndata_user') ?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 
            
               $("#login_type").val(returndata);
             
           
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
 
  var title = $("#title").val().trim();
  var description = $("#description").val().trim();

  if(title=="")
  {
    $("#title_err").fadeIn().html("Please enter Title");
    setTimeout(function(){ $("#title_err").fadeOut(); }, 3000);
    $("#title").focus();
    return false;
  }
   if(description=="")
  {
    $("#description_err").fadeIn().html("Please enter Description");
    setTimeout(function(){ $("#description_err").fadeOut(); }, 3000);
    $("#description").focus();
    return false;
  }

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



   








 


