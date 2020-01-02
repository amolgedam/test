<div class="content-wrapper">
    <section class="content-header">
      <h1>
       Manage Setting
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Manage Setting</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
                        
                        
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                             <thead>
                              <tr>
                               <th width="40px">Sr No.</th>
                                <th>Name</th>
                                <th>Detail</th>
                                <th>Value</th>
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





<script>
    var url = '<?= site_url('Settings/ajax_manage_page')?>';
    var actioncolumn=4;
</script>

<?php $this->load->view('common/footer');?>
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

<div class="modal fade" id="sendmailModal" role="dialog" data-backdrop="static" >
        <div class="modal-dialog modal-md">
          <form id="FormID" method="post" action="<?php echo site_url('Settings/update_action')?>" onsubmit="return sendMail()" enctype="multipart/form-data">  
                         
                <div class="modal-content">
                    <div class="modal-header bg-color-1" style="background-color:#3C8DBC;color:#fff; ">
                      <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                      <h4 class="modal-title">Update Setting</h4> 
                    </div>
                    <div class="modal-body">
                          
                            
                             <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="varchar">Title</label> 
                                        <div class="form-line">
                                      <input type="text" class="form-control" name="title" id="title" placeholder="Title"  autocomplete="off" readonly="" />
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-12" id="a">
                                    <div class="form-group">
                                      <label for="varchar">Detail <span style="color:red;">*</span></label>&nbsp;<span id="err_description" style="color:red;"></span>
                                        <div class="form-line">
                                      <textarea class="form-control" name="description" class="ckeditor" id="description" placeholder="Description"  style="resize: none" /></textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-12" id="d">
                                    <div class="form-group">
                                      <label for="varchar">A2 Form Wire Transfer <span style="color:red;">*</span></label>&nbsp;<span id="err_description" style="color:red;"></span>
                                        <div class="form-line">
                                      <input type="radio" name="description" id="a2Form" value="a2form">&nbsp;A2 Form First &nbsp;&nbsp;
                                      <input type="radio" name="description" id="a2Form_" value="a2Form_">&nbsp;A2 Form Second
                                      </div>
                                  </div>
                              </div>

                              <div class="col-sm-12" id="b">
                              <div class="form-group"> 
                                <label for="Image"> Upload Image <span style="color:red;">*</span></label>&nbsp;<span id="err_image" style="color:red;"></span>
                                  <div class="form-line">
                                      <input type="file" name="image" id="image" class="inputfile" accept="/*" />
                                      <img style="height:40px;width:40px" src="" alt="">
                                      <span id="old_image"></span>
                                      <input type="hidden" id="old_image_name" name="old_image_name">
                                </div>
                              </div>        
                            </div>
                            <div class="col-sm-12" id="c">
                              <div class="form-group"> 
                                <label for="Value"> Value <span style="color:red;">*</span></label>&nbsp;<span id="err_value" style="color:red;"></span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" value="" id="value" name="value">
                                </div>
                              </div>        
                            </div>
                             <div class="col-sm-12" id="e"><!--
                              <div class="form-group"> 
                                <label for="Value">End Time<span style="color:red;">*</span></label>&nbsp;<span id="err_description" style="color:red;"></span>
                                  <div class="form-line">
                                      <input type="text" class="form-control timepicker" value="" id="description" name="description">
                                      <input type="hidden" id="flag" name='flag' class='e'>
                                </div>
                              </div>        
                            </div>-->
                             <!--<div class="col-sm-12" id="f">
                              <div class="form-group"> 
                                <label for="Value">Day<span style="color:red;">*</span></label>&nbsp;<span id="err_description" style="color:red;"></span>
                                  <div class="form-line">
                                      <select class="form-control" name="description" id='description'>
                                            <option value="0">Select Day
                                            <option value="Monday">Monday</option>  
                                            <option value="Tuesday">Tuesday</option>  
                                            <option value="Wednesday">Wednesday</option>  
                                            <option value="Thurday">Thurday</option>  
                                            <option value="Friday">Friday</option>  
                                            <option value="Saturday">Saturday</option>  
                                            <option value="Sunday">Sunday</option>  
                                        </option>
                                      </select>
                                    </div>
                                </div>        
                            </div>-->


                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer"   >
                      <input type="hidden" id="id" name="id">

                      <button type="submit" class="btn btn-primary  bg-color-1" >Update</button>
                       <button type="button" class="btn btn-default bg-color-2" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
function checkStatus(id){
    $("#statusId").val(id);
    $("#deleteId").val(id);
}

