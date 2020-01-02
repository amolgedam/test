
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
              <div class="panel-heading"><h4>View<a href="<?= site_url('Contact');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Name :</label>
                      <p><?php if(!empty($name)) { echo $name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                email
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Last name :</label>
                      <p><?php if(!empty($last_name)) { echo $last_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Email ID:</label>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group">
                      <label> Please Tell Us More :</label>
                      <p><?php if(!empty($tell_me)) { echo $tell_me;}else {echo "N/A";}?></p>
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
