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
            <li><a href="<?php echo site_url('Cities/index'); ?>">Manage Company</a></li>
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
                                    <label class="control-label">Expence Name <span style="color:red;">* </span></label>
                                    <span style="color:red" id="exp_err"> </span>
                                    <input type="text" placeholder="Expence Name" class="form-control" id="expence_name" name="expence_name" value="<?php echo $expence_name; ?>">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span style="color:red;">* </span></label>
                                    <span style="color:red" id="des_err"> </span>
                                    <input type="text" placeholder="Enter Description" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Amount(<i class="fa fa-inr"></i>)<span style="color:red;">*</span></label> <span style="color:red" id="amount_err"> </span>
                                    <input type="text" placeholder="Amount" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>" onkeypress="return only_number(event);">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date<span style="color:red;">* </span></label>
                                    <span style="color:red" id="exp_date"> </span>
                                    <input type="text" placeholder="Date" class="form-control" id="expence_date" name="expence_date" value="<?php echo date('d-m-Y'); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <span style="color:red" id="exp_image"> </span>
                                    <input type="file" class="form-control" id="image" name="image" >
                                    <br>
                                    <?php if($button=='Update'){
                                    if(!empty($image))
                                    { ?>
                                     <img src="<?php echo base_url() ?>uploads/expence/<?php echo $image; ?>" height="60px" width="60px">
                                    <?php } } ?>
                                    <input type="hidden" name="old_image" value="<?php echo $image; ?>">
                                </div>
                            </div>
                           
                            <?php if($button=="Update"){?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status<span style="color:red;">* </span></label>
                                    <span style="color:red" id="exp_date"> </span>
                                    <select name="status" class="form-control">
                                        <option value="Pending" <?php if($status=="Pending") { echo 'selected';}?> >Pending</option>
                                        <option value="Completed" <?php if($status=="Completed") { echo 'selected';}?> >Completed</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="clearfix">&nbsp;</div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="Create" onclick="return check_error()"><?= $button ?></button>
                           <a href="<?= site_url('Expence');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
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
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
    var url ="";
    var actioncolumn  ="";

     $("#expence_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      minDate: 0,
    })

</script>

<script type="text/javascript">
    var radioValue = $("input[name='made_by']:checked").val();
    if(radioValue=="Employee"){
         $("#show_emp").show();
    }

    function show1()
    {
        $("#show_emp").show();
    }
    function hide1()
    {
        $("#show_emp").hide();
    }

function check_error() 
{
    var expence_name = $("#expence_name").val().trim();
    var amount= $('#amount').val();
    var expence_date= $('#expence_date').val();
    if ($.trim(expence_name) == "") 
    {
        $("#exp_err").fadeIn().html("Please enter expence name");
        setTimeout(function() {
            $("#exp_err").fadeOut();
        }, 3000);
        $("#expence_name").focus();
        return false;
        
    }
    if ($.trim(amount) == "") 
    {
        $("#amount_err").fadeIn().html("Please enter amount");
        setTimeout(function() {
            $("#amount_err").fadeOut();
        }, 3000);
        $("#amount").focus();
        return false;
    }
    if ($.trim(expence_date) == "") 
    {
        $("#exp_date").fadeIn().html("Please select date");
        setTimeout(function() {
            $("#exp_date").fadeOut();
        }, 3000);
        $("#expence_date").focus();
        return false;    
    }
    
// executive_id
}

function only_number(event)
{
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x == 46 )
    {
      return;
    }else{
      event.preventDefault();
    }    
}   
     
</script>