function show_modal(id)
{
 
   $.ajax({
          type:"POST",
          url:"<?= site_url('Settings/showuserdata') ?>",
          data:{id:id},
          cache:false,                    
          success:function(returndata)
          { 
             //alert(returndata);
              var obj = JSON.parse(returndata);
             
               $("#sendmailModal #title").val(obj.title);
               //alert(obj.details);
               if(obj.title == 'Site_logo' ||  obj.title == 'IAO_logo' )
               {
                
                      $("#sendmailModal #old_image").html(obj.details); 
                      $("#sendmailModal #old_image_name").val(obj.old_image); 
                      
                      $("#a").hide();
                      $("#b").show();
                      $("#c").hide();
                      $("#d").hide();
                      $("#e").hide();
                      $(".e").hide();
                      $("#f").hide();
               }
               else if(obj.title == 'credit_card' ||  obj.title == 'debit_card' || obj.title == 'online_wallet' || obj.title== 'net_banking') 
               {
                    $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',true);
                    $("#value").val(obj.extra_charge);
                    $("#sendmailModal #a").show();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").show();
                    $("#sendmailModal #d").hide();
                    $("#sendmailModal #e").hide();
                    $(".e").hide();
                    $("#sendmailModal #f").hide();
               }
               else if(obj.title=='wire_transfer_pdf'){
                
                    $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',false);
                    $("#sendmailModal #a").hide();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").hide();
                    $("#sendmailModal #d").show();
                    $("#sendmailModal #e").hide();
                    $("#sendmailModal #f").hide();
                    $(".e").hide();
                   // $("#a2Form").val(obj.details);
                   var a2form = obj.details;
                   if(a2form=='a2form')
                   {
                    ///alert("hii");
                      $( "#a2Form" ).prop( "checked", true );
                   }else{
                    //alert("byy");
                      $("#a2Form_").prop( "checked", true );
                   }
               }
               else if(obj.title=='Wire Trasnfer Time Start'){
                
                    $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',false);
                    $("#sendmailModal #a").hide();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").hide();
                    $("#sendmailModal #d").hide();
                    $("#sendmailModal #e").show();
                    $("#sendmailModal #f").hide();
                   // $("#a2Form").val(obj.details);
                   $('#flag').val('flag');
                   var timeZone = obj.details;
                   $('input.timepicker').timepicker({ timeFormat: 'HH:mm',});//z-index: 999999
                   $(".ui-timepicker-container").css("z-index","9999");
                  /* $(document).ready(function(){
                   $(".ui-timepicker-container").css("z-index","999999");
                   });*/
                  // attr("width","500");.attr('style', 'text-align: center');
               }
               else if(obj.title=='Wire Trasnfer Day Off1' || obj.title=='Wire Trasnfer Day Off2'){
                
                    $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',false);
                    $("#sendmailModal #a").hide();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").hide();
                    $("#sendmailModal #d").hide();
                    $("#sendmailModal #e").hide();
                    $(".e").hide();
                    $("#sendmailModal #f").show()
               }
               else if(obj.title== 'extra_charge'){
                
                    $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',false);
                    $("#value").val(obj.extra_charge);
                    $("#sendmailModal #a").hide();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").show();
                    $("#sendmailModal #d").hide();
                    $("#sendmailModal #e").hide();
                    $(".e").hide();
                    $("#sendmailModal #f").hide()
               }
               else
               {
                  $("#sendmailModal #description").val(obj.details);
                    $("#description").attr('readonly',false);
                    $("#sendmailModal #a").show();
                    $("#sendmailModal #b").hide();
                    $("#sendmailModal #c").hide();
                    $("#sendmailModal #d").hide();
                    $("#sendmailModal #e").hide();
                    $("#sendmailModal #f").hide();
                    $(".e").hide();
               }
           
               $("#sendmailModal #id").val(obj.id);
               $("#sendmailModal").modal('show');
           
          }
        });

}

        function sendMail()
        {
            //var description = CKEDITOR.instances.description.getData(); 
            
              var id = $('#id').val(); //alert(id);
              var title = $('#title').val(); //alert(title);
              var value = $('#value').val(); //alert(title);


            if(title == 'Site_logo' || title == 'IAO_logo')
            {
                var image = $('#image').val();
                if(image.trim() == "")
                {
                       $("#sendmailModal #err_image").fadeIn().html("Please upload image");
                        setTimeout(function(){$("#sendmailModal #err_image").html("&nbsp;");},3000)
                        $("#sendmailModal #image").focus();
                        return false;
                } 

                var exts = ['jpeg','jpg','png'];
                // first check if file field has any value
                if ( image ) {
                  // split file name at dot
                  var get_ext = image.split('.');
                  // reverse name to check extension
                  get_ext = get_ext.reverse();
                  // check file type is valid as given in 'exts' array
                  if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
                    
                  } else {
                    $("#sendmailModal #err_image").fadeIn().html("Please upload only jpeg,jpg,png image ");
                      setTimeout(function(){$("#sendmailModal #err_image").html("&nbsp;");},3000)
                      $("#sendmailModal #image").focus();
                      return false;
                  }
                }
            }
            else if(title == 'credit_card' || title == 'debit_card' || title == 'online_wallet' || title== 'net_banking')
            {
              
              if(value.trim() == "")
                  {
                         $("#err_value").fadeIn().html("Please enter value");
                          setTimeout(function(){$("#err_value").html("&nbsp;");},3000)
                          $("#value").focus();
                          return false;
                  } 
            }
            else if(title== 'extra_charge')
            {
              
              if(value.trim() == "")
                  {
                         $("#err_value").fadeIn().html("Please enter value");
                          setTimeout(function(){$("#err_value").html("&nbsp;");},3000)
                          $("#value").focus();
                          return false;
                  } 
            }

            else
            {
                var description = $('#description').val();
                 if(description.trim() == "")
                  {
                         $("#sendmailModal #err_description").fadeIn().html("Please enter detail");
                          setTimeout(function(){$("#sendmailModal #err_description").html("&nbsp;");},3000)
                          $("#sendmailModal #description").focus();
                          return false;
                  } 
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
        url:"<?=  site_url('Settings/change_status')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        { 
        }
      });   
  }
}
</script>












