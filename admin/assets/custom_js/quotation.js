var site_url = $("#site_url").val();
var url = site_url+'/Quotation/ajax_manage_page';
var actioncolumn=5;
setTimeout(function(){ $(".errid").fadeOut(); },3000); 

CKEDITOR.replace( 'editor1',
    {
        toolbar :
        [
            ['Bold','Italic','Underline','Strike'],
        ]
    });
function show_model(id,email)
{
  $("#myModal").modal('show');
  $("#quot_id").val(id);
  $("#to").val(email);
}

function Delete(obj,id)
{
  var site_url = $("#site_url").val();
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+id).fadeOut();
    var datastring="id="+id;
    $.ajax({
        type:"POST",
        url:site_url+'/Quotation/delete',
        data:datastring,
        cache:false,        
        success:function(returndata)
        {      
           table.draw();
        }

      });
  }
}