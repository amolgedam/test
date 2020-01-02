function validateinfo()
{   
    var sitetitle = $("#sitetitle").val();  
    var email = $("#email").val();
    var pattern_email = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;
    var phone = $("#phone").val();
    var alternate_email = $("#alternate_email").val();
    var alternate_mobile = $("#alternate_mobile").val();
    var pattern_phone = /^[0-9 ]{0,50}$/i;  
    var footer = $("#footer").val();
    var address = $("#address").val();
    var terms_and_condition = $("#terms_and_condition").val();
    
    if($.trim(sitetitle)=='')
    {   
        $("#error_sitetitle").fadeIn().html("Required");
        $("#sitetitle").css("border-color", "red");
        setTimeout(function(){$("#error_sitetitle").fadeOut();$("#sitetitle").css("border-color", "#ccc");},3000);
        $("#sitetitle").focus();
        return false;
    }
    if($.trim(email)=='')
    {   
        $("#error_email").fadeIn().html("Required");
        $("#email").css("border-color", "red");
        setTimeout(function(){$("#error_email").fadeOut();$("#email").css("border-color", "#ccc");},3000);
        $("#email").focus();
        return false;
    }
    else if(!pattern_email.test(email))
    {
        $("#error_email").fadeIn().html("Invalid ");
        $("#email").css("border-color", "red");
       setTimeout(function(){$("#error_email").fadeOut();$("#email").css("border-color", "#ccc");},5000);
        $("#email").focus();
        return false;       
    }
    if($.trim(alternate_email)=='')
    {   
        $("#alternate_email_err").fadeIn().html("Required");
        $("#alternate_email").css("border-color", "red");
        setTimeout(function(){$("#alternate_email_err").fadeOut();$("#alternate_email").css("border-color", "#ccc");},3000);
        $("#alternate_email").focus();
        return false;
    }
    else if(!pattern_email.test(alternate_email))
    {
        $("#alternate_email_err").fadeIn().html("Invalid ");
        $("#alternate_email").css("border-color", "red");
       setTimeout(function(){$("#alternate_email_err").fadeOut();$("#alternate_email").css("border-color", "#ccc");},5000);
        $("#alternate_email").focus();
        return false;       
    }
     if($.trim(phone)=='')
    {   
        $("#error_phone").fadeIn().html("Required");
        $("#phone").css("border-color", "red");
        setTimeout(function(){$("#error_phone").fadeOut();$("#phone").css("border-color", "#ccc");},3000);
        $("#phone").focus();
        return false;
    }
     else if(!pattern_phone.test(phone))
    {   
        $("#error_phone").fadeIn().html("Invalid");
        $("#phone").css("border-color", "red");
        setTimeout(function(){$("#error_phone").fadeOut();$("#phone").css("border-color", "#ccc");},3000);
        $("#phone").focus();
        return false;
    }
    if($.trim(alternate_mobile)=='')
    {   
        $("#alternate_mobile_err").fadeIn().html("Required");
        $("#alternate_mobile").css("border-color", "red");
        setTimeout(function(){$("#alternate_mobile_err").fadeOut();$("#alternate_mobile").css("border-color", "#ccc");},3000);
        $("#alternate_mobile").focus();
        return false;
    }
     else if(!pattern_phone.test(alternate_mobile))
    {   
        $("#alternate_mobile_err").fadeIn().html("Invalid");
        $("#alternate_mobile").css("border-color", "red");
        setTimeout(function(){$("#alternate_mobile_err").fadeOut();$("#alternate_mobile").css("border-color", "#ccc");},3000);
        $("#alternate_mobile").focus();
        return false;
    }

     if($.trim(footer)=='')
    {   
        $("#error_footer").fadeIn().html("Required");
        $("#footer").css("border-color", "red");
        setTimeout(function(){$("#error_footer").fadeOut();$("#footer").css("border-color", "#ccc");},3000);
        $("#footer").focus();
        return false;
    }

     if($.trim(address)=='')
    {   
        $("#error_address").fadeIn().html("Required");
        $("#address").css("border-color", "red");
        setTimeout(function(){$("#error_address").fadeOut();$("#address").css("border-color", "#ccc");},3000);
        $("#address").focus();
        return false;
    }
    
     if($.trim(terms_and_condition)=='')
    {   
        $("#error_terms_and_condition").fadeIn().html("Required");
        $("#terms_and_condition").css("border-color", "red");
        setTimeout(function(){$("#error_terms_and_condition").fadeOut();$("#terms_and_condition").css("border-color", "#ccc");},3000);
        $("#terms_and_condition").focus();
        return false;
    }
} 

   $("#logo").change(function() { 
    var val = $(this).val();
      
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
    case 'jpg': case 'png': case 'JPG': case 'PNG': case 'jpeg': case 'JPEG':case 'gif':

    break;
    default:
    $(this).val('');
    $("#error_logo").fadeIn().html("Invalid");
              setTimeout(function(){$("#error_logo").html("&nbsp;");},5000);
    break;
    }
    }); 
   $("#favicon").change(function() { 
    var val = $(this).val();
      
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
    case 'jpg': case 'png': case 'JPG': case 'PNG': case 'jpeg': case 'JPEG':case 'gif':

    break;
    default:
    $(this).val('');
    $("#error_favicon").fadeIn().html("Invalid");
              setTimeout(function(){$("#error_favicon").html("&nbsp;");},5000);
    break;
    }
    });
function only_number(event)
{
    var x = event.which || event.keyCode;
    
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
    {
    return;
    }else{
    event.preventDefault();
    }    
}