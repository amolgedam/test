function validation()
{
   var emp_id=$("#emp_id").val().trim();
  // var content = CKEDITOR.instances.content.getData();
    if(emp_id=="")
    {
        $("#emp_err").fadeIn().html("Please enter Employee").css('color','red');
        setTimeout(function(){$("#emp_err").html("&nbsp;");},3000);
        $("#emp_id").focus();
        return false;
    }
   /* if(content=='')
    {
        $("#content_error").fadeIn().html("Please enter content").css("color","red");
        setTimeout(function(){$("#content_error").fadeOut("&nbsp;");},2000)
        $("#content").focus();
        return false;
    }*/
    
}

function Delete(obj,id)
{
  var ask = confirm("Do you want to delete this record?");
  var site_url=$("#site_url").val();
  if(ask==true)
  { 
    $(".id"+id).fadeOut();
    var datastring="id="+id;
    $.ajax({
        type:"POST",
        url:site_url+"/Taskassign/delete",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}

function status(id)
{ 
  var cnf = confirm('Are you sure to change the status?');
  var site_url=$("#site_url").val();
  if(cnf==true)
  {
    var status=$("#status"+id).val();
    if(status=="Pending")
    {
      $("#statusVal"+id).removeClass("btn-success");
      $("#statusVal"+id).addClass("btn-danger");
      $("#statusVal"+id).attr("onclick", "status("+id+",'Completed')").html('Completed');
      var status ='Completed';
      $("#status"+id).val('Completed');
    }
    else
    {
      $("#statusVal"+id).removeClass("btn-danger");
      $("#statusVal"+id).addClass("btn-success");
      $("#statusVal"+id).attr("onclick", "status("+id+",'Pending')").html('Pending');
      var status ='Pending';
      $("#status"+id).val('Pending');
    } 
    var datastring="id="+id+"&status="+status+"&statusupdate="+'update';
    $.ajax({
        type:"POST",
        url:site_url+"/Taskassign/change_status",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
           
        }
      });   
  }
}