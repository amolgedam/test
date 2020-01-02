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
            <li><a href="<?php echo site_url('Services'); ?>">Manage Designation</a></li>
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
                                    <label class="control-label">Desgination <span style="color:red;">*</span></label> <span style="color:red" id="title_err"><?php echo form_error('title') ?></span>
                                    <input type="text" placeholder="Enter Title" class="form-control" id="title" name="title" value="<?php echo $title; ?>" onkeypress="only_alphabets(event)">
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
                                        <a href="<?php echo site_url('Designation/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
        var title = $("#title").val().trim();
        var ipadd = $("#ipadd").val().trim();
         
        if (title == "")
        {
            $("#title_err").fadeIn().html("Please enter Title").css("color","red");
            setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
            $("#title").focus();
            return false;
        }

         if(ipadd=='')
        {
            $("#ipadd_err").fadeIn().html("Please enter Ip Address").css("color","red");
            setTimeout(function(){$("#ipadd_err").fadeOut("&nbsp;");},2000)
            $("#ipadd").focus();
            return false;
        }

    }
</script>