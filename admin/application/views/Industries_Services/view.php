
<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Industries View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Industries View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Industries_Services');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Page Heading :</label>
                      <p><?php if(!empty($page_heading)) { echo $page_heading;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading :</label>
                      <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Description :</label>
                      <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
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
