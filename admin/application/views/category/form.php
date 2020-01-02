<style>
textarea {
    resize: none;
}
</style>

<!--<link href="assets/css/datepicker3.css" rel="stylesheet">-->


<div class="content-wrapper"> 
<section class="content-header">
      <h1>
        <div>&nbsp;<?php echo $heading; ?></div>
      </h1>
     <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Login/dashboard/index'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('Banners/index'); ?>">Manage Banners</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section> 
<section class="content">   
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">                           
                            
                            <div class="col-md-4">&nbsp;&nbsp;</div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <!-- <span style="color:red;float:right;">* Fields required</span> -->
                            </div>
                            <div class="clearfix"></div>   
                        </div>
                        <div class="box-body">
                            <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-horizontal">

                                

                              <div class="form-group">
                                    <div class="col-md-6">
                                    <label>Image <span style="color:red;">*</span></label> &nbsp;<span id="image_err" style="color:red;"></span>
                                    <input type="file" class="form-control" id="image" name="image" onclick="imageFile();">
                                    <br>
                                   
                        <span class="blue"><strong>Note :</strong>Please select image type jpg,png,jpeg </span><br/><br/>
                       
                                    <input type="hidden"  id="old_image" name="old_image" <?php  if($button == 'Update')
                                    { ?> value="<?php echo $image ?>" <?php } ?>/>

                                    <!--  <?php  if($button == 'Update')
                                        {
                                           if($image!=''){?>
                                     <img src="<?php echo base_url('uploads/banner_image/'.$image);?>" width="100px" height="100px"/>
                                     <?php }else {?>
                                     <img src="<?php echo base_url('uploads/banner_image/no_image.png');?>" width="100px" height="100px"/>
                                     <?php }} ?> -->

                                      <?php  if($button=='Update'){  if(!empty($image))
                                        {if(!file_exists("uploads/banner_image/".$image)) { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                          
                                        <?php } else { ?>
                                              <img src="<?php echo base_url('uploads/banner_image/'.$image)?>" width="100px" height="100px" id="thumb" alt="No Image">
                                        <?php } } else { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="100px" height="100px" id="thumb" alt="No Image">
                                       <?php }} ?>
                                    </div>

                                    </div>
                                                            
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                    <div>
                                      <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                                        <input type="hidden" id="button" value="<?= $button; ?>"/>
                                        <a href = "<?php echo site_url('Banners/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript"> 
    function check_error()
    {
        var image = $('#image').val();
       var button = $("#button").val();
       if(button=='Create')
       {
          
        if(image.trim() == "")
        {
               $("#image_err").fadeIn().html("Please upload image");
                setTimeout(function(){$(" #image_err").html("&nbsp;");},3000)
                $("#image").focus();
                return false;
        } 
      }

          }
        /*var exts = ['png'];
        // first check if file field has any value
        if ( image ) 
        {
          // split file name at dot
          var get_ext = image.split('.');
          // reverse name to check extension
          get_ext = get_ext.reverse();
          // check file type is valid as given in 'exts' array
          if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            
          } else {
            $("#err_image").fadeIn().html("Please upload only png image ");
              setTimeout(function(){$("#err_image").html("&nbsp;");},3000)
              $("#image").focus();
              return false;
          }
        }*/

function imageFile_new()
  {  
    
    $('#image').change(function () {  
    var files = this.files;   
    var reader = new FileReader();
    name=this.value;    
    //validation for photo upload type    
    var filetype = name.split(".");
    ext = filetype[filetype.length-1];  //alert(ext);return false;
    if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG'))
    {   
        $("#image_err").html("Please select proper type like jpg, png, jpeg image");     
        setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
        $("#image").val("");
    return false;
    }

    /*var height = $('#image').height();
    var width = $('#image').width();
     alert(height);alert(width);

    if((height != 50) && (width != 50))
    {   

     $("#image_err").html("Please select proper image of size 1920px X 700px");     
    setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
    $("#image").val("");
    return false;
    }*/
    reader.readAsDataURL(files[0]);
    });
  }




 /* function imageFile_new() 
  {

            //Get reference of FileUpload.
            var fileUpload = document.getElementById("image");
            //var fileUpload = $('#image').val();
            alert(fileUpload);
            //Check whether the file is valid Image.
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg|.JPG|.PNG|.JPEG)$");
            if (regex.test(fileUpload.value.toLowerCase()))
            {
              alert("hhhh");
              //Check whether HTML5 is supported.
              if (typeof (fileUpload.files) != "undefined") 
              {
                alert("cxccvcv");

                //Initiate the FileReader object.
                var reader = new FileReader();

                //Read the contents of Image File.
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e)
                {
                  alert("rrrr");
                  //Initiate the JavaScript Image object.
                  var image = new Image();

                  //Set the Base64 string return from FileReader as source.
                  image.src = e.target.result;

                  //Validate the File Height and Width.
                  image.onload = function ()
                  {
                    alert("xcccccccc");
                    var height = this.height;
                    var width = this.width;
                     alert(height);alert(width);
                    if (height != 700 || width != 1920)
                     {
                      alert("ppp");
                      $("#image_err").html("Please select proper image of size 1920px X 700px");     
                      setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
                      $("#image").val("");
                      // $("#image").val('');
                      return false;

                    }


                  };
                }
              }
               else 
               {
              alert("vccv");
              alert("This browser does not support HTML5.");
              $("#image").val("");
              return false;
              }
            } else {
            alert("kkkkkk");

            $("#image_err").html("Please select proper type like jpg, png, jpeg image");     
            setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
            $("#image").val("");

            return false;
            }
 }*/

/*function show_btn_big()
{
        //alert('hjbfjh');
    console.log("in getimage");
    document.getElementById('image').click();
    $('input[type=file]').change(function () {
        //console.log(this.files[0].mozFullPath);
        console.log(this.files[0].webkitFullPath);
    });
        
}
$("#image").change(function () {
  alert("giii");
        var files = this.files;
        var reader = new FileReader();
        name=this.value;
        var filetype = name.split(".");
        ext = filetype[filetype.length-1];
                    
      
       
        if(!(ext=='jpg') && !(ext=='png') && !(ext=='jpeg') && !(ext=='JPG') && !(ext=='PNG') && !(ext=='JPEG'))
        {   
            $("#image_err").html("Please select proper type like jpg, png, jpeg image");     
        setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
        $("#image").val("");
        return false;
            
        }
        else
        {
            //$("#submitFormId").click();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;

                image.onload = function () 
                {
                    var height = this.height;
                    var width = this.width;
                    
                    if((height != 500) && (width != 500))
                    {   
                         $("#image_err").html("Please select proper image of size 1920px X 700px");     
                            setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
                            $("#image").val("");
                            // $("#image").val('');
                            return false;
                    }
                    
                };
            };
        }
        reader.readAsDataURL(files[0]);         
});
*/
</script>   
