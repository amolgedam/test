<style>
    textarea {
        resize: none;
    }
</style>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Certificate_type/index'); ?>">Manage Certificate Type</a></li>
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
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Title <span style="color:red;">* </span></label>
                                    <span style="color:red" id="title_err"> </span>
                                    <?php echo form_error('title')?>
                                    <input type="text" placeholder="Enter Title" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                                </div>
                            </div>
                            
                           
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Certificate_type');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                          </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('common/footer');?>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script type="text/javascript">
   

function check_error() 
{
    var title = $("#title").val().trim();
   
    if ($.trim(title) == "") 
    {
        $("#title_err").fadeIn().html("Please enter Title");
        setTimeout(function() {
            $("#title_err").fadeOut();
        }, 3000);
        $("#title").focus();
        return false;
    }
    
}

     
</script>