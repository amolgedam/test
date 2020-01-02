 function validation()
{
   var title=$("#title").val().trim();
   var content = CKEDITOR.instances.content.getData();
    if(title=="")
    {
        $("#title_error").fadeIn().html("Please enter title").css('color','red');
        setTimeout(function(){$("#title_error").html("&nbsp;");},3000);
        $("#title").focus();
        return false;
    }
    if(content=='')
    {
        $("#content_error").fadeIn().html("Please enter content").css("color","red");
        setTimeout(function(){$("#content_error").fadeOut("&nbsp;");},2000)
        $("#content").focus();
        return false;
    }
    
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
        url:site_url+"/Cms/delete",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}

function statuss(id)
{ 
  var cnf = confirm('Are you sure to change the status?');
  var site_url=$("#site_url").val();
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
        url:site_url+"/Cms/change_status",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          
        }
      });   
  }
}
function convert_slug()
{
    var title = document.getElementById("title").value;
    var lower_case =title.toLowerCase();
    var remove_blank=lower_case.replace(/ /g,"-");
    document.getElementById("slug").innerHTML  = remove_blank; 
    document.getElementById("slug1").value  = remove_blank; 
}
$("#image").change(function() { 
   var val = $(this).val();
   
   switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
   case 'jpg': case 'png': case 'JPG': case 'PNG': case 'jpeg': case 'JPEG':
   
   break;
   default:
   $(this).val('');
   $("#image_error").fadeIn().html("Invalid");
          setTimeout(function(){$("#image_error").html("&nbsp;");},5000);
   break;
   }
   });           