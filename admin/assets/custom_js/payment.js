 function show()
    {
      if($("#pay_mode").val()=="Cheque") 
      { 
        $("#chequeDiv").css("display","block");
        $("#dateDiv").css("display","block");
        $("#bankDiv").css("display","block");
        $("#accDiv").css("display","block");
      }
      else
      {
        $("#chequeDiv").css("display","none");
        $("#dateDiv").css("display","none");
        $("#bankDiv").css("display","none");
        $("#accDiv").css("display","none");
        $('#cheque_no').val("0");
        $('#cheque_date').val("0");
        $('#bank_name').val("null");
        $('#account_name').val("null");
      }
    }
function only_number(event)
      {
        var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13)
        {   
            return;
        }else{
          event.preventDefault();
        }
}

function payable(val)
{   
      if (parseFloat(val)> parseFloat($("#balance").val())) 
      { 
        
            $("#errorShow").fadeIn();
            setTimeout(function(){$("#errorShow").fadeOut("&nbsp;");},3000)
            $("#amount_pay").focus();
            $("#amount_pay").val('');
            return false;
      }
}

function check_error() 
    {
        var amount_pay = $("#amount_pay").val().trim();
        var cheque_no = $("#cheque_no").val().trim();
        var cheque_date = $("#cheque_date").val();
        var pay_mode = $("#pay_mode").val();

        if(pay_mode=='')
        {
           $("#errordata").fadeIn().html("Select Payment mode").css("color","red");
            setTimeout(function(){$("#errordata").fadeOut("&nbsp;");},2000)
            $("#pay_mode").focus();
            return false;
        }
        if(amount_pay=='')
        {
           $("#errordata").fadeIn().html("Enter Paying Amount").css("color","red");
            setTimeout(function(){$("#errordata").fadeOut("&nbsp;");},2000)
            $("#amount_pay").focus();
            return false;
        }
        if(cheque_no=='')
        {
           $("#errordata").fadeIn().html("Enter Cheque No").css("color","red");
            setTimeout(function(){$("#errordata").fadeOut("&nbsp;");},2000)
            $("#cheque_no").focus();
            return false;
        }
        if(cheque_date=='')
        {
          $("#errordata").fadeIn().html("select Cheque Date").css("color","red");
            setTimeout(function(){$("#errordata").fadeOut("&nbsp;");},2000)
            $("#cheque_date").focus();
            return false;
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
