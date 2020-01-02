
<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Career View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Career View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Career');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Name :</label>
                      <p><?php if(!empty($name)) { echo $name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Skill :</label>
                      <p><?php if(!empty($skill)) { echo $skill;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Email :</label>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group">
                      <label>Apply For :</label>
                      <p><?php if(!empty($apply_for)) { echo $apply_for;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Address :</label>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Date of Apply :</label>
                      <p><?php if(!empty($date)) { echo $date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Mobile Number :</label>
                      <p><?php if(!empty($mobile)) { echo $mobile;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group im">       
                      <?php if(!empty($resume)) { ?>
                        <div><label>Image :</label></div>
                          <div class="col-md-3">
                              <a href="<?php echo base_url('../uploads/resume/'.$resume);?>"><img src="<?php echo base_url()?>../uploads/resume/pdf.jpg" width="230px" height="200px" style="margin-top: 20px;"></a>&nbsp;</p>
                              &nbsp;&nbsp;&nbsp;&nbsp;
                          </div>
                          <?php } ?>                
                    </div>
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
  var url="";
  var actioncolumn="";
  function myFunction(obj,cid) {
    var site_url = $("#site_url").val();
    var ask = confirm("Are You sure to want delete this image?");
    if (ask==true) 
    {
      $(".id"+cid).fadeOut();
      var datastring="cid="+cid;
      $.ajax({
          type:"POST",
          url:site_url+"/Industries_Detail/img_delete",
          data:datastring,
          cache:false,        
          success:function(returndata)
          { 
              location.reload();
          }
        });
    }
}
</script>
