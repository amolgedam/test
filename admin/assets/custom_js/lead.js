function check_error()
{  
 
    var client_name =$("#client_name").val();
    var company_name=$("#company_name").val();
    var client_mobile=$("#client_mobile").val();
    var requred_product=$("#requred_product").val().trim();
    var appoint_date=$("#appoint_date").val().trim();
    var appoint_time=$("#appoint_time").val().trim();
    var address=$("#address").val().trim();

      if(client_name =="")
      {
        $("#client_err").fadeIn().html("Required");
        $("#client_name").css("border-color","red");
        setTimeout(function(){$("#client_err").html("&nbsp;");$("#client_name").css("borderColor","#00A654")},5000)
        $("#client_name").focus();
        return false;
      } 
       if(company_name=="")
      {
        $("#comp_err").fadeIn().html("Required");
        $("#company_name").css("border-color","red");
        setTimeout(function(){$("#comp_err").html("&nbsp;");$("#company_name").css("borderColor","#00A654")},5000)
        $("#company_name").focus();
        return false;
      } 
 
      if(client_mobile=="")
      {
        $("#mobile_err").fadeIn().html("Required");
        $("#client_mobile").css("border-color","red");
        setTimeout(function(){$("#mobile_err").html("&nbsp;");$("#client_mobile").css("borderColor","#00A654")},5000)
        $("#client_mobile").focus();
        return false;
      } 
       if(requred_product=="")
      {
        $("#prduct_err").fadeIn().html("Required");
        $("#requred_product").css("border-color","red");
        setTimeout(function(){$("#prduct_err").html("&nbsp;");$("#requred_product").css("borderColor","#00A654")},5000)
        $("#requred_product").focus();
        return false;
      } 

       if(appoint_date=="")
      {
        $("#adate_err").fadeIn().html("Required");
        $("#appoint_date").css("border-color","red");
        setTimeout(function(){$("#adate_err").html("&nbsp;");$("#appoint_date").css("borderColor","#00A654")},5000)
        $("#appoint_date").focus();
        return false;
      } 
      if(appoint_date=="")
      {
        $("#appoint_err").fadeIn().html("Required");
        $("#appoint_time").css("border-color","red");
        setTimeout(function(){$("#appoint_err").html("&nbsp;");$("#appoint_time").css("borderColor","#00A654")},5000)
        $("#appoint_time").focus();
        return false;
      } 
      if(address=="")
      {
        $("#add_err").fadeIn().html("Required");
        $("#address").css("border-color","red");
        setTimeout(function(){$("#add_err").html("&nbsp;");$("#address").css("borderColor","#00A654")},5000)
        $("#address").focus();
        return false;
      }     
}

function only_number(event)
{
  var x = event.which || event.keyCode;
  console.log(x);
  if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
  {
    return;
  }else{
    event.preventDefault();
  }    
}

function only_alphabets(event)
{
  var x = event.which || event.keyCode;
  console.log(x);
  if((x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ) ||(x==32))
  {
    return;
  }else{
    event.preventDefault();
  }    
}

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
    minDate:new Date()

});

$('#appoint_time').pickatime({});

function update(id)
 {   

       var site_url = $("#site_url").val();
        $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/get_manage_lead',
        data:{
          id:id,
        },
        success:function(returndata)
        {
          obj=$.parseJSON(returndata);
          $("#client_name").val(obj.client_name);
          $("#id").val(obj.id);
          $("#requred_product").val(obj.requred_product);
          $("#assign_to").val(obj.assign_to);
        
          $("#description").val(obj.description);

        }
      })
 }

  function update_manage_lead()
  {

      var flag = $("#flag").val();  
      var site_url = $("#site_url").val();  
      var assign_to=$("#assign_to").val().trim();
      var description=$("#description").val().trim();
      var id=$("#id").val();
      $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/update_manage',
        data:{assign_to:assign_to,description:description,id:id},
        success:function(returndata)
        {
            if(flag=='')
            {
                window.location.href=site_url+"/Lead";
            }
            else
            {
              window.location.href=site_url+"/Lead/index/"+flag;
            }
           
        }
      })
  }

  function follow_date(id)
 {  
      var site_url = $("#site_url").val();
        $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/follow_id_insert',
        data:{
          id:id,
        },
        success:function(returndata)
        {
          obj=$.parseJSON(returndata);
         
          $("#manage_lead_id").val(obj.id);
         
        }
      })
      
 }

 function create_follow_date()
 {
     
    var site_url = $("#site_url").val();
    var flag = $("#flag").val();
    var date=$("#date").val().trim();
    var remark =$("#remark_new").val();
    var manage_lead_id=$("#manage_lead_id").val().trim();
    
     if(date=="")
      {
          $("#date_err").fadeIn().html("Please select date").css('color','red');
          setTimeout(function(){$("#date_err").html("&nbsp;");},3000);
          $("#date").focus();
          return false;
      }
      if(remark=="")
      {
          $("#remark_err").fadeIn().html("Please enter remark").css('color','red');
          setTimeout(function(){$("#remark_err").html("&nbsp;");},3000);
          $("#remark").focus();
          return false;
      }
    
   
     $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/follow_date_insert',
        data:{date:date,remark:remark,manage_lead_id:manage_lead_id,},
        success:function(returndata)
        {
            if(flag=='')
            {
              window.location.href=site_url+"/Lead";
            }
            else
            {
             window.location.href=site_url+"/Lead/index/"+flag; 
               
            }
        }
      });
 }

 function insert_lead()
  {
    
      var flag = $("#flag").val();
      var site_url = $("#site_url").val();
      var lead_purchase=$("#lead_purchase").val().trim();
      var o_date=$("#o_date").val().trim();
      var lead_id=$("#lead_id").val().trim();
      var requred_product=$("#requred_product_new").val().trim();
      var order_no=$("#order_no").val().trim();
      var type_remark=$("#type_remark").val().trim();

      $.ajax({
        type:'post',
        cache:false,
        url:site_url+'/Lead/order',
        data:{lead_purchase:lead_purchase,o_date:o_date,lead_id:lead_id,requred_product:requred_product,order_no:order_no,type_remark:type_remark,},
        success:function(returndata)
        {
          //alert(returndata);return false;
          if(returndata==1)
          {
            if(flag=='')
            {
              window.location.href=site_url+"/Lead";
            }
            else
            {
              window.location.href=site_url+"/Lead/index/"+flag;
            }
          }
          
        }
      })
  }


 