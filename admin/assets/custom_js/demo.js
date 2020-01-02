function only_number(event)
      {
        var quantity = $("#quantity").val();
        var rate = $("#rate").val();
        var x = event.which || event.keyCode;

        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x==46)
        {   
            return;
        }else{
          event.preventDefault();
        }
      }

function check_error() 
    {
        
        vendor_id  = $("#vendor_id").val();
        issue_date = $("#issue_date").val();
        bill_no = $("#bill_no").val().trim();
        product_id1 = $("#product_id1").val().trim();
        hsn_code1 = $("#hsn_code1").val().trim();
        mfg_date1 = $("#mfg_date1").val();
        expiry_date1 = $("#expiry_date1").val();
        quantity1 = $("#quantity1").val().trim();
        rate1 = $("#rate1").val().trim();
        
        if(vendor_id=='')
        {
            $("#errorvendor_name").fadeIn().html("Please select Vendor First").css("color","red");
            setTimeout(function(){$("#errorvendor_name").fadeOut("&nbsp;");},2000)
            $("#vendor_id").focus();
            return false;
        }
        if(issue_date=='')
        {
            $("#errorissue_date").fadeIn().html("Please select Billing Date").css("color","red");
            setTimeout(function(){$("#errorissue_date").fadeOut("&nbsp;");},2000)
            $("#issue_date").focus();
            return false;
        }
        if(bill_no=='')
        {
            $("#error_billno").fadeIn().html("Please insert Bill No").css("color","red");
            setTimeout(function(){$("#error_billno").fadeOut("&nbsp;");},2000)
            $("#bill_no").focus();
            return false;
        }
        if(product_id1=='')
        {
            $("#error_product").fadeIn().html("Please select Product First").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#product_id1").focus();
            return false;
        }
        if(hsn_code1=='')
        {
            $("#error_product").fadeIn().html("Please enter HSN code").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#hsn_code1").focus();
            return false;
        }
        if(mfg_date1=='')
        {
            $("#error_product").fadeIn().html("Please set Manufacturing Date").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#mfg_date1").focus();
            return false;
        }
        if(expiry_date1=='')
        {
            $("#error_product").fadeIn().html("Please set Expiry Date").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#expiry_date1").focus();
            return false;
        }
        if(quantity1=='')
        {
            $("#error_product").fadeIn().html("Please enter Quantity").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#quantity1").focus();
            return false;
        }
        if(rate1=='')
        {
            $("#error_product").fadeIn().html("Please enter Price").css("color","red");
            setTimeout(function(){$("#error_product").fadeOut("&nbsp;");},2000)
            $("#rate1").focus();
            return false;
        }
        
    }

function getPrice(val,rid)
{

  var y=document.getElementById('clonetable_feedback');
      var new_row = y.rows[0].cloneNode(true);
      var len = y.rows.length;
      var rowid = parseInt(rid)+parseInt(1);
      // var price = $("#rate"+rowid).val();
      var qty = parseInt($('#quantity'+rowid).val());

      var cgst = parseInt($('#cgst'+rowid).val());
      var sgst = parseInt($('#sgst'+rowid).val());
      var price = parseFloat($('#rate'+rowid).val());
      $('#amt'+rowid).val(parseFloat(price * qty).toFixed(2));
      var total = parseFloat(price * qty).toFixed(2);
      var cgst_value = total - (total * cgst / 109).toFixed(2);
      var sgst_value = cgst_value - (total * sgst / 109).toFixed(2);
      $('#tax'+rowid).val(total-sgst_value);
      
        $("#t").val(total);
        value=[];  
         $('.total').each(function(){ value.push(($(this).val().trim()));});
        
        $("#sum_of_comma").val(value);
        sumofnums = 0;
        nums = document.getElementById("sum_of_comma").value.split(",");
        //alert(nums); 
        for (i = 0; i < nums.length; i++) {
          sumofnums += parseInt(nums[i]);
        }

        $('.sub_total').html(sumofnums);
        $("#sub_total").val(sumofnums);
        $('#total_price'+rowid).val(sgst_value);
        
}

$(document).on('focus',".datepicker_recurring_start", function(){
    $(this).datepicker();
});

function addrow_feedback()
   {   
       var y=document.getElementById('clonetable_feedback');
       var new_row = y.rows[0].cloneNode(true);
       var len = y.rows.length;
       ///alert(len); return false;
       new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
                 
       var inp1 = new_row.cells[0].getElementsByTagName('select')[0];
       inp1.value = '';
       inp1.id = 'product_id'+(len+1);
                 
       var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
       inp2.value = '';
       inp2.id = 'hsn_code'+(len+1);
      
       var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
      inp3.value = '';
      inp3.id = 'mfg_date'+(len+1);
      //$('#mfg_date'+(len+1)).datepicker();
      
       var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
      inp4.value = '';
      inp4.id = 'expiry_date'+(len+1);
      
       var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
      inp5.value = '';
      inp5.id = 'quantity'+(len+1);
      
       var inp6 = new_row.cells[5].getElementsByTagName('input')[0];
      inp6.value = '';
      inp6.id = 'rate'+(len+1);

      var inp7 = new_row.cells[6].getElementsByTagName('input')[0];
      // inp7.value = '';
      inp7.id = 'cgst'+(len+1); 

      var inp8 = new_row.cells[7].getElementsByTagName('input')[0];
      // inp8.value = '';
      inp8.id = 'sgst'+(len+1); 
      
      var inp9 = new_row.cells[8].getElementsByTagName('input')[0];
      // inp8.value = '';
      inp9.id = 'igst'+(len+1); 

      var inp10 = new_row.cells[9].getElementsByTagName('input')[0];
      inp10.value = '';
      inp10.id = 'tax'+(len+1); 

      var inp11 = new_row.cells[10].getElementsByTagName('input')[0];
      inp11.value = '';
      inp11.id = 'total_price'+(len+1);

      var inp12 = new_row.cells[11].getElementsByTagName('input')[0];
      inp12.value = '';
      inp12.id = 'amt'+(len+1);

    y.appendChild(new_row);            
   }
   
   //delete adde row 
   function deleteRow_feedback(row)
   {
       var y=document.getElementById('clonetable_feedback');
       var len = y.rows.length;
       if(len>1)
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
  