function validation() 
{
    var name = $("#name").val().trim();
   
    if ($.trim(name) == "") 
    {
        $("#name_err").fadeIn().html("Please Enter Name");
        setTimeout(function() {
            $("#name_err").fadeOut();
        }, 3000);
        $("#name").focus();
        return false;
    }
    var mobile = $("#mobile").val().trim();
   
    if ($.trim(mobile) == "") 
    {
        $("#mobile_err").fadeIn().html("Please Enter Mobile");
        setTimeout(function() {
            $("#name_err").fadeOut();
        }, 3000);
        $("#mobile").focus();
        return false;
    }
   var email = $("#email").val().trim();
   
    if ($.trim(email) == "") 
    {
        $("#email_err").fadeIn().html("Please Enter Email");
        setTimeout(function() {
            $("#email_err").fadeOut();
        }, 3000);
        $("#email").focus();
        return false;
    }
    var date = $("#date").val().trim();
   
    if ($.trim(date) == "") 
    {
        $("#date_err").fadeIn().html("Please Enter Date");
        setTimeout(function() {
            $("#date_err").fadeOut();
        }, 3000);
        $("#date").focus();
        return false;
    }
    var designation_id = $("#designation_id").val();
   
    if (designation_id == "")
    {
        $("#designation_id_err").fadeIn().html("Please Enter Designation");
        setTimeout(function() {
            $("#designation_id_err").fadeOut();
        }, 3000);
        $("#designation_id").focus();
        return false;
    }

    
}