function checkXcel() 
    {
        var excel_file = $("#excel_file").val();
        var fileUpload = $("#excel_file");
        // var allowedFiles = [".doc", ".docx", ".pdf"];
        var allowedFiles = [".xls", ".xlsx"];

        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

        if(excel_file=="")
        {
            $("#errorexcel_file").fadeIn().html("Please select excel file in xls or csv format");
            setTimeout(function(){$("#errorexcel_file").fadeOut();},5000);
            $("#excel_file").focus();
            return false;   
        }
        else if (!regex.test(fileUpload.val().toLowerCase()))
        {
            $("#errorexcel_file").fadeIn().html("CSV or Excel files only!");
            setTimeout(function(){$("#errorexcel_file").fadeOut();},5000);
            $("#excel_file").focus();
            return false;
        }
        else
        {
            $("#dis_btn").attr("disabled", "disabled"); 
            $('#btn_click').click();
        }        
    }

    function Delete(obj,cid)
{
  var ask = confirm("Do you want to delete this record?");
 var site_url=$("#site_url").val();
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
         url:site_url+"/Manage_company_data/delete",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}

   function follow_date(id)
 {  
      var site_url = $("#site_url").val();
        $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Manage_company_data/follow_id_insert',
        data:{
          id:id,
        },
        success:function(returndata)
        {
          obj=$.parseJSON(returndata);
         
          $("#company_data_id").val(obj.id);
         
        }
      })
      
 }

    function create_follow_date()
 {
      var site_url = $("#site_url").val();
     var flag = $("#flag").val();
      var follop_date=$("#follo_date").val();
      var remark=$("#remark_data").val();
      var company_data_id=$("#company_data_id").val();
      $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Manage_company_data/follow_date_insert',
        data:{
          follop_date:follop_date,
          remark:remark,
          company_data_id:company_data_id,

        },
        success:function(returndata)
        {
          
           if(flag=='')
            {
              window.location.href=site_url+"/Manage_company_data";
            }
            else
            {
             window.location.href=site_url+"/Manage_company_data/index/"+flag; 
               
            }
           
        }
      })
 }

     function assign_data()
 {
   var site_url = $("#site_url").val();
  

   var assign_id=$('#assign_id').val();
   var client_id=$('#selected_client').val().trim();
  
   if(assign_id=="0")
   {
     $("#assign_id_err").fadeIn().html("Please select Assign Employee");
            setTimeout(function(){$("#assign_id_err").fadeOut();},1000);
            $("#assign_id").focus();
            return false; 
   }
    
   $.ajax({
      url:site_url+'/Manage_company_data/assign_data',
     type: 'POST',
     data: {assign_id:assign_id,client_id:client_id},
      success:function(returndata)
        {

          if(returndata=="1")
          {
            location.reload();
          }
          
        }
   })
   
 }
 
 function insert_lead()
  {
   var flag = $("#flag").val();
      var site_url = $("#site_url").val();
      var lead_type=$("#lead_type").val().trim();
      var delivery_date=$("#o_date").val().trim();
      var lead_id=$("#lead_id").val().trim();
      var required_product=$("#requred_product").val().trim();
     // var order_no=$("#order_no").val().trim();
      var lead_remark=$("#lead_remark").val().trim();
      $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Manage_company_data/order',
        data:{lead_type:lead_type,
          lead_id:lead_id,
          lead_remark:lead_remark,
          delivery_date:delivery_date,
          required_product:required_product,
        
        },
        success:function(returndata)
        {
           if(returndata==1)
          {
            if(flag=='')
            {
              window.location.href=site_url+"/Manage_company_data";
            }
            else
            {
              window.location.href=site_url+"/Manage_company_data/index/"+flag;
            }
          }
          
        }
      })
  }