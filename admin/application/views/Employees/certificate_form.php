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
            <li><a href="<?php echo site_url('Employees'); ?>">Manage Employees</a></li>
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
                           
                            <div class="col-md-6" style="display: block" id="Designation">
                                <div class="form-group">
                                    <label for="Image">Certificate Type<span style="color:red;">*</span></label><span style="color:red" id="errordesignation_id"><?php echo form_error('designation_id')?> </span>
                                        <select name="certificate_id" id="certificate_id" class="form-control" onchange="return get_data(this.value)">
                                            <option value="">--Select Certificate Type--</option>
                                            <?php if(!empty($certificate)){ foreach ($certificate as $row) {?>
                                               <option value="<?= $row->id; ?>" ><?= ucfirst($row->title); ?></option>
                                           <?php }} ?> 
                                        </select>
                                </div>
                            </div>
                           <div class="col-md-12">
                                 <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label> <span style="color:red" id="erroremail_id"><?php echo form_error('description')?> </span>
                                  <textarea name="description" class="ckeditor form-control" id="description"></textarea>  
                                 
                                </div>
                            </div>
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label> <span style="color:red" id="erroremail_id"><?php echo form_error('description')?> </span>
                                  <textarea name="description1" class="ckeditor form-control" id="description1"></textarea>  
                                 
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label> <span style="color:red" id="erroremail_id"><?php echo form_error('description')?> </span>
                                  <textarea name="description2" class="ckeditor form-control" id="description2"></textarea>  
                                 
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label> <span style="color:red" id="erroremail_id"><?php echo form_error('description')?> </span>
                                  <textarea name="description3" class="ckeditor form-control" id="description3"></textarea>  
                                 
                                </div>
                            </div>

                        </div>   <!-- col-md-12 -->
                            
                           <!--  <div class="hr-line-dashed"></div> -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" class="form-control"  id="id"  value="<?php echo $id;?>">
                                        <button class="btn btn-primary" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Employees/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
      function get_data()
      { 
        var certificate_id=$('#certificate_id').val();
   
        $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo site_url('/Employees/get_certificate');?>",
        data:{certificate_id:certificate_id},
       // beforeSend:function(){},
        success:function(returndata)
        {  
           var obj=$.parseJSON(returndata); 
          
        CKEDITOR.instances['description'].setData(obj.data1);
        CKEDITOR.instances['description1'].setData(obj.data2);
        CKEDITOR.instances['description2'].setData(obj.data3);
        CKEDITOR.instances['description3'].setData(obj.data4);
        }
    });
        
      }

</script>