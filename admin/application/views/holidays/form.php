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
      <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li><a href="<?php echo site_url('Countries/index'); ?>">Manage Holidays</a></li>
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
            <div class="clearfix"></div>   
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" >
             <div class="col-md-6">
              <div class="form-group">
               <label class="control-label">Title <span style="color:red;">*</span></label>  <span  style="color:red" id="errorTitle" class= "errid"><?php echo form_error('title'); ?> </span>
               <div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" placeholder="Title" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                  </div>

                </div>

              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
             <label class="control-label">Date <span style="color:red;">*</span></label> <span  style="color:red" id="errorDate" class= "errid"> <?php echo form_error('date'); ?> </span>
             <div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" placeholder="Date" class="form-control" id="date" name="date" value="<?php echo date('m/d/Y',strtotime($date)); ?>" readonly>
                </div>

              </div>
            </div>
          </div>

        </div> 

                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group">
                                    <div class="col-md-12">
                                      <div>
                                          <input type="hidden" id="button" value="<?= $button; ?>"/>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()"><?php echo $button; ?></button>
                                        <a href = "<?php echo site_url('Holidays/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
                      var title = $("#title").val().trim();
                      var date = $("#date").val().trim();
                      /*var name_filter = /^[A-Za-z]{1}[A-Za-z' ]{2,80}$/i;
                      var currency_name = $("#currency_name").val();
                      var image = $('#image').val();*/
                      var button = $("#button").val();
                     
                      if(title=="")
                      {
                        $("#errorTitle").fadeIn().html("Please enter title");
                        setTimeout(function(){ $("#errorTitle").fadeOut(); }, 3000);
                        $("#title").focus();
                        return false;
                      }

                      if(date=="")
                      {
                        $("#errorDate").fadeIn().html("Please enter date");
                        setTimeout(function(){ $("#errorDate").fadeOut(); }, 3000);
                        $("#date").focus();
                        return false;
                      }

                       if(code==0)
                      {
                        $("#errorCname").fadeIn().html("Please enter valid country code");
                        setTimeout(function(){ $("#errorCname").fadeOut(); }, 3000);
                        $("#country_code").focus();
                        return false;
                      }

                      if(currency_name.trim() == "")
                      {
                       $("#currency_err").fadeIn().html("Please enter currency name");
                       setTimeout(function(){$("#currency_err").html("&nbsp;");},3000)
                       $("#currency_name").focus();
                       return false;
                     } 


       if(button=='Create')
       {
          
        if(image.trim() == "")
        {
               $("#image_err").fadeIn().html("Please upload image");
                setTimeout(function(){$("#image_err").html("&nbsp;");},3000)
                $("#image").focus();
                return false;
        } 
      }

                   }
                   </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
            $( "#date" ).datepicker
            (
                { minDate: 0,
                
            });
  } );
  </script>   
