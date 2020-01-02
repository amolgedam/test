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
            <li><a href="<?php echo site_url('Services'); ?>">Manage Services</a></li>
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
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" onsubmit="return check_error()">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Services Type <span style="color:red;">*</span></label><span style="color:red" id="type_err"><?php echo form_error('type') ?></span>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">--Select service--</option>
                                            <option value="Application_Development" <?php if ($type=='Application_Development') echo 'selected="selected"' ?>>Application Development</option>
                                            <option value="Digital_Marketing" <?php if($type=='Digital_Marketing') echo 'selected="selected"' ?>>Digital Marketing</option>
                                            <option value="Infrastructure" <?php if($type=='Infrastructure') echo 'selected="selected"' ?>>Infrastructure</option>
                                            <option value="Business_Services" <?php if ($type=='Business_Services') echo 'selected="selected"' ?>>Business Services</option>
                                            <option value="Mobile_App" <?php if ($type=='Mobile_App') echo 'selected="selected"' ?>>Mobile App</option>
                                            <option value="Crm" <?php if ($type=='Crm') echo 'selected="selected"' ?>>CRM(Customer Relationship Management)</option>
                                            
                                        </select>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Title <span style="color:red;">*</span></label> <span style="color:red" id="title_err"><?php echo form_error('title') ?></span>
                                    <input type="text" placeholder="Enter Title" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary" type="submit">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Services/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
<?php $this->load->view('common/footer');?>
<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";
</script>

<script type="text/javascript">
    function only_number(event)
      {
        var x = event.which || event.keyCode;
        console.log(x);
        if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
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
    function check_error() 
    {
        var type = $("#type").val().trim();
        var title = $("#title").val().trim();
    
         if(type=='')
        {
            $("#type_err").fadeIn().html("Please enter Service type").css("color","red");
            setTimeout(function(){$("#type_err").fadeOut("&nbsp;");},2000)
            $("#type").focus();
            return false;
        }
         
        if (title == "")
        {
            $("#title_err").fadeIn().html("Please enter Title").css("color","red");
            setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
            $("#title").focus();
            return false;
        }

    }
</script>
<!-- <script type="text/javascript">

function getcity(val)
{
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/CustomerMaster/get_city');?>",
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata)
        {   
            $('#city_id').html(returndata);
        }
    });
}
</script> -->