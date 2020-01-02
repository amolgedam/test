  <?php $this->load->view('common/header'); ?>
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
       <li><a href="<?php echo site_url('Countries/index'); ?>">Manage Country</a></li>
      <li class="active"><?= $subheading;?></li>
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
               <label class="control-label">Country Name </label>  <span  style="color:red" id="errorname" class= "errid"><?php echo form_error('country_name'); ?> </span>
               <div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" placeholder="Country Name" class="form-control" id="name" name="country_name" value="<?php echo $country_name; ?>" readonly>
                  </div>

                </div>
               <!--  <span class= "errid">
                  <?php echo form_error('country_name'); ?>
                </span> -->

              </div>
            </div>
          </div>


          

        <div class="col-md-6">
          <div class="form-group">
            <label><span style="color:red;"></span>Currency Name </label>  <span style="color: red;" id="currency_err" class= "errid"><?php echo form_error('currency_name'); ?></span>
            <div>
              <div class="row">
                <div class="col-md-12">
                 <input type="text" name="currency_name" id="currency_name" class="form-control" value="<?= $currency_name; ?>" placeholder="Enter Currency Name" readonly>
               </div>

             </div>
          </div>
        </div>
      </div>


      <div class="col-md-6">
            <div class="form-group">
             <label class="control-label">City<span style="color:red;">*</span></label> <span  style="color:red" id="errorCity" class= "errid"> </span>
             <div>
              <div class="row">
                <div class="col-md-12">
                  <select class="form-control select2" style="color:#000;" id="city" name="city[]" multiple=""><!-- multiple="multiple" -->
                        <option value=''>Select City</option> 
                    <?php foreach($city as $row){ ?>
                        <option value='<?php echo $row->id; ?>'> <?php echo $row->city_name; ?> </option>
                    <?php } ?>
                  </select>
                </div>

              </div>
            </div>
          </div>
        </div>

    <div class="hr-line-dashed"></div>
    <div class="form-group">
      <div class="col-md-12">
        <div>
            
          <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
          <button class="btn btn-primary" type="submit" name="btn" onclick="return check_error()" value ="<?php echo $button; ?>" ><?php echo $button; ?></button>
          <button class="btn btn-primary" type="submit" name="btn_next" onclick="return check_error()" value ="<?php echo $button_next; ?>" ><?php echo $button_next; ?></button>
          <a href = "<?php echo site_url('Countries/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
<script type="text/javascript">

var url='';
var actioncolumn = '';
</script>
<?php $this->load->view('common/footer'); ?>
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript"> 
function check_error()
{
var city = $("#city").val().trim();

if(city=="")
{
$("#errorCity").fadeIn().html("Please select city");
setTimeout(function(){ $("#errorCity").fadeOut(); }, 3000);
$("#city").focus();
return false;
}

}
</script>   



