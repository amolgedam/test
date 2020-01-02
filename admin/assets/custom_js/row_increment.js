function only_number(event)
      {
        var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x==46)
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

function print_validations()
{
  var customer_name = $("#customer_name").val();
  if($.trim(customer_name)=="")
  {
    $("#errorcustname").html("Please select Name").fadeIn();
    setTimeout(function(){$("#errorcustname").fadeOut()},3000);
    $("#customer_name").focus();
    return false;
  }
  
//   value=[];  
//   $('.attrname').each(function(){ value.push(($(this).val().trim()));}); 
//   var chk_duble = checkDuplicate(value);  
//   if(chk_duble == true)
//   {
//     $("#attrname_error").html("Already exist").fadeIn();
//     setTimeout(function(){$("#attrname_error").fadeOut();$(".attrname").css("borderColor","#00A654") },8000)
//      $(".attrname").focus()
//     ;
//     return false;
//   }
  var count = $('#clonetable_feedback tr').length;
   for(var i=1; i <= count;  i++)
  {
    var item1=$("#item"+i).val();
    var rate1=$("#rate"+i).val();
    var cgst1=$("#cgst"+i).val();
    var sgst1=$("#sgst"+i).val();
    var discount1=$("#discount"+i).val();
    if($.trim(item1)== 0)
    {
      $("#error1").html("Required").fadeIn();
      setTimeout(function(){$("#error1").fadeOut()},3000);
      $("#item"+i).focus();
      return false;
    } 
    if($.trim(rate1)=="")
    {
      $("#error2").html("Required").fadeIn();
      setTimeout(function(){$("#error2").fadeOut()},3000);
      $("#rate"+i).focus();
      return false;
    }
    if($.trim(cgst1)=="")
    {
      $("#error3").html("Required").fadeIn();
      setTimeout(function(){$("#error3").fadeOut()},3000);
      $("#cgst"+i).focus();
      return false;
    }
    if($.trim(sgst1)=="")
    {
      $("#error4").html("Required").fadeIn();
      setTimeout(function(){$("#error4").fadeOut()},3000);
      $("#sgst"+i).focus();
      return false;
    }
    if(discount1=='')
    {
        $("#error5").fadeIn().html("Required").css("color","red");
        setTimeout(function(){$("#error5").fadeOut("&nbsp;");},2000)
        $("#discount"+i).focus();
        return false;
    }
  }  
}
function addrow_feedback()
   {   
      var y=document.getElementById('clonetable_feedback');
      var new_row = y.rows[0].cloneNode(true);
      var len = y.rows.length;
      new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;

      var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
      inp1.value = '';
      inp1.id = 'item'+(len+1);
      
      var inp6 = new_row.cells[1].getElementsByTagName('textarea')[0];
      inp6.value = '';
      inp6.id = 'desc'+(len+1);
       
      var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
      inp2.value = '';
      inp2.id = 'rate'+(len+1);
       
      var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
      inp3.value = '9';
      inp3.id = 'cgst'+(len+1);

      var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
      inp4.value = '9';
      inp4.id = 'sgst'+(len+1);

      var inp5 = new_row.cells[5].getElementsByTagName('input')[0];
      inp5.value = '0';
      inp5.id = 'discount'+(len+1);

      
      y.appendChild(new_row);            
   }
   
   function deleteRow_feedback(row)
   {
       var y=document.getElementById('purchaseTableclone123');

       var len = y.rows.length;
       if(len>2)
       {
           var i= (len-1);
           document.getElementById('clonetable_feedback').deleteRow(row);
       }
   } 

function checkDuplicate(name)
{ 
  var name_array = name.sort(); 
  var name_duplicate = [];
  for (var i = 0; i < name_array.length - 1; i++) 
  {
      if (name_array[i + 1] == name_array[i]) 
     {
         name_duplicate.push(name_array[i]);
     }
  }
  isValid = false;
  if(name_duplicate!='')
  {
    isValid = true;
  }
  return isValid;
}
function getView(id)
{ $(".loader").show();
  var site_url = $('#site_url').val();
  var url = site_url+"/Attributes/view";
  var dataString = "id="+id;
  $.post(url,dataString,function(returndata)
  { 
    $("#viewAttr").html(returndata);
    $(".loader").hide();
  });
}