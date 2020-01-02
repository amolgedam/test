<style>
    textarea {
        resize: none;
    }
</style>
<style type="text/css">
    .multiselect {
  width: 500px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<style type="text/css">
    .multiselects {
  width: 500px;
}

.selectBoxs {
  position: relative;
}

.selectBoxs select {
  width: 100%;
  font-weight: bold;
}

.overSelects {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxess {
  display: none;
  border: 1px #dadada solid;
}

#checkboxess label {
  display: block;
}

#checkboxess label:hover {
  background-color: #1e90ff;
}
</style>
<style>
table, th, td {
  border: 3px solid black;
}
th, td {
  padding: 13px;
}
table {
  border-spacing: 15px;
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
            <li><a href="<?php echo site_url('Intendletter/index'); ?>">Manage Intend Letter</a></li>
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
                                    <label class="control-label">Name <span style="color:red;">* </span></label>
                                    <span style="color:red" id="name_err"> </span>
                                    <input type="text" name="name" value="<?php echo $name ?>" id="name" class="form-control" />
                                </div>
                            </div>
                           
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;"> </span></label>
                                    <span style="color:red" id="description_err"> </span>
                                    <textarea type="text" placeholder="Enter description" class="form-control ckeditor" id="description" name="description" ><?php if (!empty($description)){echo $description;}else{ echo "";} ?></textarea>
                                </div>
                          </div>   <!--col-md-12-->
                            <input type="hidden" name="id" id="id" class="form-control" value=<?php echo $id; ?>>
                            
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Intendletter');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                           
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

<script>
        
        var url = actioncolumn = '';

     function check_error() {
       
        var name = $("#name").val().trim();
        
        if(name=="")
        {
          $("#name_err").fadeIn().html("Enter Name");
          setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
          $("#name").focus();
          return false;
        }
        
        // var description = $("#description").val().trim();
        // // console.log(description);
        // if(description=="")
        // {
        //   $("#description_err").fadeIn().html("Enter Description");
        //   setTimeout(function(){ $("#description_err").fadeOut(); }, 3000);
        //   $("#description").focus();
        //   return false;
        // }
    }
</script>


