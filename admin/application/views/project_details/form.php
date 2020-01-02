<style>
    textarea {
        resize: none;
    }
</style>

<div class="content-wrapper"> 
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Demo_details'); ?>">Manage Demo Project</a></li>
            <li class="active">
                <?= $heading;?>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="col-md-4">&nbsp;&nbsp;</div>
                        <div class="col-md-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" >
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product Name <span style="color:red;">*</span></label> <span style="color:red" id="project_name_err"></span>
                                    <input type="text" placeholder="Enter Product Name" class="form-control" id="project_name" name="project_name" value="<?php echo $project_name; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Price<span style="color:red;">*</span> </label> <span style="color:red" id="price_err"></span>
                                    <input type="text" placeholder="Enter Price" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                                </div>
                            </div>
                                  <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Demo Link </label> <span style="color:red" id="link_err"> </span>
                                    <input type="text" placeholder="Enter Demo Link" class="form-control ckeditor" id="link" name="link" value="<?php echo $link; ?>">
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User Id <span style="color:red;">*</span> </label> <span style="color:red" id="userid_err"></span>
                                    <input type="text" placeholder="Enter Demo Link User id" class="form-control ckeditor" id="userid" name="userid" value="<?php echo $userid; ?>">
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password<span style="color:red;">*</span> </label> <span style="color:red" id="password_err"></span>
                                    <input type="text" placeholder="Enter Demo Link User Password" class="form-control ckeditor" id="password" name="password" value="<?php echo $password; ?>">
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">*</span> </label> <span style="color:red" id="descrition"></span>
                                    <textarea type="text" placeholder="Enter Product Description" class="form-control ckeditor" id="descrition" name="description" 
                                    ><?php echo $description; ?></textarea>
                                </div>
                            </div> 
                           
                           <div class="hr-line-dashed"></div> 
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary" type="submit" onclick="return  validation();">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Demo_details/create') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </div>
                            </div>
                           
                         <!--    <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Demo_details/create') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </div>
                            </div> -->
                        </form>
                        


                    </div>
                  
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url();?>assets/custom_js/employees.js"></script>
<?php $this->load->view('common/footer');?>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>

<script type="text/javascript">
    function getcity(val)
{   
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/Employees/get_city');?>",
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata)
        {   
            $('#city_id').html(returndata);
        }
    });
}
</script>
<script>
    function getdesignation(id){
        alert(id);return false();
    }
   
    </script>
    <script >
         function validation()
    
        {
            var project_name=$("#project_name").val().trim();
            var price=$("#price").val().trim();
            var link=$("#link").val().trim();
            var userid=$("#userid").val().trim();
            var password=$("#password").val().trim();
           /* var descrition=$("#descrition").val().trim();*/
            if(project_name=="")
            {
                $("#project_name_err").fadeIn().html("Please enter project name").css('color','red');setTimeout(function(){   
                    $("#project_name_err").html("&nbsp;");},3000);
                $("#project_name").focus();
                  return false;
            }
  if(price=="")
            {
                $("#price_err").fadeIn().html("Please enter Price").css('color','red');setTimeout(function(){   
                    $("#price_err").html("&nbsp;");},3000);
                $("#price").focus();
                  return false;
            }
 if(link=="")
            {
                $("#link_err").fadeIn().html("Please enter Demo link").css('color','red');setTimeout(function(){   
                    $("#link_err_err").html("&nbsp;");},3000);
                $("#link").focus();
                  return false;
            }
 if(userid=="")
            {
                $("#userid_err").fadeIn().html("Please enter Demo User Id").css('color','red');setTimeout(function(){   
                    $("#userid_err_err").html("&nbsp;");},3000);
                $("#userid").focus();
                  return false;
            }
 if(password=="")
            {
                $("#password_err").fadeIn().html("Please enter Demo Password").css('color','red');setTimeout(function(){   
                    $("#password_err").html("&nbsp;");},3000);
                $("#password").focus();
                  return false;
            }
           /*  if(descrition=="")
            {
                $("#descrition_err").fadeIn().html("Please enter Demo Description").css('color','red');setTimeout(function(){   
                    $("#descrition_err").html("&nbsp;");},3000);
                $("#descrition").focus();
                  return false;
            }*/

           /* $(document).ready(function(){

            $("#descrition").validate(
            {
                ignore: [],
              debug: false,
                rules: { 

                    cktext:{
                         required: function() 
                        {
                         CKEDITOR.instances.cktext.updateElement();
                        },

                         minlength:10
                    }
                },
                messages:
                    {

                    cktext:{
                        required:"Please enter Text",
                        minlength:"Please enter 10 characters"


                    }
                }
            });
        });
*/
        }


    </script>