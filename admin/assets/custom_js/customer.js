function getvalidation()
{  
     var customer=$("#customer_id").val();
     var customer_id=$("#check").val();
     var employee_id=$("#employee_id").val();
     var complaint_date=$("#complaint_date").val().trim();
     var advance_amount=$("#advance_amount").val().trim();
      if(customer=="")
      {
        $("#error_customer").fadeIn().html("Required");
        $("#customer_id").css("border-color","red");
        setTimeout(function(){$("#error_customer").html("&nbsp;");$("#customer_id").css("borderColor","#00A654")},5000)
        $("#customer_id").focus();
        return false;
      } 

      if(employee_id=="0")
      {
        $("#error_emp").fadeIn().html("Required");
        $("#employee_id").css("border-color","red");
        setTimeout(function(){$("#error_emp").html("&nbsp;");$("#employee_id").css("borderColor","#00A654")},5000)
        $("#employee_id").focus();
        return false;
      } 

      if(complaint_date=="")
      {
        $("#errdate").fadeIn().html("Required");
        $("#complaint_date").css("border-color","red");
        setTimeout(function(){$("#errdate").html("&nbsp;");$("#complaint_date").css("borderColor","#00A654")},5000)
        $("#complaint_date").focus();
        return false;
      } 


      if(customer_id=='')
      {
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i; 
        var mobile = $("#mobile").val().trim();
        var pattern_mobile = /^[0-9]{10,15}$/i;
        var city_id = $("#city_id").val();
        var area = $("#area").val().trim();
        var pincode = $("#pincode").val().trim();
        var address = $("#address").val().trim();

         if(name=="")
          {
            $("#errname").fadeIn().html("Please enter name");
            setTimeout(function(){$("#errname").html("&nbsp;");},5000)
            $("#name").focus();
            return false;
          }
           
          if(email=="")
          {
            $("#erremail").fadeIn().html("Please enter email");
            setTimeout(function(){$("#erremail").html("&nbsp;");},5000)
            $("#email").focus();
            return false;
          }

          else if(!pattern_email.test(email))
          {
            $("#erremail").fadeIn().html("Please enter valid email");
            setTimeout(function(){$("#erremail").html("&nbsp;");},5000)
            $("#email").focus();
            return false;     
          }
          var chkDuplicate=$('#reapeat').val();
          if(chkDuplicate=='1')
          {
            $("#erremail").fadeIn().html("Already exist");
            setTimeout(function(){$("#erremail").html("&nbsp;");},5000)
            $("#email").focus();
            return false; 
          }
          if(mobile=="")
          {
            $("#errmobile").fadeIn().html("Please enter mobile no");
            setTimeout(function(){$("#errmobile").html("&nbsp;");},5000)
            $("#mobile").focus();
            return false;
          }
          else if(!pattern_mobile.test(mobile))
          {
            $("#errmobile").fadeIn().html("Please enter valid mobile no");
            setTimeout(function(){$("#errmobile").html("&nbsp;");},5000)
            $("#mobile").focus();
            return false;     
          }
          if(area=="")
          {
            $("#errarea").fadeIn().html("Please enter area");
            setTimeout(function(){$("#errarea").html("&nbsp;");},5000)
            $("#area").focus();
            return false;
          }
           if(pincode=="")
          {
            $("#errpincode").fadeIn().html("Please enter pincode");
            setTimeout(function(){$("#errpincode").html("&nbsp;");},5000)
            $("#pincode").focus();
            return false;
          }
          if(address=="")
          {
            $("#erraddress").fadeIn().html("Please enter address");
            setTimeout(function(){$("#erraddress").html("&nbsp;");},5000)
            $("#address").focus();
            return false;
          }
      }
      

    value=[];  
    $('.prdname').each(function(){ value.push(($(this).val().trim()));}); 
    var chk_duble = checkDuplicate(value);  

    if(chk_duble == true)
    {
      $("#prd_error").html("Already exist").fadeIn();
      setTimeout(function(){$("#prd_error").fadeOut();$(".prdname").css("borderColor","#00A654") },8000)
       $(".prdname").focus()
      ;
      return false;
    }

  var count = $('#clonetable_feedback tr').length;
  for(var i=1; i <= count;  i++)
  {
    var product_name1=$("#product_name"+i).val();
    var quantity1=$("#quantity"+i).val();
    var service_charges1=$("#service_charges"+i).val();
     if($.trim(product_name1)=="")
      {
        $("#prd_error").html("Required").fadeIn();
        setTimeout(function(){$("#prd_error").fadeOut()},3000);
        $("#product_name"+i).focus();
        return false;
      }

      if($.trim(quantity1)=="")
      {
        $("#qty_error").html("Required").fadeIn();
        setTimeout(function(){$("#qty_error").fadeOut()},3000);
        $("#quantity"+i).focus();
        return false;
      }

      if($.trim(service_charges1)=="")
      {
        $("#service_error").html("Required").fadeIn();
        setTimeout(function(){$("#service_error").fadeOut()},3000);
        $("#service_charges"+i).focus();
        return false;
      }
  }   

  if(advance_amount=="")
  {
    $("#error_amount").fadeIn().html("Required");
    $("#advance_amount").css("border-color","red");
    setTimeout(function(){$("#error_amount").html("&nbsp;");$("#advance_amount").css("borderColor","#00A654")},5000)
    $("#advance_amount").focus();
    return false;
  } 
     
}


function checkCustEmail()
{
  var email=$('#email').val().trim();
  var site_url = $("#site_url").val();
   $('.loader').fadeIn();
    $.ajax({
        type:"post",
        url:site_url+"/Orders/checkCustEmail",
        cache:false,
        data:{email:email},
        success:function(returndata)
        { $('.loader').fadeOut();
        if(returndata==1)
        {
            $("#erremail").fadeIn().html("Already exist");
            setTimeout(function(){$("#erremail").html("&nbsp;");},5000)
            $("#email").focus();
            $('#reapeat').val(returndata);
            return false; 
        }else{
          $('#reapeat').val(returndata);
        }

          
        }
    });
}





